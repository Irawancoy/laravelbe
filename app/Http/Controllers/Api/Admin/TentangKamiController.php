<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\TentangKami\TentangKamiHelper;
use App\Http\Requests\Admin\TentangKami\CreateRequest;
use App\Http\Requests\Admin\TentangKami\UpdateRequest;
use App\Http\Resources\Admin\TentangKami\TentangKamiCollection;
use App\Http\Resources\Admin\TentangKami\TentangKamiResource;
use App\Http\Resources\Admin\TentangKami\DetailResource;


class TentangKamiController extends Controller
{
    protected $tentangkami;

    public function __construct()
    {
        $this->tentangkami = new TentangKamiHelper();
    }

    public function index()
    {
      
        $items = $this->tentangkami->getAll();
        // dd($items);
        return response()->success(new TentangKamiCollection($items));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TentangKami  $request
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
        // dd($request);

        $dataInput = $request->only(['judul', 'deskripsi', 'gambar']);
    //    dd($dataInput);
        $dataItem = $this->tentangkami->create($dataInput);
        // dd($dataItem);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error'], 422);
        }

        return response()->success($dataItem, 'Data item berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TentangKami  $tentangkami
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {
        $dataItem = $this->tentangkami->getById($id);
        // dd($item);
        if (empty($dataItem)) {
            return response()->failed(['Data item tidak ditemukan']);
        }

        return response()->success(new DetailResource($dataItem));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TentangKami  $request
     * @param  \App\Models\TentangKami  $tentangkami
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateRequest $request)

    {
        
        // dd($item);

        /**
        * Menampilkan pesan error ketika validasi gagal
        * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
        */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $dataInput = $request->only(['id','judul', 'deskripsi', 'gambar']);
        $dataItem = $this->tentangkami->update( $dataInput, $dataInput['id']);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error']);
        }

        return response()->success(new TentangKamiResource($dataItem['data']), 'Data item berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TentangKami  $tentangkami
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = $this->tentangkami->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }
}
