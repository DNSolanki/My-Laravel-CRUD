<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Validator,
    Session,
    Redirect,
    Response,
    DB,
    Config,
    File;
use Mail,
    Auth;
use App\User;
use App\Models\{Country,State,City};

class UserController extends Controller {

    public function index(Request $request) {
        $data['title'] = 'Users List';

        if (request()->ajax()) {
            return datatables()->of(User::select([
                        'id', 'name', 'email', 'mobile_number', 'address', 'created_at', 'status'
            ]))
            ->editColumn('status', 'datatable.status')
            ->editColumn('created_at', function($created_at) {
                return date(Config::get('constants.DATE_FORMAT'), strtotime($created_at['created_at']));
            })
            ->addIndexColumn()
            ->addColumn('action', 'datatable.user-action')
            ->rawColumns(['status', 'action'])
            ->make(true);
        }

        return view('admin.user.list', $data);
    }

    public function create() {
        $data['title'] = 'Add User';
        $data['user_info'] = array();
        $data['all_country'] = Country::where('status', 1)->get();
        
        return view('admin.user.addEditUser', $data);
    }

    public function edit($id) {
        $id = decode($id);
        $data['title'] = 'Edit User';
        $where = array('users.id' => $id);
        $field = array('users.*', 'state.id as state_id','country.id as country_id');
        $data['user_info'] = User::where($where)
                        ->leftjoin('city', 'city.id', '=', 'users.city_id')
                        ->leftjoin('state', 'state.id', '=', 'city.state_id')
                        ->leftjoin('country', 'country.id', '=', 'state.country_id')
                        ->first($field);
        
        $data['all_country'] = Country::where('status', 1)->get();

        return view('admin.user.addEditUser', $data);
    }

    public function store(Request $request) {

        $id = $request->userId;

        $dataInfo = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required|unique:users,mobile_number,' . $id,
            'email' => 'email|unique:users,email,' . $id,
            'address' => 'required',
            'phone_code' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'city_id' => 'required',
        ]);

        /*if ($files = $request->file('image')) {
            if ($request->old_path) {
                \File::delete('public/ads/' . $request->old_path);
            }
            $destinationPath = 'public/ads/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $dataInfo['avatar'] = "$profileImage";
        }*/

             if(!empty($data['image']))
            {
                $deleteFile = '';
                if(!empty($id)){
                    $getData = User::where('id', $id)->first(array('image'));
                    $deleteFile = $getData->image;
                }
                $data['image'] = storeAvatar(@$data['image'],'user','avatars', $deleteFile);
            }

            /*if ($request->hasFile('pricing_file')) {
                $data['pricing_file'] = 'storage/'.$data['pricing_file']->store('pricing', 'public');
            }*/

           /* if(!empty($request->file('image'))){
                $dataInfo['image'] = storeAvatar(@$request->file('image'),'user','avatars');
            }*/
        //print_r($dataInfo); die;

        if (!empty($id)) {

            $dataInfo['updated_at'] = date('Y-m-d H:i:s');

            User::where(array('id' => $id))->update($dataInfo);

            return Redirect::to("admin/users")->withSuccess('Great! info has been updated.');
        } else {

            $dataInfo['password']   = bcrypt(123456);
            $dataInfo['type']       = 'Shop' ;
            $dataInfo['status']     = '1' ;
            $dataInfo['created_by'] = auth()->user()->id ;
            $dataInfo['created_at'] = date('Y-m-d H:i:s');
            $dataInfo['updated_at'] = date('Y-m-d H:i:s');

            $check = User::insertGetId($dataInfo);

            return Redirect::to("admin/users")->withSuccess('Great! info has been added.');
        }
    }

}
