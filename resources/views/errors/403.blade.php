@extends('layouts.app')

@section('title', '403 Forbidden Access')

@section('content')
<div class="max-w-md mx-auto text-center py-16">
    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 border border-amber-200 shadow-xs">
        <i data-lucide="alert-triangle" class="w-7 h-7"></i>
    </div>
    <span class="text-xs font-bold text-amber-700 bg-amber-100/80 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
        HTTP 403 &bull; Authorization Gate
    </span>
    <h1 class="text-2xl font-extrabold text-slate-900 font-heading mt-3 mb-2">
        Access Denied &bull; Insufficient Privileges
    </h1>
    <p class="text-xs text-slate-500 mb-6 leading-relaxed">
        Your current user role does not possess permissions to modify or delete this clinical case resource. All administrative mutations are guarded by Laravel Policies.
    </p>
    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('dashboard') }}" class="btn-primary-saas text-xs">
            <i data-lucide="activity" class="w-3.5 h-3.5"></i>
            <span>Return to Dashboard</span>
        </a>
        <a href="{{ route('cases.index') }}" class="btn-secondary-saas text-xs">
            <i data-lucide="folder-kanban" class="w-3.5 h-3.5"></i>
            <span>Case Directory</span>
        </a>
    </div>
</div>
@endsection
