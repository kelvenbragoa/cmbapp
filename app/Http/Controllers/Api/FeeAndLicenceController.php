<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeAnLicence;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class FeeAndLicenceController extends Controller
{
    //

    public function getlicences($id){


        
        $permissions = UserPermission::where('user_id',$id)->get('licence_id');
        // $licence = FeeAnLicence::where('is_active',1)->orderBy('name','asc')->get();

        $licence = FeeAnLicence::where('is_active',1)->whereIn('id',$permissions)->orderBy('name','asc')->get();

        
        

        // $array[] = array(
        //     'all_tickets' => $all_tickets,
        // );

        return response([
            'licences' => $licence,
        ],200);

    }

    public function licencedetail($id){
        
        return response([
            'licence' => FeeAnLicence::where('id',$id)->get(),
        ],200);
    }
}
