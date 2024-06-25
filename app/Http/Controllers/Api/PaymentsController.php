<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeAnLicence;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PaymentsController extends Controller
{
    //

    public function getpayments($id){
        return response([
            'payments' => Payments::where('user_id',$id)->with('fee')->with('user')->whereDate('created_at',date('Y-m-d'))->orderBy('id','desc')->get(),
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
            'quantity'=>$data['quantity'] ?? 1,
            'total'=>$fee->amount * $data['quantity'] ?? 1,
            'uuid'=>(string)Str::uuid()
        ]);



        return response([
            'message' => 'Pagamento adicionado com sucesso. Va aos pagamentos para impressão',
            
        ], 200);
    }

    public function getstatus($id){
            $payment = Payments::find($id);
    
            return response([
    
                'status' => $payment->status
            ], 200);
    
        
    }

    public function verify($id){
        $payment = Payments::find($id);

        $payment->update([
           'status'=>0
        ]);

        return response([
           'message' => 'Pagamento verificado com sucesso'
        ], 200);
    }
}
