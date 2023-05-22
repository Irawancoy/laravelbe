<?php

namespace App\Helpers\Client\Keranjang;

use App\Models\Client\UserModel;
use App\Models\Admin\MenuModel;
use App\Models\Admin\LayananModel;
use App\Models\Client\KeranjangModel;

class KeranjangHelper
{
    protected $userModel;
    protected $menuModel;
    protected $layananModel;
    protected $cartModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->layananModel = new LayananModel();
        $this->cartModel = new KeranjangModel();
    }

    /**
     * Menambahkan item ke keranjang
     *
     * @param int $userId
     * @param int $ruanganId
     * @param array $menuIds
     * @param string $duration
     * @return array
     */
    public function addToCart(int $userId, int $ruanganId, int $menuId, string $duration): array
    {
        try {
            // Cek apakah user dengan $userId ada
            $user = $this->userModel->getById($userId);
            if (!$user) {
                 return [
                      'status' => false,
                      'error' => 'User not found.'
                    ];
               }
               // dd($user);
               
               // Cek apakah ruangan dengan $ruanganId ada
               $ruangan = $this->layananModel->getById($ruanganId);
               if (!$ruangan) {
                    return [
                         'status' => false,
                         'error' => 'Ruangan not found.'
                    ];
               }
               
               // Cek apakah semua menu dengan $menuIds ada
               $menus = $this->menuModel->getById($menuId);
               // dd($menus);
               // if (count($menus) !== count($menuId)) {
               //      return [
               //           'status' => false,
               //           'error' => 'One or more menus not found.'
               //      ];
               // }
            
               // Simpan item ke keranjang
               $cart = $this->cartModel->store([
                    'id_customer' => $userId,
                    'id_ruangan' => $ruanganId,
                    'id_menu' => $menuId,
                    'duration' => $duration
               ]);
               // dd($userId);

            return [
                'status' => true,
                'data' => $cart
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * Menghapus item dari keranjang
     *
     * @param int $cartId
     * @return bool
     */
    public function removeFromCart(int $cartId): bool
    {
        try {
            $this->cartModel->drop($cartId);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Menghapus semua item dari keranjang
     *
     * @param int $userId
     * @return bool
     */
    public function clearCart(int $userId): bool
    {
        try {
            $this->cartModel->clearCartByUserId($userId);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Mengambil semua item dalam keranjang untuk user tertentu
     *
     * @param int $userId
     * @return array
     */
    public function getCartItems(int $userId): array
    {
        try {
            $cartItems = $this->cartModel->getCartItemsByUserId($userId);
// dd($cartItems);
            return [
                'status' => true,
                'data' => $cartItems
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * Menghitung total harga dalam keranjang untuk user tertentu
     *
     * @param int $userId
     * @return float
     */
    public function calculateTotalPrice(int $userId): float
    {
        try {
            $totalPrice = $this->cartModel->calculateTotalPriceByUserId($userId);
            return $totalPrice;
        } catch (\Throwable $th) {
            return 0.0;
        }
    }
}
