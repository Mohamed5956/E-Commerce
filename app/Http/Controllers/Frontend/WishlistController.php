<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',['wishlist'=>$wishlist]);
    }

    public function store(Request $request)
    {
        if (Auth::check())
        {
            $prod_id = $request->input('product_id');
            if(Product::find($prod_id))
            {
                $wish = new Wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(['status','Added To Wishlist']);
            }
            else{
                return response()->json(['status','Product Doesnt exists']);
            }
        }
        else
        {
            return response()->json(['status','LogIn To Continue']);
        }
    }

    public function delete(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $WishlistItem = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $WishlistItem->delete();
                return response()->json(['status','Product Deleted Succesfully']);
            }
        }else{
            return response()->json(['status','Please Login to Continue']);
        }
    }

    public function wishcount()
    {
        $wishcount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishcount]);
    }

}
