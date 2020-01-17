<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use View,Redirect;
use App\Http\Requests\StoreProfile;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['front_scripts'] = array();
        $users         = User::with('role', 'profile')->paginate(5);
        $data['users'] = $users;
        return View::make('backend_pages.customers.index',$data);
    }
    /**
     * Display a trash listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $data['front_scripts'] = array();
        $users         = User::with('role', 'profile')->onlyTrashed()->paginate(5);
        $data['users'] = $users;
        return View::make('backend_pages.customers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['front_scripts'] = array('js/pages/crud/forms/widgets/select2.js');
        $data['roles'] = Role::all();
        return View::make('backend_pages.customers.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfile $request)
    {
        //dd($request->all());
        $name = 'images/no-thumbnail.jpeg';
        $path = 'images/no-thumbnail.jpeg';
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = round(1111,9999999).'_'.time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('profiles',$name,'public');
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'status'=>$request->status,
        ]);

        if($user){
            $profile = Profile::create([
                'user_id' => $user->id,
                'name' => $request->email,
                'slug' => $request->slug,
                'phone' => $request->phone,
                'address' => $request->address,
                'thumbnail' => 'profiles/'.$name,
            ]);
        }
        if ($user && $profile) {
            return Redirect::to('admin/profile')
                    ->with('success', 'User Created Successfully');
        } else {
            return back()->with('message', 'Error Inserting new User');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
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
        //
    }
    /**
     * Recover the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function recoverProfile($id)
    {
        $user = User::with('role', 'profile')->onlyTrashed()->findOrFail($id);
        if($user->restore()){
            return Redirect::to('admin/profile')
                    ->with('success','Profile Successfully Restored!');
        }else{
             return back()->with('fail','Error Restoring Customer');
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function remove(Profile $profile)
    {
        if($profile->delete()){
            return Redirect::to('admin/profile')
                    ->with('success','Profile Successfully Trashed!');
        }else{
            return back()->with('fail','Error Deleting Profile');
        }
    }
}
