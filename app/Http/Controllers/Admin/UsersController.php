<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountStatus;
use App\Models\Area;
use App\Models\City;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
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
        ->find($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $roles = Role::orderBy('name','asc')->get();
        $user_statuses = UserStatus::orderBy('name','asc')->get();
        

        return [
            'user'=>$user,
            'roles'=>$roles,
            'user_statuses'=>$user_statuses,
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
