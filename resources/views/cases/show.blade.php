@extends('layouts.app')

@section('title', 'Case ' . $case->case_number)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb & Top Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('cases.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-sky-600 transition-colors mb-2 text-decoration-none">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span>Back to Cases Directory</span>
            </a>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-heading font-mono-code mb-0">
                    {{ $case->case_number }}
                </h1>
                <button type="button" 
                        onclick="copyToClipboard('{{ $case->case_number }}', this)" 
                        class="text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer" 
                        title="Copy case identifier">
                    <i data-lucide="copy" class="w-4 h-4"></i>
                </button>
                <span class="text-xs bg-slate-100 text-slate-700 border border-slate-200 px-2.5 py-0.5 rounded-md font-mono-code font-bold">
                    SYS-ID #{{ $case->id }}
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            @can('update', $case)
            <a href="{{ route('cases.edit', $case) }}" class="btn-primary-saas text-xs shadow-sm">
                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                <span>Edit Case Details</span>
            </a>
            @endcan

            @can('delete', $case)
            <button type="button" 
                    class="btn-secondary-saas text-xs text-rose-600 hover:bg-rose-50 hover:border-rose-200" 
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteCaseModal">
                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                <span>Delete</span>
            </button>
            @endcan
        </div>
    </div>

    <!-- Main Overview Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden surface-card-fade">
        <!-- Status & Priority Banner -->
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Clinical Status:</span>
                <span class="badge-status badge-status-{{ Str::slug($case->status) }} text-xs">
                    <span class="badge-status-dot"></span>
                    <span>{{ $case->status }}</span>
                </span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Triage Priority:</span>
                <span class="badge-priority badge-priority-{{ Str::slug($case->priority) }} text-xs">
                    {{ $case->priority }}
                </span>
            </div>
        </div>

        <!-- Surgical Stage Progression -->
        @php
            $stages = ['Draft', 'Planning', 'In Review', 'Approved', 'Completed'];
            $currentStatusIndex = array_search($case->status, $stages);
            $isCancelled = $case->status === 'Cancelled';
        @endphp

        <div class="px-6 py-5 border-b border-slate-100 bg-white">
            @if($isCancelled)
            <div class="p-3.5 bg-rose-50 border border-rose-200 rounded-xl flex items-center gap-2.5 text-rose-800 text-xs font-medium">
                <i data-lucide="badge-alert" class="w-4 h-4 text-rose-600 shrink-0"></i>
                <span>This medical case has been formally flagged as <strong>Cancelled</strong>. No further sterile fabrication or surgical implantation is scheduled.</span>
            </div>
            @else
            <div class="stage-stepper py-2">
                @foreach($stages as $index => $stage)
                    @php
                        $isCompleted = $currentStatusIndex !== false && $index < $currentStatusIndex;
                        $isActive = $currentStatusIndex !== false && $index === $currentStatusIndex;
                    @endphp
                    <div class="stage-step {{ $isCompleted ? 'step-completed' : '' }} {{ $isActive ? 'step-active' : '' }}">
                        <div class="stage-icon">
                            @if($isCompleted)
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="stage-label">{{ $stage }}</span>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Detailed Specifications Grid -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Patient Reference -->
            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200/80">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Patient Reference Code</span>
                    <i data-lucide="shield-check" class="w-4 h-4 text-teal-600"></i>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-lg font-bold text-slate-900 font-mono-code">{{ $case->patient_reference }}</span>
                    <button type="button" 
                            onclick="copyToClipboard('{{ $case->patient_reference }}', this)" 
                            class="text-slate-400 hover:text-slate-600 p-1 cursor-pointer" 
                            title="Copy patient code">
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
                <p class="text-[11px] text-slate-400 mt-1 mb-0 leading-tight">Anonymized token compliant with healthcare privacy regulations.</p>
            </div>

            <!-- Attending Surgeon -->
            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200/80">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Attending Surgeon</span>
                    <i data-lucide="stethoscope" class="w-4 h-4 text-sky-600"></i>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-sky-100 text-sky-700 border border-sky-200 flex items-center justify-center font-bold text-xs shrink-0">
                        {{ substr($case->surgeon_name, 0, 1) }}
                    </div>
                    <span class="text-base font-bold text-slate-900">{{ $case->surgeon_name }}</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1 mb-0 leading-tight">Lead clinical authority responsible for implant biomechanics.</p>
            </div>

            <!-- Implant Specification -->
            <div class="col-span-1 md:col-span-2 p-4 rounded-xl bg-slate-50/80 border border-slate-200/80">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Custom Implant Specification</span>
                    <i data-lucide="microscope" class="w-4 h-4 text-teal-600"></i>
                </div>
                <div class="text-base font-semibold text-slate-900">
                    {{ $case->implant_type }}
                </div>
                <p class="text-[11px] text-slate-400 mt-1 mb-0 leading-tight">Patient-specific geometry, custom titanium alloy or PEEK biocompatible design.</p>
            </div>

            <!-- Scheduled Surgery Date -->
            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200/80">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Scheduled Surgery Date</span>
                    <i data-lucide="calendar" class="w-4 h-4 text-sky-600"></i>
                </div>
                @if($case->surgery_date)
                <div class="flex items-center gap-2">
                    <span class="text-base font-bold text-slate-900">{{ $case->surgery_date->format('F d, Y') }}</span>
                    <span class="text-xs text-sky-700 font-bold bg-sky-50 px-2 py-0.5 rounded-md border border-sky-200">
                        {{ $case->surgery_date->diffForHumans() }}
                    </span>
                </div>
                @else
                <div class="text-sm font-medium text-slate-400 italic">No surgery date scheduled yet</div>
                @endif
                <p class="text-[11px] text-slate-400 mt-1 mb-0 leading-tight">Sterile packaging logistics aligned to clinical delivery deadline.</p>
            </div>

            <!-- Case Author & Ownership -->
            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200/80">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Originating Case Author</span>
                    <i data-lucide="user" class="w-4 h-4 text-teal-600"></i>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-base font-bold text-slate-900">{{ $case->creator->name ?? 'System' }}</span>
                    <span class="badge {{ ($case->creator->role ?? '') === 'admin' ? 'bg-sky-600 text-white' : 'bg-slate-200 text-slate-700' }} text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider">
                        {{ $case->creator->role ?? 'viewer' }}
                    </span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1 mb-0 leading-tight">Original creator reference is immutable across updates.</p>
            </div>
        </div>

        <!-- Audit Trail Metadata Footer -->
        <div class="px-6 py-4 bg-slate-50/90 border-t border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-slate-500">
            <div class="flex items-center gap-1.5">
                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Created: <strong>{{ $case->created_at->format('Y-m-d H:i:s') }}</strong> ({{ $case->created_at->diffForHumans() }})</span>
            </div>
            <div class="flex items-center gap-1.5">
                <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Last Updated: <strong>{{ $case->updated_at->format('Y-m-d H:i:s') }}</strong> ({{ $case->updated_at->diffForHumans() }})</span>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
@can('delete', $case)
<div class="modal fade" id="deleteCaseModal" tabindex="-1" aria-labelledby="deleteCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content saas-modal-content border-0">
            <div class="p-6">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4 border border-rose-100">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900 font-heading" id="deleteCaseModalLabel">
                    Confirm Case Deletion
                </h3>
                <p class="text-sm text-slate-600 mt-2 mb-4 leading-relaxed">
                    Are you sure you want to permanently delete medical case 
                    <strong class="text-slate-900 font-mono-code bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200">{{ $case->case_number }}</strong>?
                </p>
                <div class="p-3.5 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800 flex items-start gap-2.5 mb-6">
                    <i data-lucide="shield" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <span>This action is permanent and cannot be undone. All clinical tracking and audit entries for this case will be deleted.</span>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" class="btn-secondary-saas text-xs" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('cases.destroy', $case) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-saas text-xs">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            <span>Yes, Delete Case</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection