@extends('layouts.app')

@section('title', 'Edit Case ' . $case->case_number)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('cases.show', $case) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-sky-600 transition-colors mb-2 text-decoration-none">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span>Back to Case Details</span>
            </a>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="pencil" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight font-heading mb-0">
                        Edit Case: <span class="font-mono-code">{{ $case->case_number }}</span>
                    </h1>
                    <p class="text-xs text-slate-500 mt-0.5">Update clinical stage, surgical schedule, or specifications.</p>
                </div>
            </div>
        </div>

        <div>
            <span class="badge-status badge-status-{{ Str::slug($case->status) }} text-xs">
                <span class="badge-status-dot"></span>
                <span>{{ $case->status }}</span>
            </span>
        </div>
    </div>

    <!-- Form Container Card -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-xs overflow-hidden surface-card-fade">
        <div class="p-6">
            <form method="POST" action="{{ route('cases.update', $case) }}" novalidate data-loading-on-submit>
                @csrf
                @method('PUT')

                @include('cases._form')

                <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-100">
                    <a href="{{ route('cases.show', $case) }}" class="btn-secondary-saas text-xs">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary-saas text-xs">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Update Medical Case</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection