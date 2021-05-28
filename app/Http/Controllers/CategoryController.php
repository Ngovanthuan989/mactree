<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorys;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function index()
    {
        $get_category=DB::table('category')->get();
        return view('dashboard.category.show',
            ['get_category'=>$get_category]
        );
    }

    public function add()
    {
        return view('dashboard.category.add');
    }

    public function edit($id)
    {
        $edit_category = DB::table('category')->where([
            'category_code'=> $id
        ])->get();
        return view('dashboard.category.edit',
            ['edit_category'=>$edit_category[0]]
        );
    }

    public function update(Request $request)
    {
        if (!$request->get('category_name')) {
            return response('Tên danh mục không được để trống!',400);
        }
        if (!$request->get('category_code')) {
            return response('Mã danh mục không được để trống!',400);
        }

        $get_category=DB::table('category')->select('category_code')->get();

        $array_code=[];

        foreach ($get_category as $key => $value) {
            array_push ($array_code, $value->category_code);
        }

        $check_code_category = in_array($request->get('category_code'),$array_code);

        if ($check_code_category==true) {
            return response('Mã danh mục này đã tồn tại!',400);
        }

        $update = Categorys::where('id',$request->get('id'))->update(array(
            'category_name' => $request->get('category_name'),
            'category_code' => $request->get('category_code'),
            'status'        => $request->get('status'),
        ));

        if ($update==1) {
            return response('Cập nhập danh mục thành công!');
        }else{
            return response('Cập nhập danh mục không thành công!',400);
        }

    }

    public function addPost(Request $request)
    {
        if (!$request->get('category_name')) {
            return response('Tên danh mục không được để trống!',400);
        }
        if (!$request->get('category_code')) {
            return response('Mã danh mục không được để trống!',400);
        }

        $get_category=DB::table('category')->select('category_code')->get();
        $array_code=[];
        foreach ($get_category as $key => $value) {
            array_push ($array_code, $value->category_code);
        }

        $check_code_category = in_array($request->get('category_code'),$array_code);

        if ($check_code_category==true) {
            return response('Mã danh mục này đã tồn tại!',400);
        }

        $category = new Categorys;
        $category -> category_name = $request->get('category_name');
        $category -> category_code = $request->get('category_code');
        $category -> status = $request->get('status');
        $category -> save();

        if ($category->wasRecentlyCreated == true) {
            return response('Thêm danh mục thành công!');
        }else{
            return response('Thêm danh mục không thành công!',400);
        }
    }

    public function delete(Request $request)
    {
        $delete = DB::table('category')->where('id', $request->get('id'))->delete();
        if ($delete==1) {
            return response('Xoá danh mục thành công!');
        }else{
            return response('Xoá danh mục không thành công!',400);
        }
    }
}
