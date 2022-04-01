<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($slug)
    {
        $product = Product::where('slug',$slug)->where('status','1')->first();

        if($product){
            $prod_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',['review'=>$review]);
            }else{
                $verified_purchase = Order::where('orders.user_id',Auth::id())
                ->join('order_items','orders.id','order_items.order_id')
                ->where('order_items.prod_id',$prod_id)->get();
                return view('frontend.reviews.index',[
                    'product'=>$product,
                    'verified_purchase'=>$verified_purchase
                ]);
            }
        }else{
            return redirect()->back()->with('status','the link was broken');
        }
    }

    public function store(Request $request){
        $prod_id = $request->input('prod_id');
        $product = Product::where('id',$prod_id)->where('status','1')->first();
        if($product){
            $user_review = $request->input('user_review');
            $new_review = Review::create(
                [
                    'user_id'=>Auth::id(),
                    'prod_id'=>$prod_id,
                    'user_review'=>$user_review
                ]);
                $category_slug = $product->category->slug;
                $product_slug = $product->slug;
                if($new_review){
                    return redirect('category/'.$category_slug.'/'.$product_slug)->with('status','thank you for your review') ;
                }
        }
    }

    public function edit($slug)
    {
        $product = Product::where('slug',$slug)->where('status','1')->first();
        if($product)
        {
            $prod_id = $product->id;
            $review  = Review::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',['review'=>$review]);
            }else{
                return redirect()->back()->with('status','the link was broken');
            }

        }
        else{
            return redirect()->back()->with('status','the link was broken');
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->input('user_review');
        if($user_review !=''){
            $review_id = $request->input('review_id');
            $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review){
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status','Updated Succesfully');
            }  else{
                return redirect()->back()->with('status','the link was broken');
            }
        }  else{
            return redirect()->back()->with('status','You cant submit an empty review');
        }
    }


}

