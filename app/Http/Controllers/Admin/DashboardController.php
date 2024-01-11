<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CenterCost;
use App\Models\Destination;
use App\Models\Equipment;
use App\Models\Mcscr;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\TypeEquipment;
use App\Models\TypeMalfunction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboarddata(){

        $users=User::count();
        


        return [
            'users' => $users,
        ];
    }
}
