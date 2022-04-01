<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $featured_product = Product::where('trending', '1')->take(15)->get();
        $trending_categories = Category::where('popular', '1')->take(10)->get();
        return view('frontend.index', [
            'featured_product' => $featured_product,
            'user' => $user,
            'trending_categories' => $trending_categories
        ]);
    }

    public function category()
    {
        $category = Category::where('status', '1')->get();
        return view('frontend.category', ['category' => $category]);
    }

    public function viewcategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            // dd($category);
            $products = Product::where('cat_id', $category->id)->where('status', '1')->get();
            return view('frontend.products.index', [
                'category' => $category,
                'products' => $products
            ]);
        } else {
            return redirect('/')->with('status', 'doesnt exist');
        }
    }

    public function viewproduct($cat_slug, $prod_slug)
    {
        if (Category::where('slug', $cat_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {
                $products=Product::where('slug',$prod_slug)->first();
                $rating = Rating::where('prod_id',$products->id)->get();
                $rating_sum = Rating::where('prod_id',$products->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id',$products->id)->where('user_id',Auth::id())->first();
                $reviews = Review::where('prod_id',$products->id)->get();
                if($rating->count() > 0){
                    $rating_value = $rating_sum/$rating->count();
                }else{
                    $rating_value = 0;
                }
                return view('frontend.products.view',[
                    'products'=>$products,
                    'rating'=>$rating,
                    'rating_value'=>$rating_value,
                    'user_rating'=>$user_rating,
                    'reviews'=>$reviews
                ]);
            } else {
                return redirect('/')->with('status', 'the link was broken');
            }
        } else {
            return redirect('/')->with('status', 'No such category broken');
        }
    }

    public function productListAjax()
    {
        $products = Product::all();

        $data=[];

        foreach($products as $item){
            $data[]=$item['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $searchProduct= $request->search;
        if($searchProduct !=''){
            $product = Product::where("name","LIKE","%$searchProduct%")->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }else{
                return redirect()->back()->with('status','Product Not Found');
            }
        }else{
            return redirect()->back();
        }
    }
}
