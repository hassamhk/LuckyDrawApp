

<!-- Sidebar Section -->
<aside class="bg-[#040612] text-white py-5 space-y-6 flex-[0_0_250px]">
    <div class="flex items-center justify-center w-full px-4 space-x-4">
        <!-- Main Logo Icon -->
        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" class="h-14 w-auto" />

        <!-- Logo Text (with white color using filter) -->
        <h3>Lucky Draw</h3>
    </div>

    <!-- Sidebar Navigation Links -->
    <nav class="space-y-2 pl-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-1 p-2 px-4 bg-luckydraw-gradient text-uae-base rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-squares-four text-lg text-uae-base"></i>
            <span class="text-uae-base">Dashboard</span>
        </a>

        <!-- Packages -->
        <a href="{{route('products')}}"
            class="flex items-center gap-1 p-2 px-4 hover:bg-white/[15%] rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-archive text-lg text-uae-base"></i>
            <span class="text-uae-base">Products</span>
        </a>

        <!-- Participants -->
        <a href="{{route('participate')}}"
            class="flex items-center gap-1 p-2 px-4 hover:bg-white/[15%] rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-archive text-lg text-uae-base"></i>
            <span class="text-uae-base">Participants</span>
        </a>

        <!-- Winners -->
        <a href="{{route('winners')}}"
            class="flex items-center gap-1 p-2 px-4 hover:bg-white/[15%] rounded-[5px_0px_0px_5px] text-base">
            <i class="ph ph-archive text-lg text-uae-base"></i>
            <span class="text-uae-base">Winners</span>
        </a>

        {{-- <style>
            nav form button {
                justify-content: flex-start !important;
            }
        </style>

        <!-- Logout -->
        <form method="POST" action="#">
            @csrf
            <button type="submit"
                class="flex items-start gap-1 p-2 px-4 hover:bg-white/[15%] rounded-[5px_0px_0px_5px] text-base w-full text-left">
                <i class="ph ph-sign-out text-lg text-uae-base"></i>
                <span class="text-uae-base">Logout</span>
            </button>
        </form> --}}
    </nav>
</aside>
