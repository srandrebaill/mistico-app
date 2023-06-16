<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plano;
use Illuminate\Http\Request;

use MercadoPago;

use App\Http\Controllers\PlanoController;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Payment $payment, $token)
    {
        //
        $plano = Plano::where('token', $token)->first();



        // MercadoPago\SDK::setAccessToken("TEST-4625882822737950-081714-b61c0db10d4b5ec0031e2195bd4d5d58-626539048");


      

        // // Create a preference object
        // $preference = new MercadoPago\Preference();

        // $preference->back_urls = array(
        //     "success" => 'https://www.bluetv.online/sucesso',
        //     "failure" => 'https://www.bluetv.online/cancelado',
        //     "pending" => 'https://www.bluetv.online/pendente'
        // );

        

        // //$preference->auto_return = "approved";   

        // $preference->payment_methods = array(
        //     "excluded_payment_types" => array(
        //         array("id" => "ticket")
        //     ),
        //     "installments" => 6
        // );


        // // Create a preference item
        // $data = [];
        // $item = new MercadoPago\Item();
        // $item->title = 'item teste 52';
        // $item->quantity = 1;
        // $item->unit_price = '10';
        // $preference->items = 'produto 1';
        // $preference->save();

        // dd($preference);

        // echo "aqui";
        // die();




        return view('pages.pagamentos.form', compact('plano'));
    }

    public function proccess(Request $request){
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
