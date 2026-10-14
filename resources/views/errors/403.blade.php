@extends('layouts.app')

@section('title', '403 Forbidden Access')

@section('content')
<div class="max-w-md mx-auto text-center py-16 surface-card-fade">
    <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 border border-amber-200 shadow-sm">
        <i data-lucide="alert-triangle" class="w-8 h-8"></i>
    </div>
    <span class="text-[10px] font-bold text-amber-800 bg-amber-100/80 border border-amber-200/60 px-3 py-1 rounded-full uppercase tracking-widest inline-block mb-3">
        HTTP 403 &bull; Authorization Gate
    </span>
    <h1 class="text-2xl font-black text-slate-900 font-heading mb-2">
        Access Denied &bull; Insufficient Privileges
    </h1>
    <p class="text-xs text-slate-500 mb-6 leading-relaxed max-w-sm mx-auto">
        Your current user role does not possess permissions to mutate or delete this clinical case resource. All administrative actions are strictly guarded by Laravel Policies.
    </p>
    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('dashboard') }}" class="btn-primary-saas text-xs shadow-sm">
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
