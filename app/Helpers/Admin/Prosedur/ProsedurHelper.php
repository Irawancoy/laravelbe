<?php 

namespace App\Helpers\Admin\Prosedur;

use App\Models\Admin\ProsedurModel;
use App\Repository\CrudInterface;

class ProsedurHelper
{
     protected $prosedurModel;

     public function __construct()
     {
         $this->prosedurModel = new ProsedurModel();
     }

     public function getAll(): object
     {
         return $this->prosedurModel->getAll();
     }

     /**
      * Mengambil 1 data item dari tabel m_item
      *
      * @param  integer $id id dari tabel m_item
      * @return object
      */
     public function getById(int $id): object
     {
         return $this->prosedurModel->getById(($id));
     }

     public function create(array $payload): array
     {
         try {
             $newItem = $this->prosedurModel->store($payload);

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
         $this->prosedurModel->edit($payload, $id);
           $updateItem = $this->getById($id);

             return [
                 'status' => true,
                 'data' => $updateItem
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
            $this->prosedurModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


}