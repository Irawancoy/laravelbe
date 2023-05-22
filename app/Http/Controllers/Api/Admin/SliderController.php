<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Slider\SliderHelper;
use App\Http\Requests\Admin\Slider\CreateRequest;
use App\Http\Requests\Admin\Slider\UpdateRequest;
use App\Http\Resources\Admin\Slider\SliderCollection;
use App\Http\Resources\Admin\Slider\SliderResource;
use App\Http\Resources\Admin\Slider\DetailResource;

class SliderController extends Controller
{
    protected $slider;

    public function __construct()
    {
        $this->slider = new SliderHelper();

    }
    public function index(){
        $items=$this->slider->getAll();
        return response()->success(new SliderCollection($items));
    }
    public function store(CreateRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }


        $dataInput = $request->only(['gambar']);
        // dd($dataInput);
        $dataItem = $this->slider->create($dataInput);
        // dd($dataItem);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error'], 422);
        }

        return response()->success($dataItem, 'Data item berhasil disimpan');


    }
    public function show($id)
    {
        $item = $this->slider->getById($id);
        if (!$item) {
            return response()->failed('Data item tidak ditemukan', 404);
        }

        return response()->success(new DetailResource($item));
    }
    public function update(UpdateRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $dataInput = $request->only(['id', 'gambar']);
        $dataItem = $this->slider->update($dataInput,$dataInput['id']);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error'], 422);
        }

        return response()->success($dataItem, 'Data item berhasil diubah');
    }

    public function destroy($id)
    {
        $dataItem = $this->slider->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }
    
}
