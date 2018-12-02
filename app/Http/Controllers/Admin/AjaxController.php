<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Response,
    Validator,
    Mail,
    Redirect,
    DateTime,
    URL,
    DB,
    Config,
    Image,
    Session;

class AjaxController extends Controller {


	public function changeStatus(Request $request) {

        $table = $request->table;
        $id = $request->id;

        $query = 'UPDATE `' . $table . '` SET `status` = IF(`status` = "1", "0", "1") WHERE `id` = "' . $id . '"';
        $result = DB::update($query);
        if ($result) {
            die('1');
        } else {
            die('0');
        }
    }

	public function hardDelete(Request $request) 
    {
        
        $table = $request->table;
        $id = $request->id;

        $where = array('id' => $id);
        $result = DB::table($table)->where($where)->delete();

        if ($result) {
            die('1');
        } else {
            die('0');
        }
    }



    public function getAllData(Request $request) {

        $id = $request->get('id');
        $find_id = $request->get('find_id');
        $tableName = decode($request->get('table_name'));
        $result = DB::table($tableName)->select('id', 'name')->where(array($find_id => $request->get('id'), 'status' => '1'))->get();
        if (count($result) > 0) {
            $res = array('success' => true, 'message' => 'Record Successfully Found', 'result' => $result);
            return Response::json($res);
        } else {
             $res = array('success' => false, 'message' => 'Record not Found', 'result' => array());
            return Response::json('0');
        }
    }

}