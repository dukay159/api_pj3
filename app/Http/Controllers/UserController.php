<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InforUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = InforUser::orderBy('id','desc')->get();

        return view('user.index',[
            'users' => $users,
        ]);
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
        $user=InforUser::create($request->all());
        return response()->json([
            'data'=>$user,
            'message'=>'Insert Successful'
        ],200); // 200 là mã lỗi
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = InforUser::find($id);
        return response()->json(['data'=>$user],200); // 200 là mã lỗi
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=InforUser::find($id);
        return response()->json(['data'=>$user,],200); // 200 là mã lỗi
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
        $user=InforUser::find($id)->update($request->all());
        return response()->json(['data'=>$user,'user' => $request->all(),'userid' => $id,'message'=>'Update Successful'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InforUser::find($id)->delete();
        return response()->json(['data'=>'removed'],200);
    }
}
