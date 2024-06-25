<?php

namespace App\Http\Controllers;

use App\Models\FeeAnLicence;
use App\Models\Role;
use App\Models\UserStatus;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    //

    public function auxiliardata(){

        $roles = Role::orderBy('id','asc')->get();
        $user_statuses = UserStatus::orderBy('name','asc')->get();
        $permissions = FeeAnLicence::orderBy('name','asc')->get();

        $roles2 = $roles->except(1);

        return [
                'roles'=>$roles2,
                'user_statuses'=>$user_statuses,
                'permissions'=>$permissions
                ];
    }
}
