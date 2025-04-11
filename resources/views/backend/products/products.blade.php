@extends('master')
@section('title', 'Products')
@section('content')
    @include('backend.partials.alerts')

    <!-- Main Content Section -->
    <main class="flex-1">
        <div class="p-10">
            <!-- Page Header -->
            <div class="flex items-center justify-between gap-2 mb-10">
                <h1 class="text-3xl text-luckydraw-accent font-bold flex-1">Products</h1>
                <div class="flex items-center gap-2">
                    <div
                        class="flex items-center bg-white pl-4 border border-stone-300 rounded overflow-hidden focus-within:border focus-within:border-luckydraw-accent transition">
                        <i class="ph ph-magnifying-glass text-lg text-stone-500"></i>
                        <input type="text" placeholder="Search" class="max-w-[300px] w-full px-4 py-2 focus:outline-none" />
                    </div>

                    <a href="{{route('products.add')}}"
                        class="flex items-center gap-2 bg-luckydraw-accent text-white px-6 py-2 rounded hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-luckydraw-accent active:bg-opacity-90 transition">
                        <i class="ph ph-plus"></i>
                        <span>Add Product</span>
                    </a>
                </div>
            </div>

            <!-- Product Table -->
            <div class="overflow-auto w-full bg-white p-5 rounded border border-stone-300">
                <table class="min-w-full">
                    <!-- Table Head -->
                    <thead class="bg-stone-50 border border-b-none border-stone-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold w-[100px]">Image</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Title</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Price (Rs)</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Description</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold w-[150px]">Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-t border-stone-300">
                                <td class="px-6 py-4">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                        class="h-10 w-10 object-cover rounded" />
                                </td>
                                <td class="px-6 py-4">{{ $product->title }}</td>
                                <td class="px-6 py-4">{{ number_format($product->price) }}</td>
                                <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-blue-500 hover:text-blue-700 transition text-center">
                                            <i class="ph ph-note-pencil text-xl"></i>
                                        </a>
                                        <form action="{{ route('products.delete', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                <i class="ph ph-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-stone-500 py-6">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
