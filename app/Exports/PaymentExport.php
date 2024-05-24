<?php

namespace App\Exports;

use App\Models\Payments;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $payments;
 
    public function __construct($payments) {
        $this->payments = $payments;
    //  $this->payments = Payments::orderBy('created_at','desc')->get();
    }
 
    public function view() : View{
 
         return view('report.payments',[
             'payments'=>$this->payments
         ]);
 
    }
}
