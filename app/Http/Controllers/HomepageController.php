<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //fungsi untuk menampilkan halaman homepage
    public function index()
    {
        $categories = Categories::all();
        
        return view ('web.homepage',[
            'categories' => $categories,
        ]);
    }

    public function products()
    {
        return view('web.products');
    }
}
