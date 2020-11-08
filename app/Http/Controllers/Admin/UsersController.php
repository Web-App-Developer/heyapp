<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 'Admin')->orderBy('name', 'ASC')->paginate(15);
        return view('BackendViews.Admin.Pages.users', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required|string|max:80',
            'email'=>'required|string|max:100|email|unique:users',
            'note'=>'nullable|string|max:200',
            'password'=>'required|string|min:8|max:33'
        ]);

        $inserted = User::insert([
            'type'=>'Admin',
            'name'=>$request->name,
            'email'=>$request->email,
            'note'=>$request->note,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now()
        ]);

        if ($inserted == true) {
            return redirect()->back()->with('success', 'Admin added successfully');
        }else{
            return redirect()->back()->with('error', 'SORRY - Something wrong.');
        }
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
        //
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
            'name'=>'required|string|max:80',
            'email'=>'required|string|max:100|email|unique:users,email,'.$id,
            'note'=>'nullable|string|max:200',
        ]);

        if (!User::where('id', $id)->exists()) {
            return redirect()->back()->with('error', 'Admin Not Found');
        }

        $updated = User::where('id', $id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'note'=>$request->note,
            'updated_at'=>Carbon::now()
        ]);

        if ($updated == true) {
            return redirect()->back()->with('success', 'Data updated successfully');
        }else{
            return redirect()->back()->with('error', 'SORRY - Something wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_pass(Request $request, $id){
        $this->validate($request, [
            'password'=>'required|string|min:8|max:33'
        ]);

        if (!User::where('id', $id)->exists()) {
            return redirect()->back()->with('error', 'Admin not Found');
        }


        $updated = User::where('id', $id)->update([
            'password'=>Hash::make($request->password),
            'updated_at'=>Carbon::now()
        ]);

        if ($updated == true) {
            return redirect()->back()->with('success', 'Password updated successfully');
        }else{
            return redirect()->back()->with('error', 'SORRY - Something wrong.');
        }
    }


    //delete
    public function delete_admin($id){
        if (!User::where(['id'=>decrypt($id), 'type'=>'Admin'])->exists()) {
            return redirect()->back()->with('error', 'Admin not Found');
        }
        User::where(['id'=>decrypt($id), 'type'=>'Admin'])->delete();
        return redirect()->back()->with('success', 'Admin Deleted');

    }   

}
