<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Http\Requests\StaffFormRequest;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staffs=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $staffs=Staff::where('name','like',$param)
                ->orWhere('email','like',$param)
                ->orWhere('contact_no','like',$param)->get();
        }else{
            $staffs=Staff::all();
        }
        
        return view('staff.index',[
            'page_title'=>'Staffs',
            'staffs'=>$staffs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create',[
            'page_title'=>'Add Staff'
        ]);
    }

    /**
     * Staff a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffFormRequest $request)
    {
        $photo='na.jpg';
        if($request->hasFile('photo')){
            $photo=$request->file('photo')->store('public/staffs');
        }
        $staff=new Staff();
        $staff->first_name=$request->input('first_name');
        $staff->last_name=$request->input('last_name');
        $staff->email=$request->input('email');
        $staff->contact_no=$request->input('contact_no');
        $staff->address=$request->input('address');
        $staff->photo=$photo;
        $staff->status=$request->has('status');
        $staff->save();
        return redirect('/staffs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('staff.edit',[
            'page_title'=>'Edit Staff',
            'staff'=>Staff::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        
        if($request->hasFile('photo')){
            $staff->photo=$request->file('photo')->staff('public/staffs');
        }
        $staff->first_name=$request->input('first_name');
        $staff->last_name=$request->input('last_name');
        $staff->email=$request->input('email');
        $staff->contact_no=$request->input('contact_no');
        $staff->address=$request->input('address');
        
        $staff->status=$request->has('status');
        $staff->save();
        return redirect('/staffs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete_flag=1;
        $staff->save();
        return redirect('/staffs');
    }

    public function changeStatus(Request $request){
        $success=false;
        if($request->has('id')){
            $staff=Staff::find($request->input('id'));
            if(!is_null($staff)){
                $staff->status=(!$staff->status);
                $staff->save();
                $success=true;
            }
        }
        return [
            'success'=>$success
        ];
    }
}
