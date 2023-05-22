<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Admin\Menu\MenuHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Menu\CreateRequest;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Http\Resources\Admin\Menu\MenuCollection;
use App\Http\Resources\Admin\Menu\MenuResource;
use App\Http\Resources\Admin\Menu\DetailResource;

class MenuController extends Controller
{
    protected $menu;

    public function __construct()
    {
        $this->menu = new MenuHelper();
    }

    public function index()
    {
      
        $items = $this->menu->getAll();
        // dd($items);


        return response()->success(new MenuCollection($items));
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
        // dd($request);

        $dataInput = $request->only(['nama', 'deskripsi', 'harga','status','gambar','kategori']);
       
        $dataItem = $this->menu->create($dataInput);
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
        $dataItem = $this->menu->getById($id);

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

        $dataInput = $request->only(['nama', 'deskripsi', 'harga', 'status','id','gambar','kategori']);
        // dd($dataInput);
        $dataItem = $this->menu->update($dataInput,$dataInput['id']);
        if (!$dataItem['status']) {
            return response()->failed($dataItem['error']);
        }

        return response()->success(new MenuResource($dataItem['data']), 'Data item berhasil diperbarui');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = $this->menu->delete($id);

        if (!$dataItem) {
            return response()->failed(['Mohon maaf data item tidak ditemukan']);
        }
        // dd($dataItem);
        return response()->success(['Data Berhasil Dihapus']);
    }
}
