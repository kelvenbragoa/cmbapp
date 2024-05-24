<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FeeExport;
use App\Exports\PaymentExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\Payments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    //
    public function user(){
        return Excel::download(new UserExport(), 'users.xlsx');    
    }

    public function fee(){
        return Excel::download(new FeeExport(), 'fees.xlsx');    
    }

    public function payment(){
        $startdate = request('startdate');
        $enddate = request('enddate');
        // $startDate = Carbon::createFromFormat('Y-m-d', request('startdate'));
        // $endDate = Carbon::createFromFormat('Y-m-d', request('enddate'));
        $fee = request('fee');

        // dd($startdate,$enddate);
        $payment = Payments::query()
            ->when(request('fee'),function($query,$fee){
                $query->where('licence_id',$fee);
            })
            ->when(request('startdate'),function($query,$startdate){
                $query->whereDate('created_at','>=',$startdate);
            })
            ->when(request('enddate'),function($query,$enddate){
                $query->whereDate('created_at','<=',$enddate);
            })
            ->orderBy('created_at','desc')            
            ->get();

        // dd($payment);
        return Excel::download(new PaymentExport($payment), 'payment.xlsx');    
    }
}
