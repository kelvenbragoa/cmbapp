<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $payments = Payments::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('id','like',"%{$searchQuery}%");
            })
            ->orderBy('id','asc')
            ->paginate();

            return $payments;
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
        $payment = Payments::create($data);
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
        $payment = Payments::
        find($id);

        $searchQuery = request('query');

       


        return [
            'payment'=>$payment,
            
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $payment = Payments::find($id);
       
        


        return [
            'payment'=>$payment,
            
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();


        $payment = Payments::find($id);

        $payment->update($data);

        return $payment;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $payment = Payments::find($id);

        $payment->delete();

        return true;
        }
}
