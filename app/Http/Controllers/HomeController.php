<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderList;
class HomeController extends Controller
{
    private $order;
    private $orderList;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Order $order,
        OrderList $orderList
        )
    {
        $this->order = $order ;
        $this->orderList = $orderList ;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDashboard()
    {
        return view('layouts.backend.adminHome');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDashboardPreview()
    {
        return view('layouts.backend.adminHomeDesign');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllOrders()
    {
       $ordersList =  $this->order->getOrderList();
        return response()->json(['ordersList' =>$ordersList],200);
    }

    /**
     * get Order Details.
     * @param integer $orderId
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOrderDetails(int $orderId)
    {
       $orders =  $this->orderList->getOrdersList($orderId);
        return response()->json(['ordersItems' =>$orders],200);
    }

    /**
     * get Order Details.
     * @param integer $orderId
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOrderUserDetails(int $orderId)
    {
       $orders =  $this->order->getOrderUserData($orderId);
        return response()->json(['userDetails' => $orders],200);
    }
}
