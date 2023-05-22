<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Layanan\LayananHelper;
use App\Http\Resources\Admin\Layanan\LayananCollection;
use App\Http\Requests\Admin\Layanan\CreateRequest;
use App\Http\Resources\Admin\Layanan\DetailResource;
use App\Http\Requests\Admin\Layanan\UpdateRequest;
use App\Http\Resources\Admin\Layanan\LayananResource;

class LayananController extends Controller
{
    protected $layanan;

    public function __construct()
    {
        $this->layanan = new LayananHelper();
    }

    public function index()
    {
       
        $items = $this->layanan->getAll();
        // dd($items);

        return response()->success(new LayananCollection($items));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        /**
        * Menampilkan pesan error ketika validasi gagal
        * pengaturan validasi bisa dilihat pada class app/Http/request/User/CreateRequest
        */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }


        $dataInput = $request->only(['nama', 'deskripsi', 'harga1jam','harga3jam','status','gambar']);
        // dd($dataInput);
        $dataItem = $this->layanan->create($dataInput);
        // dd($dataItem);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error'], 422);
        }

        return response()->success($dataItem, 'Data item berhasil disimpan');

    }
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataItem = $this->layanan->getById($id);

        if (empty($dataItem)) {
            return response()->failed(['Data item tidak ditemukan']);
        }

        return response()->success(new DetailResource($dataItem));
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $dataInput = $request->only(['nama', 'deskripsi', 'harga1jam','harga3jam', 'status','id','gambar']);
        // dd($dataInput);
        $dataItem = $this->layanan->update($dataInput,$dataInput['id']);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error']);
        }

        return response()->success(new LayananResource($dataItem['data']), 'Data item berhasil diperbarui');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = $this->layanan->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }


}
