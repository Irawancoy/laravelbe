<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Client\Keranjang\KeranjangHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\client\Keranjang\KeranjangCollection;
use App\Http\Resources\client\Keranjang\KeranjangResource;

class KeranjangController extends Controller
{
    protected $cart;

    public function __construct()
    {
        $this->cart = new KeranjangHelper();
    }

    /**
     * Menambahkan item ke keranjang
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $userId = $request->input('id_customer');
        $ruanganId = $request->input('id_ruangan');
        $menuIds = $request->input('id_menu');
        $duration = $request->input('duration');
// dd($userId, $ruanganId, $menuIds, $duration);
        $result = $this->cart->addToCart($userId, $ruanganId, $menuIds, $duration);
// dd($result);
        if ($result['status']) {
            return response()->success(new KeranjangResource($result['data']), 'Item added to cart successfully');
        } else {
            return response()->failed($result['error'], 422);
        }
    }

    /**
     * Menghapus item dari keranjang
     *
     * @param int $cartId
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(int $cartId)
    {
        $result = $this->cart->removeFromCart($cartId);

        if ($result) {
            return response()->success(['message' => 'Item removed from cart successfully']);
        } else {
            return response()->failed(['message' => 'Failed to remove item from cart']);
        }
    }

    /**
     * Menghapus semua item dari keranjang untuk user tertentu
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function clearCart(int $userId)
    {
        $result = $this->cart->clearCart($userId);

        if ($result) {
            return response()->success(['message' => 'Cart cleared successfully']);
        } else {
            return response()->failed(['message' => 'Failed to clear cart']);
        }
    }

    /**
     * Mengambil semua item dalam keranjang untuk user tertentu
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function getCartItems(int $userId)
    {
        $result = $this->cart->getCartItems($userId);
        // dd($result);

        if ($result['status']) {
            // return response()->success(new KeranjangCollection($result['data']));
            return response()->success($result['data']);
        } else {
            return response()->failed($result['error']);
        }
    }

    /**
     * Menghitung total harga dalam keranjang untuk user tertentu
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function calculateTotalPrice(int $userId)
    {
        $totalPrice = $this->cart->calculateTotalPrice($userId);

        return response()->success(['total_price' => $totalPrice]);
    }
}
