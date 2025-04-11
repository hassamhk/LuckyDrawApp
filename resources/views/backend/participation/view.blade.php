@extends('master')
@section('title', 'Participants - ' . $product->title)
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="p-10">
            <div class="flex items-center justify-between gap-2 mb-6">
                <h1 class="text-3xl font-bold text-luckydraw-accent">Participants - {{ $product->title }}</h1>
                <a href="{{ route('participate') }}"
                   class="bg-luckydraw-accent text-white px-4 py-2 rounded hover:bg-opacity-80 transition">
                    <i class="ph ph-arrow-left"></i> Back
                </a>
            </div>

            <div class="bg-white p-6 rounded border border-gray-300">
                @if ($product->participations->count())
                    <table class="min-w-full">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-stone-600 font-semibold">#</th>
                                <th class="px-6 py-3 text-left text-stone-600 font-semibold">User Name</th>
                                <th class="px-6 py-3 text-left text-stone-600 font-semibold">Email</th>
                                <th class="px-6 py-3 text-left text-stone-600 font-semibold">Joined At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->participations as $index => $participation)
                                <tr class="border-t border-stone-300">
                                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                                    <td class="px-6 py-3">{{ $participation->user->name ?? '-' }}</td>
                                    <td class="px-6 py-3">{{ $participation->user->email ?? '-' }}</td>
                                    <td class="px-6 py-3">{{ $participation->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-stone-500">No participants yet for this product.</p>
                @endif
            </div>
        </div>
    </main>
@endsection
