<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TopupMobile;
use App\Model\Upload;
use App\Model\Topup;

class TopupController extends Controller
{

    private $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['menu_active'] = 'topup';
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

    public function showUploadForm(){
        $data = $this->data;
        return view('topup/upload',$data);
    }

    public function upload(Request $request){
        $request->validate([
            'type' => 'required',
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $type = (int)$request->input('type');

        $file = $request->file;
        $filename = uniqid(date('dmY').'_').'.'.$file->getClientOriginalExtension();
        $file->move('upload', $filename);     

        $user = \Auth::user();
        //insert telco
        $upload = new Upload();
        $upload->user_id = $user->id;
        $upload->parent_id = $user->id;
        $upload->type = $type;
        $upload->file = '/upload/'.$filename;
        $upload->discount = ($type == 1) ? 28 : 25;
        $upload->save();

        $filePath = public_path().$upload->file;
        if(!empty($upload->id)){
            $data = \Excel::load($filePath, function($reader) {})->get();
            $rows = $data->toArray();
            foreach($rows as $row){
                TopupMobile::dispatch($row);
            }
        }

        $request->session()->flash('message_success', 'Thêm mới Telco thành công');
        return redirect(route('topup_upload'));

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

    public function delete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $input = $request->only('id');
        $id = (int)$input['id'];

        $telco = Telco::find($id);
        if(!$telco){
            return response()->json(['error' => 1, 'message' => 'Telco không tồn tại']);
        }
        //update status = -1
        $telco->status = -1;
        $telco->save();

        return response()->json(['error' => 0, 'message' => 'Xóa Telco thành công']);

    }
}
