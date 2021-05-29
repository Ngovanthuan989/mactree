<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {

    }

    public function add()
    {
        return view('dashboard.slider.add');
    }

    public function addPost(Request $request)
    {
        if ($request->file('slider_img') != '') {
            $path = public_path() . '/uploads/images/';

            //upload new file
            $file     =    $request->file('slider_img');
            $filename =    $file->getClientOriginalName();
            $file->move($path, $filename);
            $validate = Validator::make(

                $request->all(),
                [
                    'name'        => 'required',
                    'content'     => 'required',
                ],
                [
                    'name.required'          => 'Tên slider không được bỏ trống',
                    'content.required'       => 'Nội dung không được để trống',
                ]

            );


            if ($validate->fails()) {
                return redirect()->route('dashboard.slider.add')->withErrors($validate);
            }


            $slider = new Slider;

            $slider->name        = $request->get('name');
            $slider->code        = mt_rand(1000,9999);
            $slider->slider_img  = $filename;
            $slider->content     = $request->get('content');
            $slider->status      = $request->get('status');

            $slider->save();

            if ($slider->wasRecentlyCreated == true) {

                return redirect()->route('dashboard.slider.add')->with('success', 'Thêm slider thành công');
            } else {

                return redirect()->route('dashboard.slider.add')->with('error', 'Có lỗi xảy ra');
            }
        } else {

            return redirect()->route('dashboard.slider.add')->with('error', 'Xin vui lòng chọn ảnh cho slider');
        }
    }
}
