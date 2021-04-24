<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $get_permission=DB::table('permission')->get();
        return view('dashboard.permission.show',
            ['get_permission'=>$get_permission]
        );
    }

    public function add()
    {
        return view('dashboard.permission.add');
    }

    public function addPost(Request $request)
    {
        if (!$request->get('per_name')) {
            return response('Tên quyền truy cập không được để trống!',400);
        }
        if (!$request->get('per_code')) {
            return response('Mã quyền truy cập không được để trống!',400);
        }

        $get_permission=DB::table('permission')->select('permission_code')->get();

        $array_code=[];

        foreach ($get_permission as $key => $value) {
            array_push ($array_code, $value->permission_code);
        }

        $check_code_permission = in_array($request->get('per_code'),$array_code);

        if ($check_code_permission == true) {
            return response('Mã quyền truy cập này đã tồn tại!',400);
        }

        $permission = new Permission;
        $permission -> permission_name = $request->get('per_name');
        $permission -> permission_code = $request->get('per_code');
        $permission -> status          = $request->get('status');
        $permission -> save();

        if ($permission->wasRecentlyCreated == true) {
            return response('Thêm quyền truy cập thành công!');
        }else{
            return response('Thêm quyền truy cập không thành công!',400);
        }
    }

    public function edit($id)
    {
        $edit_permission = DB::table('permission')->where([
            'permission_code'=> $id
        ])->get();

        return view('dashboard.permission.edit',
            ['edit_permission'=>$edit_permission[0]]
        );
    }


    public function update(Request $request)
    {
        if (!$request->get('permission_name')) {
            return response('Tên quyền truy cập không được để trống!',400);
        }
        if (!$request->get('permission_code')) {
            return response('Mã quyền truy cập không được để trống!',400);
        }

        $get_permission=DB::table('permission')->select('permission_code')->get();

        $array_code=[];

        foreach ($get_permission as $key => $value) {
            array_push ($array_code, $value->permission_code);
        }

        $check_code_permission = in_array($request->get('permission_code'),$array_code);

        if ($check_code_permission == true) {
            return response('Mã quyền truy cập này đã tồn tại!',400);
        }

        $update = Permission::where('id',$request->get('id'))->update(array(
            'permission_name' => $request->get('permission_name'),
            'permission_code' => $request->get('permission_code'),
            'status' => $request->get('status'),
        ));

        if ($update==1) {
            return response('Cập nhập quyền truy cập thành công!');
        }else{
            return response('Cập nhập quyền truy cập không thành công!',400);
        }

    }

    public function delete(Request $request)
    {
        $delete = DB::table('permission')->where('id', $request->get('id'))->delete();
        if ($delete==1) {
            return response('Xoá quyền truy cập thành công!');
        }else{
            return response('Xoá quyền truy cập không thành công!',400);
        }
    }


}
