<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',['cartItems'=>$cartItems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if(Gate::allows('isUser')){
            $prod_check = Product::where('id',$product_id)->first();
            if($prod_check){
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name.' Already  Added To Cart']);
                }else
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name.' Added To Cart']);
                }
            }
        }
        else
        {
            return response()->json(['status' => 'Log in To Continue']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status','Product Deleted Succesfully']);
            }
        }else{
            return response()->json(['status','Please Login to Continue']);
        }
    }

    public function deleteprod(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status','Product Deleted Succesfully']);
            }
        }else{
            return response()->json(['status','Please Login to Continue']);
        }
    }

    public function updatecart(Request $request){
        $prod_id = $request->input('prod_id');
        $quantity = $request->input('quantity');

        if(Auth::check()){
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $quantity;
                $cart->update();
                return response()->json(['status','Quantity Updated']);
            }
        }
    }

    public function cartcount()
    {
        $cartcount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartcount]);
    }


}
