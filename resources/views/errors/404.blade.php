@extends('layouts.app')

@section('title', '404 Case Not Found')

@section('content')
<div class="max-w-md mx-auto text-center py-16 surface-card-fade">
    <div class="w-16 h-16 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mx-auto mb-4 border border-sky-200 shadow-sm">
        <i data-lucide="search" class="w-8 h-8"></i>
    </div>
    <span class="text-[10px] font-bold text-sky-800 bg-sky-100/80 border border-sky-200/60 px-3 py-1 rounded-full uppercase tracking-widest inline-block mb-3">
        HTTP 404 &bull; Record Missing
    </span>
    <h1 class="text-2xl font-black text-slate-900 font-heading mb-2">
        Medical Case Not Found
    </h1>
    <p class="text-xs text-slate-500 mb-6 leading-relaxed max-w-sm mx-auto">
        The requested medical case number or record could not be retrieved from the clinical vault. It may have been archived or removed by a system administrator.
    </p>
    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('cases.index') }}" class="btn-primary-saas text-xs shadow-sm">
            <i data-lucide="folder-kanban" class="w-3.5 h-3.5"></i>
            <span>Browse Active Cases</span>
        </a>
        <a href="{{ route('dashboard') }}" class="btn-secondary-saas text-xs">
            <i data-lucide="activity" class="w-3.5 h-3.5"></i>
            <span>Operations Dashboard</span>
        </a>
    </div>
</div>
@endsection
