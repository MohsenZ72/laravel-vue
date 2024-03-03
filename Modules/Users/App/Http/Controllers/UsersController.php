<?php

namespace Modules\Users\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Enums\RoleEnum; 

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     
    public function index()
    {

        $user =  auth('sanctum')->user() ; 


        $users;
        if($user->role===RoleEnum::ADMIN || $user->role===RoleEnum::OPERATOR){
            $users = User::all();
        }else{
            $users=[$user];
        }

        return view('users::index', ['users' => $users, 'current' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
{
    $user = User::findOrFail($id);
    $user->role = $request->input('data'); 
    $user->save();

    return 'User role updated successfully.';
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 'deleted successfully';
        //
    }
}
