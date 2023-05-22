<?php

namespace App\Helpers\Admin\KategoriMenu;

use App\Models\Admin\KategoriMenuModel;
use App\Repository\CrudInterface;

class KategoriMenuHelper implements CrudInterface
{
    protected $kategoriMenuModel;

    public function __construct()
    {
        $this->kategoriMenuModel = new KategoriMenuModel();
    }


    public function getAll(array $filter, int $itemPerPage = 0, string $sort = ''): object
    {
        return $this->kategoriMenuModel->getAll($filter, $itemPerPage, $sort);
    }

    /**
     * Mengambil 1 data item dari tabel m_item
     *
     * @param  integer $id id dari tabel m_item
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->kategoriMenuModel->getById(($id));
    }

    public function create(array $payload): array
    {
        try {
            $newItem = $this->kategoriMenuModel->store($payload);

            // dd($newItem);

            return [
                'status' => true,
                'data' => $newItem
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function update(array $payload, int $id): array
    {
        try {

            $this->kategoriMenuModel->edit($payload, $id);

            // $dataItem = $this->getById($updateItem);
            $dataItem = $this->getById($id);


            return [
                'status' => true,
                'data' => $dataItem
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function delete(int $id): bool
    {
        try {
            $this->kategoriMenuModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

