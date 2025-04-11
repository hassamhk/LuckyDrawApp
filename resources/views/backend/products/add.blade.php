@extends('master')
@section('title', 'Add Product')
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="p-10">
            <div class="flex items-center justify-between gap-2 mb-10">
                <h1 class="text-3xl text-luckydraw-accent font-bold flex-1">Add Product</h1>
                <a href="{{ route('products') }}"
                   class="flex items-center gap-2 bg-luckydraw-accent text-white px-6 py-2 rounded hover:bg-opacity-80 transition">
                    <i class="ph ph-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <div class="bg-white p-6 rounded border border-gray-300">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-uae-secondary font-medium mb-2">Product Title</label>
                        <input type="text" name="title" required
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-uae-secondary font-medium mb-2">Price (Rs)</label>
                        <input type="number" name="price" step="0.01" required
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-uae-secondary font-medium mb-2">Max Entries (leave blank for unlimited)</label>
                        <input type="number" name="max_entries"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-uae-secondary font-medium mb-2">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-uae-secondary font-medium mb-2">Product Image</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-luckydraw-accent" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('products') }}"
                           class="bg-gray-200 text-stone-700 px-4 py-2 rounded hover:bg-gray-300 transition">Cancel</a>
                        <button type="submit"
                                class="bg-luckydraw-secondary text-white px-4 py-2 rounded hover:bg-opacity-90 transition">
                            <i class="ph ph-floppy-disk-back"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
