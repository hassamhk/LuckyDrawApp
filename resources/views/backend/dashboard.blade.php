@extends('master')
@section('title', 'Dashboard')
@section('content')
    @include('backend.partials.alerts')

    <main class="flex-1">
        <div class="flex h-screen items-center justify-center">
            <div class="flex flex-col gap-4 items-center w-full text-center">
                <h1 class="text-5xl font-bold text-uae-gradient">Welcome to the Dashboard</h1>
                <h2 class="text-xl font-bold text-uae-secondary">Spin Your Wheel</h2>
                <p class="max-w-[768px] w-full text-uae-accent">
                    Manage your Products, Games, Winners, and Gifts efficiently.
                    Stay organized and keep track of your Games growth with our
                    intuitive admin panel.
                </p>
            </div>
        </div>
    </main>
@endsection
