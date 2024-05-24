<?php

namespace App\Exports;

use App\Models\FeeAnLicence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FeeExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $fees;
 
    public function __construct() {
     $this->fees = FeeAnLicence::orderBy('created_at','desc')->get();
    }
 
    public function view() : View{
 
         return view('report.fees',[
             'fees'=>$this->fees
         ]);
 
    }
}
