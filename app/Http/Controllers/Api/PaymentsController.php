<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeAnLicence;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    //

    public function getpayments($id){
        return response([
            'payments' => Payments::where('user_id',$id)->with('fee')->with('user')->orderBy('id','desc')->get(),
        ],200);
    }


    public function paymentdetail($id){
        return response([
            'payment' => Payments::where('id',$id)->with('fee')->with('user')->orderBy('id','desc')->get(),
        ],200);
    }


    public function createpayment(Request $request){

        $data = $request->all();
        $fee = FeeAnLicence::find($data['licence_id']);


        $payment = Payments::create([
            'user_id'=>$data['user_id'],
            'licence_id'=>$data['licence_id'],
            'amount'=>$fee->amount,
            'title'=>$data['title'] ?? 'Municipe',
            'obs'=>$data['obs'] ?? '-',
            'latitude'=>$data['latitude'],
            'longitude'=>$data['longitude'],
            'method'=>$data['method'] ?? 'cash',
        ]);



        return response([
            'message' => 'Pagamento adicionado com sucesso. Va aos pagamentos para impressão',
            
        ], 200);
    }
}
