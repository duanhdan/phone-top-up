<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Telco;

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
        $data['listTelco'] = Telco::where('status','!=',-1)->orderBy('id', 'asc')->get();        
        return view('telco/index',$data);
    }

    public function showAddForm(){
        $data = $this->data;
        return view('telco/add',$data);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $input = $request->only('name', 'code');
        //insert telco
        $telco = new Telco($input);
        $telco->save();

        $request->session()->flash('message_success', 'Thêm mới Telco thành công');
        return redirect(route('telco_list'));

    }

    public function showEditForm($id){
        $data = $this->data;
        $data['telco'] = Telco::find($id);
        if(!$data['telco']){
            return abort(404);
        }

        return view('telco/edit',$data);
    }

    public function edit(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $telco = Telco::find($id);
        if(!$telco){
            return abort(404);
        }
        $input = $request->only('name', 'code','status');
        $telco->name    = $input['name'];
        $telco->code    = $input['code'];
        $telco->status  = !empty($input['status']) ? (int)$input['status'] : 0;
        $telco->save();
        $request->session()->flash('message_success', 'Cập nhật Telco thành công');
        return redirect(route('telco_list'));
    }
}
