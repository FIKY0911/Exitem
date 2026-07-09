<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $frontService;

    public function __construct(FrontService $frontService)
    {
        throw new \Exception('Not implemented');
    }

    public function index()
    {
        $data = $this->frontService->getHomePageData();
        return view('front.index', $data);
    }

    public function details(Product $product)
    {
        return view('front.details', compact('product'));
    }

    public function category(Category $category)
    {
        return view('front.category', compact('category'));
    }

}
