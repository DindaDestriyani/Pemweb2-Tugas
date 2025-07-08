<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;

class HomepageController extends Controller
{
    private $themeFolder;

    public function __construct()
    {
        $this->themeFolder = 'web';
    }

    // Halaman utama
    public function index()
    {
        $categories = Categories::latest()->take(4)->get();
        $products = Product::paginate(20);

        return view($this->themeFolder . '.homepage', [
            'categories' => $categories,
            'products' => $products,
            'title' => 'Homepage'
        ]);
    }

    // Daftar produk
    public function products(Request $request)
    {
        $title = "Products";
        $query = Product::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(20);

        return view($this->themeFolder . '.products', [
            'title' => $title,
            'products' => $products,
        ]);
    }

    // Detail produk
    public function product($slug)
    {
        $product = Product::whereSlug($slug)->first();

        if (!$product) {
            return abort(404);
        }

        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->take(6)
            ->get();

        return view($this->themeFolder . '.product', [
            'slug' => $slug,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    // Daftar semua kategori
    public function categories()
    {
        $categories = Categories::latest()->paginate(20);

        return view($this->themeFolder . '.categories', [
            'title' => 'Categories',
            'categories' => $categories,
        ]);
    }

    // Produk berdasarkan kategori
    public function category($slug)
    {
        $category = Categories::whereSlug($slug)->first();

        if ($category) {
            $products = Product::where('product_category_id', $category->id)->paginate(20);

            return view($this->themeFolder . '.category_by_slug', [
                'slug' => $slug,
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            return abort(404);
        }
    }

    // Halaman keranjang
    public function cart()
    {
        $cart = Cart::query()
            ->with([
                'items',
                'items.itemable'
            ])
            ->where('user_id', auth()->guard('customer')->user()->id)
            ->first();

        return view($this->themeFolder . '.cart', [
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    // Halaman checkout
    public function checkout()
    {
        return view($this->themeFolder . '.checkout', [
            'title' => 'Checkout'
        ]);
    }
}