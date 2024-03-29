<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CenterCost;
use App\Models\Destination;
use App\Models\Equipment;
use App\Models\Mcscr;
use App\Models\Payments;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\TypeEquipment;
use App\Models\TypeMalfunction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboarddata(){

        $yesterday = Carbon::yesterday();
        $users=User::count();
        $today_tax = Payments::whereDate('created_at',date('Y-m-d'))->sum('amount');
        $yesterday_tax = Payments::whereDate('created_at',$yesterday)->sum('amount');
        $month_tax = Payments::whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->sum('amount');
        $year_tax = Payments::whereYear('created_at',date('Y'))->sum('amount');


        $dataChartPaymentMonth = [];
        $dataChartPaymentDay = [];

        for ($x = 1; $x <= 31; $x++) {
            $paymentChartDay = Payments::whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->sum('amount');

          
                $dataChartPaymentDay[]=$paymentChartDay;
            
 
        }

        for($i=1; $i<=12; $i++){
            $paymentChartMonth = Payments::whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->sum('amount');

            $dataChartPaymentMonth[]=$paymentChartMonth;
 
        }
        


        return [
            'users' => $users,
            'today'=>$today_tax,
            'yesterday'=>$yesterday_tax,
            'month'=>$month_tax,
            'year'=>$year_tax,
            'dataChartPaymentMonth'=>$dataChartPaymentMonth,
            'dataChartPaymentDay'=>$dataChartPaymentDay


        ];
    }
}
