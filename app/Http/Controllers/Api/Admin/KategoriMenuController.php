<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Admin\KategoriMenu\KategoriMenuHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\KategoriMenu\KategoriMenuCollection;
use App\Http\Requests\Admin\KategoriMenu\CreateRequest;
use App\Http\Requests\Admin\KategoriMenu\UpdateRequest;
use App\Http\Resources\Admin\KategoriMenu\DetailResource;
use App\Http\Resources\Admin\KategoriMenu\KategoriMenuResource;

class KategoriMenuController extends Controller
{
    protected $kategorimenu;

    public function __construct()
    {
        $this->kategorimenu = new KategoriMenuHelper();
    }

    public function index(Request $request)
    {
        $filter = ['nama' => $request->nama ?? ''];
        $items = $this->kategorimenu->getAll($filter, 5, $request->sort ?? '');
        // dd($items);


        return response()->success(new KategoriMenuCollection($items));
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


        $dataInput = $request->only(['nama', 'deskripsi','status']);
        // dd($dataInput);
        $dataItem = $this->kategorimenu->create($dataInput);
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
        $dataItem = $this->kategorimenu->getById($id);

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

        $dataInput = $request->only(['nama', 'deskripsi', 'status','id']);
        // dd($dataInput);
        $dataItem = $this->kategorimenu->update($dataInput,$dataInput['id']);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error']);
        }

        return response()->success(new KategoriMenuResource($dataItem['data']), 'Data item berhasil diperbarui');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = $this->kategorimenu->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }

}
