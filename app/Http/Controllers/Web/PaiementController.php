<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BillPromo;
use App\Models\Bills;
use App\Models\Callback;
use App\Models\Event;
use App\Models\Price;
use App\Models\Ticket;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaiementController extends Controller
{
    public function payTicket(Request $request)
    {
        // Récupérer toutes les valeurs de la session
        $sessionData = Session::all();
        dd($sessionData);
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
        //         $result =  $this->addTicket($request->event_id, $montant, $request->currency, $request->quantity, $billRef);
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

        // } elseif($request->has('type') && $request->type == 'card') {

        //     try {
        //         $this->validate($request, [
        //             'montant' => 'numeric',
        //             'currency' => 'required',
        //             'event_id' => 'required|numeric',
        //             'type' => 'required',
        //             'quantity' => 'required|numeric',
        //             "total" => 'required|numeric',
        //         ]);

        //         /*dd($request->type);*/
        //         /*
        //         $headers = [
        //         'Content-Type' => 'application/json'
        //         ];
        //         $body = json_encode([
        //             "authorization" => 'Bearer ' . $token,
        //             'merchant' => 'bevent',
        //             'reference' => $billRef,
        //             'amount' => $request->total,
        //             'currency' => Str::upper($request->currency),
        //             'description' => "Paiement de la facture $billRef",
        //             'callback_url' => 'https://b924-81-177-186-13.ngrok-free.app/callback',
        //             'approve_url' => 'https://b924-81-177-186-13.ngrok-free.app/approve',
        //             'cancel_url' => 'https://b924-81-177-186-13.ngrok-free.app/cancel',
        //             'decline_url' => 'https://b924-81-177-186-13.ngrok-free.app/decline'
        //         ]);

        //         $req = new GuzzleRequest('POST', 'https://cardpayment.flexpay.cd/v1.1/pay', $headers, strval($body));
        //         $response = $client->sendAsync($req)->wait();

        //         $data = json_decode($response->getBody()->getContents());
        //         */
        //         $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        //         $event = Event::find($request->event_id);
        //         $price = $stripe->prices->create([
        //             'currency' => $request->currency,
        //             'unit_amount' => $request->total * 100,
        //             'product_data' => ['name' => 'Ticket '.$event->name],
        //         ]);
        //         $data = $stripe->checkout->sessions->create([
        //             'success_url' => route('approve').'?session_id={CHECKOUT_SESSION_ID}',
        //             'cancel_url' => route('cancel'),
        //             'line_items' => [
        //                 [
        //                   'price' => $price->id,
        //                   'quantity' => 1,
        //                 ],
        //             ],
        //             'currency' => $request->currency,
        //             'mode' => 'payment',
        //         ]);

        //         if(isset($data->id) && $data->id != '') {
        //             $montant = $request->total/$request->quantity;
        //             $billRef = $data->id;
        //             $result =  $this->addTicket($request->event_id, $montant, $request->currency, $request->quantity, $billRef);
        //             /*dd($data->url);*/
        //             return redirect()->away($data->url);
        //         } else{
        //             return redirect()->back()->withErrors(['message' => 'Une erreur lors du paiement. Veuillez reessayer.']);
        //         }

        //     } catch (ValidationException $e) {
        //         $errors = $e->validator->errors()->getMessages();

        //         return redirect()->back()->withErrors($errors);
        //     }
        // } else{
        //     return redirect()->back()->withErrors(['message' => "Une erreur s'est produite lors du choix du mode de paiement! "]);
        // }

    }

    /**
     * Create a bill and ticket to database
     */

    public function addTicket($event_id, $amount, $currency, $quantity, $billRef)
    {

        $result = DB::transaction(function() use ($event_id, $amount, $currency, $quantity, $billRef){

            $type_ticket = Price::where('event_id', $event_id)->where('currency', $currency)->where('amount', $amount)->first();
            if ($type_ticket) {
                $type_ticket = $type_ticket->category;
            } else {
                $type_ticket = 'ticket';
            }
            $bill = Bills::create([
                'user_id' => auth()->id(),
                'event_id' => $event_id,
                'unit_amount' => $amount,
                'currency' => $currency,
                'reference' => $billRef,
                'quantity' => $quantity,
                'type_ticket' => $type_ticket,
                'total_amount' => $amount * $quantity,
                'payment_method' => 'mobile',
            ]);

            if ($bill) {
                for ($i=0; $i < $quantity; $i++) {
                    $reference = 'BEVENT'. strtoupper(Str::random(3)) . now()->getTimestamp();

                    $ticket = Ticket::create([
                        'user_id' => auth()->id(),
                        'event_id' => $event_id,
                        'amount' => $amount,
                        'currency' => $currency,
                        'reference' => $reference,
                        'bills_id' => $bill->id,
                    ]);
                }

                return $bill;
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
        $bill = Bills::with('tickets')-> where('reference', $request->reference)->first();
        if ($bill) {
            if ($request->code == 1) {
                $bill->update([
                    'success' => false,
                ]);
            } elseif($request->code == 0) {
                foreach ($bill->tickets as $ticket) {
                    $path = 'qrcode/'.$ticket->reference.'.png';
                    $link = route('ticket.scan', ['reference'=> $ticket->reference]);
                    $qrCode = QrCode::format('png')->size(300)->generate($link, public_path($path));
                    $ticket->update([
                        'qrcode' => $path,
                    ]);
                }
                $path = 'qrcode/'.$request->reference.'.png';
                $link = route('ticket.scan', ['reference'=> $request->reference]);
                $qrCode = QrCode::format('png')->size(300)->generate($link, public_path($path));
                $bill->update([
                    'qrcode' => $path,
                    'success' => true,
                ]);
            }
            dd("Callback reçu web");

            $callback = Callback::create([
                    'code' => $request->code,
                    'reference' => $request->reference,
                    'amountCustomer' => $request->amountCustomer,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'phone' => $request->phone,
                    'createdAt' => $request->createdAt,
                    'channel' => $request->channel,
                    'orderNumber' => $request->orderNumber,
                    'provider_reference' => $request->provider_reference
                    ]
                );

            if ($callback) {
                return response()->json([
                    "message" => "Callback reçu",
                    "data" => $ticket,
                    "status_code" => 201,
                    "success" => true
                ],201);

            } else {
                return response()->json([
                    "message" => "Callback non enregistré mais ticket mis à jour",
                    "data" => $ticket,
                    "status_code" => 422,
                    "success" => false
                    ],422);
            }

        } else {
            return response()->json([
                "message" => "Ticket introuvable web",
                "data" => [],
                "status_code" => 404,
                "success" => false
            ],404);
        }

    }

    public function handleApproved(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        /*dd("jdjdjdj");*/
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
