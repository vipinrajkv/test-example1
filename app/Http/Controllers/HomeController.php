<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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

    public function login(Request $request)
    {   
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
     
        // if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        // {
        //     if (auth()->user()->type == 'admin') {
        //         return redirect()->route('admin.home');
        //     }else if (auth()->user()->type == 'manager') {
        //         return redirect()->route('manager.home');
        //     }else{
        //         return redirect()->route('home');
        //     }
        // }else{
        //     return redirect()->route('login')
        //         ->with('error','Email-Address And Password Are Wrong.');
        // }
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
        
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully'.$user->name,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } 
}
