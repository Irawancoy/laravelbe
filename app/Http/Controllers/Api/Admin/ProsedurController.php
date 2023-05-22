<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Prosedur\ProsedurHelper;
use App\Http\Resources\Admin\Prosedur\ProsedurResource;
use App\Http\Resources\Admin\Prosedur\ProsedurCollection;
use App\Http\Resources\Admin\Prosedur\DetailResource;
use App\Http\Requests\Admin\Prosedur\UpdateRequest;
use App\Http\Requests\Admin\Prosedur\CreateRequest;

class ProsedurController extends Controller
{
    protected $prosedur;

    public function __construct()
    {
        $this->prosedur = new ProsedurHelper();
    }

    public function index()
    {
        $items = $this->prosedur->getAll();
        // dd($items);

        return response()->success(new ProsedurCollection($items));
    }

    public function store(CreateRequest $request)
    {
        /**
        * Menampilkan pesan error ketika validasi gagal
        * pengaturan validasi bisa dilihat pada class app/Http/request/User/CreateRequest
        */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $dataInput = $request->only(['nomer','deskripsi']);
        // dd($dataInput);
        $dataItem = $this->prosedur->create($dataInput);
        // dd($dataItem);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error'], 422);
        }

        return response()->success($dataItem, 'Data item berhasil disimpan');

    }

    public function show($id)
    {
        $item = $this->prosedur->getById($id);
        // dd($item);
      if (empty($item)) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }

        return response()->success(new DetailResource($item));
    }

    public function update(UpdateRequest $request)
    {
        /**
        * Menampilkan pesan error ketika validasi gagal
        * pengaturan validasi bisa dilihat pada class app/Http/request/User/CreateRequest
        */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $dataInput = $request->only(['nomer','deskripsi','id']);
        // dd($dataInput);
        $dataItem = $this->prosedur->update($dataInput, $dataInput['id']);
        // dd($dataItem);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error']);
        }

        return response()->success(new ProsedurResource($dataItem['data']), 'Data item berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dataItem = $this->prosedur->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }
}
