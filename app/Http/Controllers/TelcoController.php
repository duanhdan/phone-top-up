<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelcoController extends Controller
{

    private $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['menu_active'] = 'telco';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->data;

        return view('telco/index',$data);
    }

    public function showAddForm(){
        $data = $this->data;
        return view('telco/add',$data);
    }

    public function add(UserRequest $request){
    }

    public function showEditForm($id){
        $data = $this->data;
        return view('telco/edit',$data);
    }

    public function edit(UserEditRequest $request, $id){

    }
}
