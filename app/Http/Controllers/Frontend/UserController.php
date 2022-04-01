<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::id())->get();
        // dd($orders);
        return view('frontend.orders.index',['orders'=>$orders]);
    }

    public function view($id)
    {
        // dd('hi');
        $orders = Order::where('id',$id)->where('user_id',Auth::id())->first();
        // dd($orders);
        return view('frontend.orders.view',['orders'=>$orders]);
        # code...
    }

}
