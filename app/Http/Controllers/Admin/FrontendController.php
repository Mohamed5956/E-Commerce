<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(){
        $ordersFinished= Order::where('status','1')->get();
        $ordersProgress= Order::where('status','0')->get();
        $users = User::all();
        $category = Category::all();
        $products = Product::all();
        return view('admin.index',[
            'ordersFinished'=>$ordersFinished,
            'ordersProgress'=>$ordersProgress,
            'users'=>$users,
            'category'=>$category,
            'products'=>$products
        ]);
    }
}
