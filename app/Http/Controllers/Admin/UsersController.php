<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountStatus;
use App\Models\Area;
use App\Models\City;
use App\Models\FeeAnLicence;
use App\Models\Payments;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $users = User::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('first_name','like',"%{$searchQuery}%")->orWhere('last_name','like',"%{$searchQuery}%")->orWhere('email','like',"%{$searchQuery}%");
            })
            ->with('role')
            ->with('user_status')
            ->orderBy('first_name','asc')
            ->paginate();


            return $users;
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


        $request->validate([
            'first_name' =>'required',
            'last_name' =>'required',
            'code' =>'required',
            'mobile' =>'required|min:9',
            'user_status_id' =>'required',
            'role_id' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required|min:8',
            
        ]);

        
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'code' => $data['code'],
                'mobile' => $data['mobile'],
                'user_status_id' => $data['user_status_id'],
                'role_id' => $data['role_id'],
                'email' => strtolower($data['email']),
                'password' => bcrypt($data['password']),
            ]);

            if($request->has('userpermissions')){
                foreach($data['userpermissions'] as $item){
                    if(count($item) > 0){

                        $test = UserPermission::where('user_id',$user->id)->where('licence_id',$item['permission_id'])->get();
                        if($test->count() == 0){
                            UserPermission::create([
                                'user_id'=>$user->id,
                                'licence_id'=>$item['permission_id']
                            ]);
                        }


                    }
                }
            }
    
            return $user;
        

            
        



        



        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $user = User::with('role')
        ->with('user_status')
        ->with('permissions.fee')
        ->find($id);
        
        $dataChartPaymentDay = [];


        for ($x = 1; $x <= 31; $x++) {
            $paymentChartDay = Payments::whereDay('created_at',$x)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->where('user_id',$id)->sum('amount');

          
                $dataChartPaymentDay[]=$paymentChartDay;
            
 
        }

        return [
            'user'=>$user,
            'dataChartPaymentDay'=>$dataChartPaymentDay,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::with('permissions.fee')->find($id);
        $roles = Role::orderBy('name','asc')->get();
        $user_statuses = UserStatus::orderBy('name','asc')->get();
        $permissions = FeeAnLicence::orderBy('name','asc')->get();

        

        return [
            'user'=>$user,
            'roles'=>$roles,
            'user_statuses'=>$user_statuses,
            'permissions'=>$permissions
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();
        $user = User::find($id);

        $request->validate([
            'first_name' =>'required',
            'last_name' =>'required',
            'code' =>'required',
            'mobile' =>'required|min:9',
            'user_status_id' =>'required',
            'role_id' =>'sometimes',
            'email' =>'required|unique:users,email,'.$user->id,
            'password' =>'sometimes|min:8',
        ]);


        if($request->has('userpermissions')){
            $user->permissions()->delete();
            foreach($data['userpermissions'] as $item){
                if(count($item) > 0){

                    $test = UserPermission::where('user_id',$user->id)->where('licence_id',$item['permission_id'])->get();
                    if($test->count() == 0){
                        UserPermission::create([
                            'user_id'=>$user->id,
                            'licence_id'=>$item['permission_id']
                        ]);
                    }
                }
            }
        }

        

        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'code' => $data['code'],
            'mobile' => $data['mobile'],
            'user_status_id' => $data['user_status_id'],
            'role_id' => $data['role_id'],
            'email' => strtolower($data['email']),
            'password' => request('password') ? bcrypt($data['password']) : $user->password
        ]);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        if(Auth::user()->id == $user->id){
            return abort(402,'Erro') ;
        }
        $user->delete();

        return response()->noContent();
    }


    
}
