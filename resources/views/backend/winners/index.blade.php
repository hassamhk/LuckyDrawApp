@extends('master')
@section('title', 'Winners')
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="p-10">
            <div class="flex items-center justify-between gap-2 mb-10">
                <h1 class="text-3xl font-bold text-luckydraw-accent">Winners</h1>
                <div></div>
            </div>

            <div class="overflow-auto w-full bg-white p-6 rounded border border-stone-300">
                <table class="min-w-full">
                    <thead class="bg-stone-50 border border-b-none border-stone-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Product</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Winner Name</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-stone-600 font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($winners as $index => $winner)
                            <tr class="border-t border-stone-300">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $winner->product->title ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $winner->user->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $winner->user->email ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $winner->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-stone-500 py-6">No winners selected yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
