@if (session('status'))
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-luckydraw-accent/10 border border-uae-accent text-uae-accent px-5 py-3 rounded-lg shadow-md flex items-center gap-3" id="flash-status">
        <i class="ph ph-info text-xl"></i>
        <span><strong>Notice:</strong> {{ session('status') }}</span>
        <button class="ml-auto text-uae-accent hover:text-uae-primary" onclick="$('#flash-status').fadeOut()">
            <i class="ph ph-x-circle"></i>
        </button>
    </div>
@endif

@if (session('success'))
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-800 px-5 py-3 rounded-lg shadow-md flex items-center gap-3" id="flash-success">
        <i class="ph ph-check-circle text-xl"></i>
        <span><strong>Success:</strong> {{ session('success') }}</span>
        <button class="ml-auto text-green-600 hover:text-green-800" onclick="$('#flash-success').fadeOut()">
            <i class="ph ph-x-circle"></i>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-luckydraw-primary/10 border border-uae-primary text-uae-primary px-5 py-3 rounded-lg shadow-md flex items-center gap-3" id="flash-error">
        <i class="ph ph-warning-circle text-xl"></i>
        <span><strong>Error:</strong> {{ session('error') }}</span>
        <button class="ml-auto text-uae-primary hover:text-uae-secondary" onclick="$('#flash-error').fadeOut()">
            <i class="ph ph-x-circle"></i>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-luckydraw-primary/10 border border-uae-primary text-uae-primary px-5 py-3 rounded-lg shadow-md w-[350px]" id="flash-validation">
        <strong class="block mb-1">Validation Errors:</strong>
        <ul class="list-disc pl-4 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="absolute top-2 right-2 text-uae-primary hover:text-uae-secondary" onclick="$('#flash-validation').fadeOut()">
            <i class="ph ph-x-circle"></i>
        </button>
    </div>
@endif
