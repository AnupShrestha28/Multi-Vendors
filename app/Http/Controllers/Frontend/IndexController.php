<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\Company;
use App\Models\OrderItem;
use App\Models\UserDraft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;


class IndexController extends Controller
{

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderBy('id', 'DESC')->limit(5)->get();

        $skip_category_6 = Category::skip(6)->first();
        $skip_product_6 = Product::where('status', 1)->where('category_id', $skip_category_6->id)->orderBy('id', 'DESC')->limit(5)->get();

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $new = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $lists = [];
        if (Auth::check()) {

            $product_count = OrderItem::select('product_id', FacadesDB::raw('count(product_id) AS total_count'))->where('user_id', auth()->user()->id)->groupBy('product_id')->get();
            foreach ($product_count as $count) {
                if ($count->total_count > 2) {
                    //dd('yes');
                    $productid = $count->product_id;
                    $lists[] = ['product_id' => $count->product_id];
                }
            }
            if (!empty($lists)) {
                foreach ($lists as $list) {
                    $existingproduct = UserDraft::where('product_id', $list['product_id'])->first();
                    if (!$existingproduct) {
                        UserDraft::create([
                            'product_id' => $list['product_id'],
                            'user_id' => auth()->user()->id
                        ]);
                    } else {
                        UserDraft::where('product_id', $list['product_id'])->update([
                            'isdeleted' => 0
                        ]);
                    }
                }
            }
        }



        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_category_6', 'skip_product_6', 'hot_deals', 'special_offer', 'new', 'special_deals'));
    } // end method

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImage = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size', 'multiImage', 'relatedProduct'));
    } // end method

    public function VendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('vendor_id', $id)->get();
        return view('frontend.vendor.vendor_details', compact('vendor', 'vproduct'));
    } // end method

    public function VendorAll()
    {
        $vendors = User::where('status', 'active')->where('role', 'vendor')->orderBy('id', 'DESC')->get();

        return view('frontend.vendor.vendor_all', compact('vendors'));
    } // end method

    public function CatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadcat = Category::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();


        return view('frontend.product.category_view', compact('products', 'categories', 'breadcat', 'newProduct'));
    } // end method

    public function SubCatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadsubcat = SubCategory::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcat', 'newProduct'));
    } // end method

    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    } // end method

    public function ProductSearch(Request $request)
    {
        $request->validate(['search' => "required"]);
        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.search', compact('products', 'item', 'categories', 'newProduct'));
    } // end method

    public function SearchProduct(Request $request)
    {
        $request->validate(['search' => "required"]);

        $item = $request->search;

        $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_slug', 'product_thambnail', 'discount_price', 'id')->limit(10)->get();

        return view('frontend.product.search_product', compact('products'));
    } // end method

}
