@extends('master')
@section('title', 'Edit Product')
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="p-10">
            <div class="flex items-center justify-between gap-2 mb-10">
                <h1 class="text-3xl font-bold flex-1">Edit Product</h1>
                <a href="{{ route('products') }}"
                   class="flex items-center gap-2 bg-luckydraw-accent text-white px-6 py-2 rounded hover:bg-opacity-80 transition">
                    <i class="ph ph-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <div class="bg-white p-6 rounded border border-gray-300">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Product Title</label>
                        <input type="text" name="title" value="{{ $product->title }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Price (Rs)</label>
                        <input type="number" name="price" value="{{ $product->price }}" step="0.01" required
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Max Entries</label>
                        <input type="number" name="max_entries" value="{{ $product->max_entries }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Current Image</label>
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" class="w-16 h-16 object-cover rounded mb-2" />
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('products') }}"
                           class="bg-gray-200 text-stone-700 px-4 py-2 rounded hover:bg-gray-300 transition">Cancel</a>
                        <button type="submit"
                                class="bg-luckydraw-secondary text-white px-4 py-2 rounded hover:bg-opacity-90 transition">
                            <i class="ph ph-floppy-disk-back"></i> Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
