<?php 
namespace App\Helpers\Admin\Slider;
use App\Models\Admin\SliderModel;

class SliderHelper
{
     protected $sliderModel;
     public function __construct()
     {
         $this->sliderModel = new SliderModel();
     }
     public function getAll(): object
     {
         return $this->sliderModel->getAll();
     }
     public function getById(int $id): object
     {
         return $this->sliderModel->getById(($id));
     }

     public function create(array $payload): array
     {
         try {
             if(!empty($payload['gambar'])) {
                 // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
                 $payload['gambar']->store('/public/upload/fotoSlider');
                 $fotodb = $payload['gambar']->store('/upload/fotoSlider');
                 $payload['gambar'] = $fotodb;

             }
             $newItem = $this->sliderModel->store($payload);

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
             if(!empty($payload['gambar'])) {
                 // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
                 $payload['gambar']->store('/public/upload/fotoSlider');
                 $fotodb = $payload['gambar']->store('/upload/fotoSlider');
                 $payload['gambar'] = $fotodb;

             }
             $newItem = $this->sliderModel->edit($payload, $id);

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
     public function delete(int $id): bool
     {
         try {
             $this->sliderModel->drop($id);
             return true;
         } catch (\Throwable $th) {
             return false;
         }
     }
}