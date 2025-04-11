<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
   public function index(){
    $products = Product::withCount('participations')->get();
    return view('backend.participation.index', compact('products'));
   }

   public function view($id)
    {
        $product = Product::with(['participations.user'])->findOrFail($id);
        return view('backend.participation.view', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->participations()->delete();

        return redirect()->back()->with('success', 'All participants deleted for this product.');
    }
}
