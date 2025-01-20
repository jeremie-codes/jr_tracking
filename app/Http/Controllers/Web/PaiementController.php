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

class PaiementController extends Controller
{
    public function payTicket(Request $request)
    {
        // Récupérer toutes les valeurs de la session
        $cart = Session::all()['cart'];
        // dd($request);
        // $token = env('CARD_API_PAYMENT');
        // $billRef = 'Fact-'. now()->getTimestamp();
        // $client = new Client();
        // if ($request->has('type') && $request->type == 'mobile') {

        //     $request->validate([
        //         'phone' => 'required|string|min:10|max:12',
        //         'montant' => 'required|min:0|numeric',
        //         'currency' => 'required',
        //         'event_id' => 'required|exists:events,id',
        //         'type' => 'required',
        //         'quantity' => 'required|numeric',
        //         "total" => 'required|numeric',
        //     ]);

        //     $response = $client->request('POST', env('PROD_URL'), [
        //         'headers' => [
        //             'Authorization' => 'Bearer ' . $token,
        //             'Accept' => 'application/json',
        //         ],
        //         'json' => [
        //             'phone' => $request->phone,
        //             'amount' => $request->total,
        //             'currency' => $request->currency,
        //             'event_id' => $request->event_id,
        //             'pay_method' => $request->type,
        //             "callbackUrl" => "https://b924-81-177-186-13.ngrok-free.app/callback",
        //             "merchant" => "BEVENT",
        //             "reference" => $billRef,
        //             "type" => "1",
        //         ]
        //     ]);

        //     $response = Http::withBasicAuth(env('ILLICO_USER'), env('ILLICO_PSW'))
        //                 ->withHeaders([
        //                     'LogInName'=> env('ILLICO_LOG'),
        //                     'LogInPass'=> env('ILLICO_PASS'),
        //                     'Content-Type' => 'application/json'
        //                 ])
        //                 ->post(env('ILLICO_URL') ,
        //                 json_encode([
        //                     "mobilenumber" => $request->phone,
        //                     "amounttransaction" => $request->total,
        //                     "trancurrency" => $request->currency,
        //                     "invoiceid" => $billRef,
        //                     "terminalid" => "BEVENT",
        //                     "merchantid" => "002543",
        //                 ]));
        //     $data = json_decode($response->getBody()->getContents());

        //     if ($data->respcode == '00') {
        //         $montant = $request->total/$request->quantity;
        //         $result =  $this->addCommande($request->event_id, $montant, $request->currency, $request->quantity, $billRef);
        //         if ($request->promoCode) {
        //             BillPromo::create([
        //                 'bill_id' => $result->id,
        //                 'promo_id' => $request->promoCode,
        //             ]);
        //         }

        //         return view('payment.mobile', [
        //             'resultat' => $result
        //         ]);

        //     } elseif($data->code == '1') {
        //         return redirect()->back()->withErrors(['message' => 'Une erreur lors du paiement. Veuillez reessayer.']);
        //     }

        // } else
        if($request->has('type') && $request->type == 'card') {

            try {
                // $this->validate($request, [
                //     'montant' => 'numeric',
                //     'currency' => 'required',
                //     'event_id' => 'required|numeric',
                //     'type' => 'required',
                //     'quantity' => 'required|numeric',
                //     "total" => 'required|numeric',
                // ]);

                $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');

                $lineItems = [];

                foreach ($cart as $item) {
                    // Créer un price pour chaque article
                    $price = $stripe->prices->create([
                        'currency' => 'usd', // Devise
                        'unit_amount' => $item['price'] * 100, // Montant en cents
                        'product_data' => [
                            'name' => $item['name'], // Nom du produit
                        ],
                    ]);

                    // Ajouter le price aux line_items
                    $lineItems[] = [
                            'price' => $price->id,
                            'quantity' => $item['quantity'],
                        ];
                }

                // Créer la session de paiement
                $data = $stripe->checkout->sessions->create([
                    'success_url' => route('approve') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('cancel'),
                    'line_items' => $lineItems, // Utiliser les line_items préparés
                    'mode' => 'payment',
                ]);

                if(isset($data->id) && $data->id != '') {
                    // dd($data->id);
                    $cmdRef = $data->id;
                    $result =  $this->addCommande($request->total, 'usd', $cmdRef);

                    return redirect()->away($data->url);
                } else{
                    return redirect()->back()->withErrors(['message' => 'Une erreur lors du paiement. Veuillez reessayer.']);
                }

            } catch (ValidationException $e) {
                $errors = $e->validator->errors()->getMessages();

                return redirect()->back()->withErrors($errors);
            }
        } else{
            return redirect()->back()->withErrors(['message' => "Une erreur s'est produite lors du choix du mode de paiement! "]);
        }

    }

    /**
     * Create a bill and ticket to database
     */

    public function addCommande($amount, $currency, $cmdRef)
    {

        $result = DB::transaction(function() use ($amount, $currency, $cmdRef){
            $cart = Session::all()['cart'];

            // Exemple de création d'une commande
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'number' => $cmdRef,
                'total_price' => $amount,
                'currency' => $currency,
                'status' => 'pending',
            ]);

            if ($order) {
                foreach ($cart as $key => $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $key,
                        'unit_price' => $item['price'],
                        'qty' => $item['quantity'],
                    ]);
                }

                return $order;
            } else {
                return 'echec';
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
            $callback = Callback::create([
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
                ],201);
            } else {
                return response()->json([
                    "message" => "Callback non enregistré",
                    "data" => $callback,
                    "status_code" => 422,
                    "success" => false
                    ],422);
            }

        } else {
            return response()->json([
                "message" => "Commande introuvable",
                "data" => [],
                "status_code" => 404,
                "success" => false
            ],404);
        }

    }

    public function handleApproved(Request $request)
    {
        // dd("jdjdjdj");
        $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        return view('payment.approved');

    }

    public function handleCanceled(Request $request)
    {
        return view('payment.canceled');
    }

    public function handleDeclined(Request $request)
    {
        return view('payment.declined');

    }

}
