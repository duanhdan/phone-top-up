<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TopupMobile;
use App\Model\Upload;
use App\Model\Topup;
use App\Model\Telco;
use App\User;

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
    public function upload_list(Request $request)
    {
        $data = $this->data;
        $filter = $request->all();

        $data['listUpload'] = Upload::getListUpload($filter);
        $data['totalAmount'] = Upload::getTotalAmountUpload($filter);

        $data['filter'] = $filter;   
        return view('topup/upload_list',$data);
    }

    public function showUploadForm(Request $request){
        $data = $this->data;
        return view('topup/upload',$data);
    }

    public function upload(Request $request){
        $request->validate([
            'type' => 'required',
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $input = $request->input();
        $type = (int)$request->input('type');

        $file = $request->file;
        $filename = uniqid(date('dmY').'_').'.'.$file->getClientOriginalExtension();
        $file->move('upload', $filename);     
        $input['filename'] = $filename;
        $input['file_path'] = '/upload/'.$filename;

        $filePath = public_path().$input['file_path'];
        $data = \Excel::load($filePath, function($reader) {})->get();
        $rows = $data->toArray();
        $count = $total = 0;
        foreach($rows as $row){
            $count ++;
            $total += $row['tien_nap'];
        }
        //check quota user

        $user = \Auth::user();
        //insert telco
        $upload = new Upload();
        $upload->user_id = $user->id;
        $upload->parent_id = $user->id;
        $upload->type = $type;
        $upload->file = '/upload/'.$filename;
        $upload->discount = ($type == 1) ? 28 : 25;
        $upload->save();

        
        if(!empty($upload->id)){
            foreach($rows as $row){
                if(!empty($row['so_can_nap']) && !empty($row['tien_nap']) && !empty($row['thue_bao'])){
                    $slug = \Str::slug($row['thue_bao'], '-');
                    $data = [
                        'mobile' => $row['so_can_nap'],
                        'upload_id' => $upload->id,
                        'amount' => $row['tien_nap'],
                        'user_id' => $user->id,
                        'parent_id' => $user->id,
                        'type' => ($slug == 'tra-truoc') ? 1 : 2,
                        'telco' => $row['nha_mang'],
                        'telco_id' => 1,
                    ];
                    TopupMobile::dispatch($data);
                }
            }
            $input['count'] = $count;
            $input['total'] = $total;
            //update total price
            $upload->total_price = $total;
            $upload->save();
            return view('topup/result_upload',$input);
        }

        $request->session()->flash('message_success', 'Thêm mới Telco thành công');
        return redirect(route('topup_upload'));

    }

    public function topup_list(Request $request)
    {
        $data = $this->data;
        $filter = $request->all();
        //get list topup
        $data['listTopup'] = Topup::getListTopup($filter);
        $data['totalAmount'] = Topup::getTotalAmountTopup($filter);
        //get list telco
        $listTelco = Telco::where('status',1)->orderBy('id','asc')->get()->toArray();
        foreach($listTelco as $telco){
            $data['listTelco'][$telco['id']] = $telco;
        }

        //get list user
        $listUser = User::orderBy('id','asc')->get()->toArray();
        foreach($listUser as $user){
            $data['listUser'][$user['id']] = $user;
        }

        $data['filter'] = $filter;
        $data['status'] = [0 => 'Đang xử lý', 1 => 'Thành công'];
        return view('topup/topup_list',$data);
    }

    public function showTopupTraTruocForm(Request $request){
        $data = $this->data;
        $data['listTelco'] = Telco::where('status',1)->orderBy('id','asc')->get();
        $data['arrAmount'] = [50000,100000,200000,300000,500000,1000000];
        $data['type'] = 1;
        return view('topup/topup_mobile',$data);
    }

    public function showTopupTraSauForm(Request $request){
        $data = $this->data;
        $data['listTelco'] = Telco::where('status',1)->orderBy('id','asc')->get();
        $data['type'] = 2;
        return view('topup/topup_mobile',$data);
    }

    public function topup(Request $request){
        $request->validate([
            'type'      => 'required|integer',
        ]);

        $rules = [
            'telco'     => 'required',
            'mobile'    => 'required|digits:10',
        ];
        $type = (int)$request->input('type');
        
        switch ($type) {
            case 1:
                $rules['amount'] = 'required|integer';
                break;
            case 2:
                $rules['amount'] = 'required|integer|min:50000|max:1000000';
                break;
            default:
                break;
        }      
        $request->validate($rules);

        $input = $request->only('telco', 'amount','mobile','type');
        $user = \Auth::user();
        //check quota user

        $data = [
            'mobile' => $input['mobile'],
            'amount' => $input['amount'],
            'user_id' => $user->id,
            'parent_id' => $user->id,
            'type' => $type,
            'telco_id' => (int)$input['telco'],
        ];
        TopupMobile::dispatch($data);
        $data['telco'] = Telco::find((int)$input['telco']);
        return view('topup/result_topup',$data);
    }

}
