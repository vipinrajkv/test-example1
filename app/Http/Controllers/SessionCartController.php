<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class SessionCartController extends Controller
{
    /**
     * Product List Page
     */
    public function index(){
        $productData = DB::table('tbl_product')->get();
        $product = Session::get('Cart') ?: '';
        // Session::flush('Cart');
        
        // return view('session_cart', ['productlist' =>$productData, 'productItems' => $product]);
        return view('layouts.frontend.product', ['productlist' =>$productData, 'productItems' => $product]);
        // return view('layouts.backend.adminHome', ['productlist' =>$productData, 'productItems' => $product]);

    }

    /**
     * Cart Listing
     * 
     */
    public function getCartItems(){

    }

    /**
     * List Page
     */
    public function cartList(){
        // $productData = DB::table('tbl_product')->get();
 
        $cartProduct = Session::get('Cart') ?: '';
        return view('cart_list', ['productItems' => $cartProduct]);
    }

    /**
     * Add To Cart
     * 
     */
    public function addCart(Request $request)
    {
        $productId = (int)$request->input('productId');
        $productQty = $request->input('productQty');
        $productData = DB::table('tbl_product')->find($productId);
        $productName = $productData->name;

        if (Session::has('Cart')) {
            $cartData = Session::get('Cart');

            if (array_key_exists($productId, $cartData)) {

                if ($cartData[$productId]['item_id'] === $productId) {
                    $cartData[$productId]['item_qty'] === $productQty;
                    $itemName = $cartData[$productId]['item_name'];
                    Session::forget('Cart');
                    session::put('Cart', $cartData);

                    return response()->json(['status' => '"' . $itemName . '" Already Added to Cart']);
                }
            } else {
                $cartData = Session::get('Cart');
                $cartData[$productData->id] = $this->setCartData($productData, $productQty);
                $cartItems =  $cartData;
                Session::forget('Cart');
                session::put('Cart', $cartData);

                return response()->json(['status' => '"' . $productName . '" Added to cart']);
            }
        } else {
            $itemListArray[$productData->id] = $this->setCartData($productData, $productQty);
            $cartItems =  $itemListArray;
            session::put('Cart', $cartItems);

            return response()->json(['status' => '"' . $productName . '" Added to cart']);
        }
    }
    /**
     * 
     */
    protected function setCartData($productData, $productQty){

    return $cart =  [
            'item_id' => $productData->id,
            'item_name' => $productData->name,
            'item_price' => $productData->price,
            'item_qty' => $productQty,
            'item_image' => $productData->image,
        ];
    }

    /**
     * To remove item from cart
     *
     * @param Request $request
     * @return void
     */
    public function removeCartItem(Request $request)
    {
        $productId = (int)$request->input('productItem');
        $productData = DB::table('tbl_product')->find($productId);
        $cartData = Session::get('Cart');

        if (Session::has('Cart')) {

            if (array_key_exists($productId, $cartData)) {
                   $itemName = $cartData[$productId]['item_name'];
                    unset($cartData[$productId]);
                    Session::forget('Cart');
                    session::put('Cart', $cartData);

                    return response()->json(['status' => '"' . $itemName . '" Already Added to Cart']);
            }
        }

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function checkOutView() {
        $cartProduct = Session::get('Cart') ?: '';
        return view('layouts.frontend.check_out', ['productItems' => $cartProduct]);
    }
}
