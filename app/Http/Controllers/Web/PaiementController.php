<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Models\Callback;
use GuzzleHttp\Client;

class PaiementController extends Controller
{
    protected $totalPrice = 0;

    public function payorder(Request $request)
    {

        $cart = Session::all()['cart'];
        $client = new Client();
        $token = env('CARD_API_PAYMENT');
        foreach ($cart as $product) {
            // Convertir la quantité en entier (au cas où elle est une chaîne)
            $quantity = (int) $product['quantity'];

            // Ajouter le prix total de ce produit au prix global
            $this->totalPrice += $product['price'] * $quantity;
        }

        // Récupérer le dernier numéro de commande
        $lastOrder = Order::orderBy('id', 'desc')->first(); // Récupère la dernière commande

        // Déterminer le prochain numéro de commande
        if ($lastOrder) {
            // Extraire le numéro de la dernière commande (supposons que le numéro est stocké comme "Commande-0001")
            $lastNumber = (int) substr($lastOrder->number, -4); // Extrait les 4 derniers chiffres
            $nextNumber = $lastNumber + 1; // Incrémente le numéro
        } else {
            // Si aucune commande n'existe, commencer à 1
            $nextNumber = 1;
        }

        // Formater le numéro avec des zéros non significatifs (4 chiffres)
        $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // addCommande();

        if ($request->has('type') && $request->type == 'mobile') {

            // $request->validate([
            //     'phone' => 'required|string|min:10|max:12',
            //     'montant' => 'required|min:0|numeric',
            //     'currency' => 'required',
            //     'event_id' => 'required|exists:events,id',
            //     'type' => 'required',
            //     'quantity' => 'required|numeric',
            //     "total" => 'required|numeric',
            // ]);

            $prodUrl = env('PROD_URL');
            if (empty($prodUrl)) {
                throw new \Exception("PROD_URL n'est pas défini dans le fichier .env");
            }

            $response = $client->request('POST', $prodUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'phone' => $request->phone,
                    'amount' => $this->totalPrice,
                    'currency' => $request->currency,
                    // 'event_id' => $request->event_id,
                    'pay_method' => $request->type,
                    /*"callbackUrl" => "https://https://b-tickets-app.com/approve/mobile",*/
                    "callbackUrl" => "https://b924-81-177-186-13.ngrok-free.app/callback",
                    "merchant" => "BEVENT",
                    "reference" => $formattedNumber,
                    "type" => "1",
                ]
            ]);

            $data = json_decode($response->getBody()->getContents());

            if ($data->code == '0') {
                sleep(20);
                $check = $this->checkPayment($client, $data, $token);

                /*dd($check);*/
                if ($check == "2") {
                    sleep(20);
                    $checkonce = $this->checkPayment($client, $data, $token);
                    if ($checkonce == "2") {
                        sleep(20);
                        $checkonce = $this->checkPayment($client, $data, $token);
                        if ($checkonce == "2") {
                            $this->redirectIfFAiled($request->currency, $formattedNumber, $cart);
                            return redirect()->route('failed');
                        } elseif ($checkonce == "1") {
                            $this->redirectIfFAiled($request->currency, $formattedNumber, $cart);
                            return redirect()->route('failed');
                        } elseif ($checkonce == "0") {
                            $this->redirectIfApproved($request->currency, $formattedNumber, $cart);
                            return redirect()->route('approve');
                        }
                    } elseif ($checkonce == "1") {
                        $this->redirectIfFAiled($request->currency, $formattedNumber, $cart);
                        return redirect()->route('failed');
                    } elseif ($checkonce == "0") {
                        $this->redirectIfApproved($request->currency, $formattedNumber, $cart);
                        return redirect()->route('approve');
                    }
                } elseif ($check == "1") {
                    $this->redirectIfFAiled($request->currency, $formattedNumber, $cart);

                    // dd("redirect");
                    return redirect()->route('failed');
                } elseif ($check == "0") {
                    $this->redirectIfApproved($request->currency, $formattedNumber, $cart);
                    return redirect()->route('approve');
                }
            } elseif ($data->code == '1') {
                $this->redirectIfFAiled($request->currency, $formattedNumber, $cart);
                /*return redirect()->back()->withErrors(['message' => 'Une erreur lors du paiement. Veuillez reessayer.']);*/
            }
        }
        // // // } else if ($request->has('type') && $request->type == 'card') {

        // //     try {
        // //         // $this->validate($request, [
        // //         //     'montant' => 'numeric',
        // //         //     'currency' => 'required',
        // //         //     'event_id' => 'required|numeric',
        // //         //     'type' => 'required',
        // //         //     'quantity' => 'required|numeric',
        // //         //     "total" => 'required|numeric',
        // //         // ]);

        // //         $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');

        // //         $lineItems = [];

        // //         foreach ($cart as $item) {
        // //             // Créer un price pour chaque article
        // //             $price = $stripe->prices->create([
        // //                 'currency' => 'usd', // Devise
        // //                 'unit_amount' => $item['price'] * 100, // Montant en cents
        // //                 'product_data' => [
        // //                     'name' => $item['name'], // Nom du produit
        // //                 ],
        // //             ]);

        // //             // Ajouter le price aux line_items
        // //             $lineItems[] = [
        // //                 'price' => $price->id,
        // //                 'quantity' => $item['quantity'],
        // //             ];
        // //         }

        // //         // Créer la session de paiement
        // //         $data = $stripe->checkout->sessions->create([
        // //             'success_url' => route('approve') . '?session_id={CHECKOUT_SESSION_ID}',
        // //             'cancel_url' => route('cancel'),
        // //             'line_items' => $lineItems, // Utiliser les line_items préparés
        // //             'mode' => 'payment',
        // //         ]);

        // //         if (isset($data->id) && $data->id != '') {
        // //             // dd($data->id);
        // //             $cmdRef = $data->id;
        // //             $result = $this->addCommande($request->total, 'usd', $cmdRef);

        // //             return redirect()->away($data->url);
        // //         } else {
        // //             return redirect()->back()->withErrors(['message' => 'Une erreur lors du paiement. Veuillez reessayer.']);
        // //         }

        // //     } catch (ValidationException $e) {
        // //         $errors = $e->validator->errors()->getMessages();

        // //         return redirect()->back()->withErrors($errors);
        // //     }
        // // }
        // else {
        //     return redirect()->back()->withErrors(['message' => "Une erreur s'est produite lors du choix du mode de paiement! "]);
        // }

    }

    protected function checkPayment($client, $data, $token)
    {
        $check = $client->request('GET', 'https://backend.flexpay.cd/api/rest/v1/check/' . $data->orderNumber, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token, // Remplacez par votre jeton d'accès
            ],
        ]);

        $response = json_decode($check->getBody()->getContents());

        /*dd($response);*/

        switch ($response->transaction->status) {
            case "0":
                return '0';
                break;
            case "1":
                return '1';
                break;
            case "2":
                return "2";
                break;
        }
    }

    protected function redirectIfApproved($currency, $cmdRef, $cart)
    {
        $result =  $this->addCommande($currency, $cmdRef, $cart, 'paid');
        Session::forget('cart');
    }

    protected function redirectIfFAiled($currency, $cmdRef, $cart)
    {
        $result =  $this->addCommande($currency, $cmdRef, $cart, 'failed');
        // Session::forget('cart');
    }

    /**
     * Create a commande to database
     */

    public function addCommande($currency, $cmdRef, $cart, $status)
    {

        $result = DB::transaction(function () use ($currency, $cmdRef, $cart, $status) {

            // Créer la commande avec le numéro formaté
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'number' => '#' . $cmdRef,
                'total_price' => $this->totalPrice,
                'currency' => $currency,
                'status' => $status,
                'notes' =>  '...'
            ]);

            if ($order) {
                foreach ($cart as $product) {
                    // dd($product['price']);
                    $quantity = (int) $product['quantity'];
                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product['id'],
                        'qty' => $quantity,
                        'unit_price' => $product['price']
                    ]);
                }
            }

        });
        return $result;
    }

    public function handleCallback(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        $commande = Order::where('number', $request->reference)->first();
        if ($commande) {
            if ($request->code == 1) {
                $commande->update([
                    'status' => 'paid',
                ]);
            }
            dd($request);

            // 'reference' => $request->reference,
            $callback = Callback::create(
                [
                    'total_price' => $request->amount,
                    'currency' => $request->currency,
                    'phone' => $request->phone,
                    'channel' => $request->channel,
                    'orderNumber' => $request->orderNumber,
                    'createdAt' => $request->createdAt,
                ]
            );

            if ($callback) {
                return response()->json([
                    "data" => $callback,
                    "status_code" => 201,
                    "success" => true
                ], 201);
            } else {
                return response()->json([
                    "message" => "Callback non enregistré",
                    "data" => $callback,
                    "status_code" => 422,
                    "success" => false
                ], 422);
            }

        } else {
            return response()->json([
                "message" => "Commande introuvable",
                "data" => [],
                "status_code" => 404,
                "success" => false
            ], 404);
        }

    }

    public function handleApproved(Request $request)
    {
        // dd("jdjdjdj");
        // $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        // $session = $stripe->checkout->sessions->retrieve($request->session_id);
        return view('payment.approved');

    }

    public function handleCanceled(Request $request)
    {
        return view('payment.canceled');
    }

    public function handlefailed(Request $request)
    {
        return view('payment.declined');

    }

}
