<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeAnLicence;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $fees = FeeAnLicence::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->orderBy('name','asc')
            ->paginate();

            return $fees;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $fee = FeeAnLicence::create($data);
        return [
            'message'=>'success'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $fee = FeeAnLicence::
        find($id);

        $searchQuery = request('query');

       


        return [
            'fee'=>$fee,
            
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $fee = FeeAnLicence::find($id);
       
        


        return [
            'fee'=>$fee,
            
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();


        $fee = FeeAnLicence::find($id);

        $fee->update($data);

        return $fee;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $fee = FeeAnLicence::find($id);

        $fee->delete();

        return true;
        }
        
    }

