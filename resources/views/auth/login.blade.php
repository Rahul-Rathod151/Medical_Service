@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="w-full max-w-md mx-auto px-4 py-8">
    <!-- Brand Badge & Heading -->
    <div class="text-center mb-6">
        <div class="inline-flex w-12 h-12 rounded-xl bg-gradient-to-br from-sky-600 to-teal-600 items-center justify-center text-white shadow-md shadow-sky-600/20 mb-3">
            <i data-lucide="hospital" class="w-6 h-6"></i>
        </div>
        <h1 class="text-2xl font-black text-slate-900 tracking-tight font-heading">
            Sign In to Case Vault
        </h1>
        <p class="text-xs text-slate-500 mt-1">
            Jajal Medical &mdash; Patient-Specific Implant Management Portal
        </p>
    </div>

    <!-- Main Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm surface-card-fade">
        @if ($errors->any())
        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
                <span>Authentication Failed</span>
            </div>
            <ul class="mb-0 ps-5 list-disc space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate data-loading-on-submit class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Authorized Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <input type="email"
                           class="form-control-saas pl-9.5 @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email', 'admin@jajalmedical.com') }}"
                           placeholder="name@jajalmedical.com"
                           required
                           autofocus>
                </div>
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-bold text-slate-700">
                        Password
                    </label>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                    </div>
                    <input type="password"
                           class="form-control-saas pl-9.5 pr-10 @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           value="Admin@12345"
                           placeholder="••••••••"
                           required>
                    <button type="button" 
                            onclick="togglePasswordVisibility()" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600"
                            aria-label="Toggle password view">
                        <i data-lucide="eye" id="passwordEyeIcon" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-600">
                    <input type="checkbox" id="remember" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                    <span>Remember this workstation</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary-saas w-full py-2.5 text-sm mt-2">
                <i data-lucide="log-out" class="w-4 h-4 rotate-180"></i>
                <span>Sign In to Clinical Portal</span>
            </button>
        </form>

        <!-- Quick Demo Credentials Selector -->
        <div class="mt-6 pt-5 border-t border-slate-100">
            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2.5 text-center">
                Instant Demo Access (Click to autofill)
            </div>
            
            <div class="grid grid-cols-2 gap-2">
                <button type="button" 
                        onclick="fillDemoCredentials('admin@jajalmedical.com', 'Admin@12345')"
                        class="p-2.5 rounded-lg bg-sky-50 hover:bg-sky-100 border border-sky-100 text-left transition-colors group">
                    <div class="flex items-center justify-between mb-0.5">
                        <span class="text-xs font-bold text-sky-900">Admin</span>
                        <span class="text-[9px] bg-sky-600 text-white px-1.5 py-0.2 rounded font-semibold uppercase">Full CRUD</span>
                    </div>
                    <span class="text-[10px] text-sky-600 font-mono-code block truncate">admin@jajalmedical.com</span>
                </button>

                <button type="button" 
                        onclick="fillDemoCredentials('viewer@jajalmedical.com', 'Viewer@12345')"
                        class="p-2.5 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 text-left transition-colors group">
                    <div class="flex items-center justify-between mb-0.5">
                        <span class="text-xs font-bold text-slate-800">Viewer</span>
                        <span class="text-[9px] bg-slate-200 text-slate-600 px-1.5 py-0.2 rounded font-semibold uppercase">Read Only</span>
                    </div>
                    <span class="text-[10px] text-slate-500 font-mono-code block truncate">viewer@jajalmedical.com</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Compliance Guarantee -->
    <div class="flex items-center justify-center gap-4 text-slate-400 text-[11px] mt-6">
        <div class="flex items-center gap-1.5">
            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-teal-600"></i>
            <span>TLS 256-Bit Vault</span>
        </div>
        <span>&bull;</span>
        <div class="flex items-center gap-1.5">
            <i data-lucide="activity" class="w-3.5 h-3.5 text-sky-600"></i>
            <span>ISO-13485 Certified</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const icon = document.getElementById('passwordEyeIcon');
        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            if (icon) icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            if (icon) icon.setAttribute('data-lucide', 'eye');
        }
        if (window.initIcons) window.initIcons();
    }
</script>
@endpush