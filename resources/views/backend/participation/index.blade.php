@extends('master')
@section('title', 'Participations')
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="p-10">
            <!-- Page Header -->
            <div class="flex items-center justify-between gap-2 mb-10">
                <h1 class="text-3xl text-luckydraw-accent font-bold flex-1">Participations</h1>
                <div></div>
            </div>

            <!-- Table -->
            <div class="overflow-auto w-full bg-white p-5 rounded border border-stone-300">
                <table class="min-w-full">
                    <thead class="bg-stone-50 border border-b-none border-stone-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold w-[100px]">Image</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Product</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Participants</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold w-[150px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-t border-stone-300">
                                <td class="px-6 py-4">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                         class="h-10 w-10 object-cover rounded" />
                                </td>
                                <td class="px-6 py-4">{{ $product->title }}</td>
                                <td class="px-6 py-4">{{ $product->participations_count }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('participate.view', $product->id) }}"
                                           class="text-blue-500 hover:text-blue-700 transition">
                                            <i class="ph ph-users text-xl"></i>
                                        </a>
                                        <form action="{{ route('participate.delete', $product->id) }}" method="POST"
                                              onsubmit="return confirm('Delete all participants for this product?')">
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
                                <td colspan="4" class="text-center text-stone-500 py-6">No participations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
