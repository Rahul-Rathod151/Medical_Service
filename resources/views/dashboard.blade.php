@extends('layouts.app')

@section('title', 'Clinical Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header & Contextual Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-sky-100 text-sky-800 uppercase tracking-wider">
                    Operations Center
                </span>
                <span class="text-xs text-slate-400 font-medium">{{ now()->format('l, F j, Y') }}</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-heading">
                Medical Cases Overview
            </h1>
            <p class="text-sm text-slate-500 mt-1 max-w-2xl">
                Real-time surgical tracking, quality gate surveillance, and implant fabrication pipeline.
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('cases.index') }}" class="btn-secondary-saas text-xs">
                <i data-lucide="folder-kanban" class="w-4 h-4 text-slate-500"></i>
                <span>Directory</span>
            </a>
            @can('create', App\Models\MedicalCase::class)
            <a href="{{ route('cases.create') }}" class="btn-primary-saas text-xs">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Create Case</span>
            </a>
            @endcan
        </div>
    </div>

    <!-- KPI Metric Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-3 sm:gap-4">
        <!-- Total Cases -->
        <a href="{{ route('cases.index') }}" class="kpi-card kpi-total text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider">Total Cases</span>
                <div class="w-7 h-7 rounded-md bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 font-heading font-mono-code">{{ $counts['total'] }}</span>
                <span class="text-[10px] text-sky-600 font-semibold flex items-center group-hover:translate-x-0.5 transition-transform">
                    All <i data-lucide="chevron-right" class="w-3 h-3 inline"></i>
                </span>
            </div>
        </a>

        <!-- Planning -->
        <a href="{{ route('cases.index', ['status' => 'Planning']) }}" class="kpi-card kpi-planning text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-sky-700">Planning</span>
                <div class="w-7 h-7 rounded-md bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-sky-700 font-heading font-mono-code">{{ $counts['planning'] }}</span>
                <span class="badge-status-dot bg-sky-500"></span>
            </div>
        </a>

        <!-- In Review -->
        <a href="{{ route('cases.index', ['status' => 'In Review']) }}" class="kpi-card kpi-review text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-amber-700">In Review</span>
                <div class="w-7 h-7 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-amber-700 font-heading font-mono-code">{{ $counts['in_review'] }}</span>
                <span class="badge-status-dot bg-amber-500"></span>
            </div>
        </a>

        <!-- Approved -->
        <a href="{{ route('cases.index', ['status' => 'Approved']) }}" class="kpi-card kpi-approved text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-emerald-700">Approved</span>
                <div class="w-7 h-7 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-emerald-700 font-heading font-mono-code">{{ $counts['approved'] }}</span>
                <span class="badge-status-dot bg-emerald-500"></span>
            </div>
        </a>

        <!-- Completed -->
        <a href="{{ route('cases.index', ['status' => 'Completed']) }}" class="kpi-card kpi-completed text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-teal-700">Completed</span>
                <div class="w-7 h-7 rounded-md bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-teal-700 font-heading font-mono-code">{{ $counts['completed'] }}</span>
                <span class="badge-status-dot bg-teal-500"></span>
            </div>
        </a>

        <!-- Drafts -->
        <a href="{{ route('cases.index', ['status' => 'Draft']) }}" class="kpi-card kpi-draft text-decoration-none group">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-600">Drafts</span>
                <div class="w-7 h-7 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl sm:text-3xl font-black text-slate-700 font-heading font-mono-code">{{ $counts['draft'] }}</span>
                <span class="badge-status-dot bg-slate-400"></span>
            </div>
        </a>
    </div>

    <!-- Surgical Workflow Funnel Overview -->
    <div class="bg-white border border-slate-200 rounded-xl p-4 sm:p-5 shadow-xs surface-card-fade">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4 text-sky-600"></i>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-0 font-heading">
                    Surgical Case Lifecycle Pipeline
                </h3>
            </div>
            <span class="text-xs text-slate-400">Active Patient Distribution</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 pt-1 text-center">
            <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/60">
                <div class="text-[10px] font-bold uppercase text-slate-500 tracking-wider">1. Draft</div>
                <div class="text-lg font-bold text-slate-800 font-mono-code mt-0.5">{{ $counts['draft'] }}</div>
                <div class="text-[10px] text-slate-400">Intake Data</div>
            </div>
            <div class="p-2.5 rounded-lg bg-sky-50 border border-sky-100">
                <div class="text-[10px] font-bold uppercase text-sky-700 tracking-wider">2. Planning</div>
                <div class="text-lg font-bold text-sky-800 font-mono-code mt-0.5">{{ $counts['planning'] }}</div>
                <div class="text-[10px] text-sky-600/80">3D CAD Modeling</div>
            </div>
            <div class="p-2.5 rounded-lg bg-amber-50 border border-amber-100">
                <div class="text-[10px] font-bold uppercase text-amber-700 tracking-wider">3. In Review</div>
                <div class="text-lg font-bold text-amber-800 font-mono-code mt-0.5">{{ $counts['in_review'] }}</div>
                <div class="text-[10px] text-amber-600/80">Biomechanical Audit</div>
            </div>
            <div class="p-2.5 rounded-lg bg-emerald-50 border border-emerald-100">
                <div class="text-[10px] font-bold uppercase text-emerald-700 tracking-wider">4. Approved</div>
                <div class="text-lg font-bold text-emerald-800 font-mono-code mt-0.5">{{ $counts['approved'] }}</div>
                <div class="text-[10px] text-emerald-600/80">Sterile CNC Milling</div>
            </div>
            <div class="p-2.5 rounded-lg bg-teal-50 border border-teal-100">
                <div class="text-[10px] font-bold uppercase text-teal-700 tracking-wider">5. Completed</div>
                <div class="text-lg font-bold text-teal-800 font-mono-code mt-0.5">{{ $counts['completed'] }}</div>
                <div class="text-[10px] text-teal-600/80">Surgery Implanted</div>
            </div>
        </div>
    </div>

    <!-- Recently Logged Medical Cases Table -->
    <div class="enterprise-table-container surface-card-fade">
        <div class="px-5 py-3.5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 font-heading leading-tight mb-0">
                        Recently Logged Medical Cases
                    </h2>
                    <span class="text-xs text-slate-500">Latest surgical cases entered into clinical tracking</span>
                </div>
            </div>
            <a href="{{ route('cases.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-1 text-decoration-none">
                <span>View Full Directory</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="enterprise-table">
                <thead>
                    <tr>
                        <th scope="col" class="ps-5">Case Identifier</th>
                        <th scope="col">Patient Reference</th>
                        <th scope="col">Attending Surgeon</th>
                        <th scope="col">Implant Specification</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Surgery Date</th>
                        <th scope="col" class="text-end pe-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentCases as $case)
                    <tr>
                        <td class="ps-5 font-bold font-mono-code">
                            <a href="{{ route('cases.show', $case) }}" class="text-sky-600 hover:text-sky-800 text-decoration-none flex items-center gap-1.5 group">
                                <span>{{ $case->case_number }}</span>
                                <i data-lucide="external-link" class="w-3 h-3 text-slate-400 group-hover:text-sky-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>
                        </td>
                        <td>
                            <span class="patient-tag" title="Anonymized Patient Reference">{{ $case->patient_reference }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600 shrink-0">
                                    {{ substr($case->surgeon_name, 0, 1) }}
                                </div>
                                <span class="font-medium text-slate-800 text-xs">{{ $case->surgeon_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs text-slate-600 truncate max-w-[220px] block" title="{{ $case->implant_type }}">
                                {{ $case->implant_type }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-status badge-status-{{ Str::slug($case->status) }}">
                                <span class="badge-status-dot"></span>
                                <span>{{ $case->status }}</span>
                            </span>
                        </td>
                        <td>
                            <span class="badge-priority badge-priority-{{ Str::slug($case->priority) }}">
                                {{ $case->priority }}
                            </span>
                        </td>
                        <td class="text-xs text-slate-600">
                            @if($case->surgery_date)
                            <div class="flex items-center gap-1.5 font-medium">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>{{ $case->surgery_date->format('M d, Y') }}</span>
                            </div>
                            @else
                            <span class="text-slate-400 italic">Not scheduled</span>
                            @endif
                        </td>
                        <td class="text-end pe-5">
                            <div class="inline-flex items-center gap-1">
                                <a href="{{ route('cases.show', $case) }}" 
                                   class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-md transition-colors" 
                                   title="View case details">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                @can('update', $case)
                                <a href="{{ route('cases.edit', $case) }}" 
                                   class="p-1.5 text-slate-500 hover:text-sky-600 hover:bg-sky-50 rounded-md transition-colors" 
                                   title="Edit medical case">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-slate-400">
                            <div class="w-12 h-12 rounded-full bg-slate-100 mx-auto flex items-center justify-center text-slate-400 mb-3">
                                <i data-lucide="folder-open" class="w-6 h-6"></i>
                            </div>
                            <p class="font-semibold text-slate-700 text-sm mb-1">No medical cases recorded yet</p>
                            <p class="text-xs text-slate-400 mb-3">Create your first patient-specific implant case to start the clinical pipeline.</p>
                            @can('create', App\Models\MedicalCase::class)
                            <a href="{{ route('cases.create') }}" class="btn-primary-saas text-xs py-1.5 px-3">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                                <span>Create Initial Case</span>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection