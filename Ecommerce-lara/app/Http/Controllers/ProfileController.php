<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserProfile;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Country;
use App\City;
use App\State;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('role', 'profile')->paginate(3);        
        return view('admin.users.index', compact('users'));

    }


    public function trash(){
        $users = User::with('profiles')->onlyTrashed()->get();
        return view('admin.users.trash', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $countries = Country::all();
        return view('admin.users.create', compact('roles', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
           
           // $path = $request->thumbnail->storeAs('images/profile', $name, 'public');
            $path = $request->thumbnail->storeAs('images', $name, 'public');
        }
        $user = User::create([
           'email' => $request->email,
           'password' => bcrypt($request->password),
           'status' => $request->status
        ]);
        
        if($user){
            $profile = Profile::create([
              'user_id' => $user->id,
              'name' => $request->name,
              'country_id' => $request->country_id,
              'state_id' => $request->state_id,
              'city_id' => $request->city_id,
              'phone' => $request->phone,
              'slug' => $request->slug,
              'thumbnail' => $path,
              'address' => $request->address
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
       $user = User::find($profile->user_id);
       //dd($profile);
       return view('admin.users.updateUser',compact('profile', 'user'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //dd($request->all());
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images', $name, 'public');
        }

        $user = User::find($profile->user_id);
       // dd($user);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->role_id = $request->role;
       
        $profile->id = $request->id;
        $profile->name = $request->name;
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        //$profile->password = bcrypt($request->password);
        $profile->country_id = $request->country_id;
        $profile->state_id = $request->state_id;
        $profile->city_id = $request->city_id;
        $profile->thumbnail = isset($request->thumbnail) == null ? $profile->thumbnail : $path;
        if($profile->save() && $user->save()){
          return back()->with('message', 'User successfully updated');
        }
        else{
            return back()->with('message', 'User not updated Error');
        }

    }


    public function recover($id){
       $user_id = DB::table('profiles')->where('id', $id)->pluck('user_id');
       $user = User::withTrashed()->find($user_id);
       
       $profile = Profile::withTrashed()->find($id);
    
       if($profile->restore() && $user->restore()){ 
           
        return back()->with('message', 'User successfully restored');
        }else{
        return back()->with('message', 'User not been restored');
       }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
   
    public function remove(Profile $profile){
        $user = User::find($profile->user_id);
       // $role = Role::find($user->role_id);
        $profile = Profile::find($profile->id);
        if($profile->delete() && $user->delete()){
            return back()->with('message', 'User successfully Trashed');
        }else{
            return back()->with('message', 'Error!!!');
        }
    }

    public function getCities($id){
        if(request()->ajax())
         return City::where('state_id',$id)->get();
        else
          return 0;
    }

    public function getStates($id){
        if(request()->ajax())
         return State::where('country_id', $id)->get();
        else
          return 0;
    }


}
