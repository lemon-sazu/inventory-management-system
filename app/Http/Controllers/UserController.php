<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|min:3|max:50',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:5|max:50|confirmed',
        ]);
        
        $user = new User();
        $name = $request->name;
        $user->name =  $name;
        $user->email =  $request->email;
        $user->password =   Hash::make($request->password);
        $user->save();
        flash('User '. $name .' Created Successfully.')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::findOrFail($id);
       return view('users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' =>'required|min:3|max:50',
            'email' =>'required|email|unique:users,email,'. $id,
            'password' =>'nullable|min:5|max:50|confirmed',
        ]);
        $user = User::findOrFail($id);
        $name = $request->name;
        $user->name =  $name;
        $user->email =  $request->email;
        if($request->has('password')&& $request->password!=null){
            $user->password =  Hash::make($request->password);
        }
    
        $user->save();
        flash('User '. $name .' Created Successfully.')->success();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        flash('User Deleted Successfully.')->success();
        return redirect()->route('users.index');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
