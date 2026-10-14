@extends('layouts.app')

@section('title', 'Log New Medical Case')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div>
        <a href="{{ route('cases.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-sky-600 transition-colors mb-2 text-decoration-none">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            <span>Back to Cases Directory</span>
        </a>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shadow-2xs border border-sky-100">
                <i data-lucide="plus" class="w-5 h-5"></i>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight font-heading mb-0">
                    Log New Medical Case
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">Enter initial surgical implant specifications and assign clinical priority.</p>
            </div>
        </div>
    </div>

    <!-- Form Container Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden surface-card-fade">
        <div class="p-6 sm:p-7">
            <form method="POST" action="{{ route('cases.store') }}" novalidate data-loading-on-submit>
                @csrf

                @include('cases._form')

                <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-100">
                    <a href="{{ route('cases.index') }}" class="btn-secondary-saas text-xs">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary-saas text-xs shadow-sm">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Save & Open Case</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection