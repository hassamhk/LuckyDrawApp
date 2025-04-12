@php
    use Illuminate\Support\Str;

    function isActiveRouteGroup($group)
    {
        return Str::startsWith(Route::currentRouteName(), $group)
            ? 'bg-luckydraw-gradient text-uae-base'
            : 'hover:bg-white/[15%]';
    }
@endphp

<!-- Sidebar Section -->
<aside class="bg-[#040612] text-white py-5 space-y-6 flex-[0_0_250px]">
    <div class="flex items-center justify-center w-full px-4 space-x-4">
        <!-- Main Logo Icon -->
        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" class="h-14 w-auto" />
        <!-- Logo Text -->
        <h3 class="text-xl font-bold text-white">Lucky Draw</h3>
    </div>

    <!-- Sidebar Navigation Links -->
    <nav class="space-y-2 pl-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-1 p-2 px-4 {{ isActiveRouteGroup('dashboard') }} rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-squares-four text-lg text-uae-base"></i>
            <span class="text-uae-base">Dashboard</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products') }}"
            class="flex items-center gap-1 p-2 px-4 {{ isActiveRouteGroup('products') }} rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-archive text-lg text-uae-base"></i>
            <span class="text-uae-base">Products</span>
        </a>

        <!-- Participants -->
        <a href="{{ route('participate') }}"
            class="flex items-center gap-1 p-2 px-4 {{ isActiveRouteGroup('participate') }} rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-users text-lg text-uae-base"></i>
            <span class="text-uae-base">Participants</span>
        </a>

        <!-- Winners -->
        <a href="{{ route('winners') }}"
            class="flex items-center gap-1 p-2 px-4 {{ isActiveRouteGroup('winners') }} rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-trophy text-lg text-uae-base"></i>
            <span class="text-uae-base">Winners</span>
        </a>
    </nav>
</aside>
