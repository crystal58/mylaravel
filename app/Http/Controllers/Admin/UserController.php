<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $data = User::all()->toArray();
        return view("admin.user",["result"=>$data]);

    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $type = $request->type;
        //var_dump($request);
        $user = new User();
        if($type=="name"){
            $select = User::where("name","like","%".$keyword."%")->get();
        }elseif($type=="email"){
            $select = User::where("email",$keyword)->get();
        }else {
            $select = User::all();
        }
        $data = $select->toArray();
        return view("admin.user",["result"=>$data]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        echo "create";
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        echo "store";
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = new User();
        $userInfo = $user->getUserById($id)->toArray();
        echo json_encode($userInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Session::all();
        var_dump($data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $status = $request->get("status");
        $user = new User();
        $userInfo = $user->getUserById($id);
        $userInfo->status = $status;

        if($userInfo->save()){
            echo "success";
        }else{
            echo "error";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
