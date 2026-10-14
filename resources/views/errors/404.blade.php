@extends('layouts.app')

@section('title', '404 Case Not Found')

@section('content')
<div class="max-w-md mx-auto text-center py-16">
    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mx-auto mb-4 border border-sky-200 shadow-xs">
        <i data-lucide="search" class="w-7 h-7"></i>
    </div>
    <span class="text-xs font-bold text-sky-700 bg-sky-100/80 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
        HTTP 404 &bull; Record Missing
    </span>
    <h1 class="text-2xl font-extrabold text-slate-900 font-heading mt-3 mb-2">
        Medical Case Not Found
    </h1>
    <p class="text-xs text-slate-500 mb-6 leading-relaxed">
        The requested medical case number or record could not be retrieved from the clinical vault. It may have been archived or removed by a system administrator.
    </p>
    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('cases.index') }}" class="btn-primary-saas text-xs">
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
