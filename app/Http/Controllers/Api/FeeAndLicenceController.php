<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeAnLicence;
use Illuminate\Http\Request;

class FeeAndLicenceController extends Controller
{
    //

    public function getlicences(){


        

        $licence = FeeAnLicence::where('is_active',1)->orderBy('name','asc')->get();
        
        

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
