<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductApiController extends Controller
{

public function index()
{
    $products = Product::where('is_active', true)->latest()->get();
    return ProductResource::collection($products);
}
}
