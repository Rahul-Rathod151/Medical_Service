@extends('layouts.app')

@section('title', 'Medical Cases Directory')

@section('content')
<div class="space-y-5">
    <!-- Header with Breadcrumbs & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-1">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-100/80 text-sky-800 uppercase tracking-widest border border-sky-200/60">
                    Surgical Case Registry
                </span>
                <span class="text-xs text-slate-400 font-medium">Total: {{ $cases->total() }} cases</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-heading">
                Medical Cases Directory
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Query, filter, and audit custom surgical implant cases with patient-reference anonymization.
            </p>
        </div>

        @can('create', App\Models\MedicalCase::class)
        <a href="{{ route('cases.create') }}" class="btn-primary-saas text-xs shrink-0 shadow-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Log New Medical Case</span>
        </a>
        @endcan
    </div>

    <!-- Filter & Search Toolbar Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-card surface-card-fade">
        <form method="GET" action="{{ route('cases.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search Input -->
            <div class="sm:col-span-5 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text"
                       name="search"
                       class="form-control-saas pl-10 pr-9"
                       placeholder="Search Case Number, Surgeon, or Patient Ref..."
                       value="{{ $search }}">
                @if(!empty($search))
                <a href="{{ route('cases.index', array_merge(request()->except('search'), ['search' => ''])) }}" 
                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600" 
                   title="Clear search">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
                @endif
            </div>

            <!-- Status Dropdown -->
            <div class="sm:col-span-3">
                <select name="status" class="form-select-saas">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $st)
                        <option value="{{ $st }}" {{ $status === $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Items per Page -->
            <div class="sm:col-span-2">
                <select name="per_page" class="form-select-saas" title="Rows per page" onchange="this.form.submit()">
                    <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10 / page</option>
                    <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25 / page</option>
                    <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50 / page</option>
                </select>
            </div>

            <!-- Submit & Reset Action Buttons -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="btn-primary-saas text-xs flex-1 py-2 shadow-2xs">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    <span>Apply</span>
                </button>
                @if(!empty($search) || !empty($status) || ($perPage ?? 10) != 10)
                <a href="{{ route('cases.index') }}" 
                   class="btn-secondary-saas text-xs py-2 px-2.5" 
                   title="Clear all filters">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-slate-500"></i>
                </a>
                @endif
            </div>
        </form>

        <!-- Active Filter Badges -->
        @if(!empty($search) || !empty($status))
        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100 text-xs">
            <span class="text-slate-400 font-medium">Active filters:</span>
            @if(!empty($search))
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-semibold border border-slate-200">
                <span>Query: "{{ $search }}"</span>
                <a href="{{ route('cases.index', request()->except('search')) }}" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-3 h-3"></i></a>
            </span>
            @endif
            @if(!empty($status))
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-800 font-semibold border border-sky-200">
                <span>Status: {{ $status }}</span>
                <a href="{{ route('cases.index', request()->except('status')) }}" class="text-sky-600 hover:text-sky-800"><i data-lucide="x" class="w-3 h-3"></i></a>
            </span>
            @endif
        </div>
        @endif
    </div>

    <!-- Cases Data Table -->
    <div class="enterprise-table-container surface-card-fade">
        <div class="overflow-x-auto">
            <table class="enterprise-table">
                <thead>
                    <tr>
                        <th scope="col" class="ps-5">Case Identifier</th>
                        <th scope="col">Patient Ref</th>
                        <th scope="col">Surgeon</th>
                        <th scope="col">Implant Specification</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Surgery Date</th>
                        <th scope="col">Created By</th>
                        <th scope="col" class="text-end pe-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cases as $case)
                    <tr>
                        <td class="ps-5 font-bold font-mono-code">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('cases.show', $case) }}" class="text-sky-600 hover:text-sky-800 text-decoration-none font-bold">
                                    {{ $case->case_number }}
                                </a>
                                <button type="button" 
                                        onclick="copyToClipboard('{{ $case->case_number }}', this)" 
                                        class="text-slate-300 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100 transition-colors cursor-pointer" 
                                        title="Copy case number">
                                    <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <span class="patient-tag" title="Anonymized Patient Reference">{{ $case->patient_reference }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600 shrink-0">
                                    {{ substr($case->surgeon_name, 0, 1) }}
                                </div>
                                <span class="text-xs font-semibold text-slate-800">{{ $case->surgeon_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs text-slate-600 truncate max-w-[200px] block" title="{{ $case->implant_type }}">
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
                        <td class="text-xs text-slate-600 whitespace-nowrap">
                            @if($case->surgery_date)
                            <div class="flex items-center gap-1.5 font-medium">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>{{ $case->surgery_date->format('M d, Y') }}</span>
                            </div>
                            @else
                            <span class="text-slate-400 italic">Not scheduled</span>
                            @endif
                        </td>
                        <td class="text-xs text-slate-500 whitespace-nowrap">
                            <span class="font-semibold text-slate-700">{{ $case->creator->name ?? 'System' }}</span>
                            <span class="text-[10px] text-slate-400 block uppercase font-medium">({{ $case->creator->role ?? 'viewer' }})</span>
                        </td>
                        <td class="text-end pe-5 whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="{{ route('cases.show', $case) }}" 
                                   class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer" 
                                   title="View details">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                @can('update', $case)
                                <a href="{{ route('cases.edit', $case) }}" 
                                   class="p-1.5 text-slate-500 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition-colors cursor-pointer" 
                                   title="Edit medical case">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>
                                @endcan
                                @can('delete', $case)
                                <button type="button"
                                        class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer"
                                        title="Delete medical case"
                                        onclick="confirmDeleteCase('{{ $case->case_number }}', '{{ route('cases.destroy', $case) }}')">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-16 text-slate-400">
                            <div class="w-12 h-12 rounded-full bg-slate-100 mx-auto flex items-center justify-center text-slate-400 mb-3">
                                <i data-lucide="search" class="w-6 h-6"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-sm mb-1">No medical cases matched your query</p>
                            <p class="text-xs text-slate-400 mb-4 max-w-sm mx-auto">Try adjusting your search keywords, clearing status filters, or creating a new case.</p>
                            <a href="{{ route('cases.index') }}" class="btn-secondary-saas text-xs">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span>Reset All Filters</span>
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($cases->total() > 0)
        <!-- Pagination & Summary Footer -->
        <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div>
                Showing <strong class="text-slate-800 font-mono-code">{{ $cases->firstItem() }}</strong> to 
                <strong class="text-slate-800 font-mono-code">{{ $cases->lastItem() }}</strong> of 
                <strong class="text-slate-800 font-mono-code">{{ $cases->total() }}</strong> medical cases
                <span class="ms-2 px-2 py-0.5 rounded-md bg-white border border-slate-200 font-semibold">{{ $perPage ?? 10 }} / page</span>
            </div>
            <div class="cases-pagination">
                {{ $cases->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Global Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content saas-modal-content border-0">
            <div class="p-6">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4 border border-rose-100">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900 font-heading" id="deleteConfirmModalLabel">
                    Delete Medical Case Confirmation
                </h3>
                <p class="text-sm text-slate-600 mt-2 mb-4 leading-relaxed">
                    Are you sure you want to permanently delete medical case 
                    <strong id="deleteCaseNumber" class="text-slate-900 font-mono-code bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200"></strong>?
                </p>
                <div class="p-3.5 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800 flex items-start gap-2.5 mb-6">
                    <i data-lucide="shield" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <span>This action is permanent and strictly logged in the system audit trail. Only authorized Administrators can perform case deletions.</span>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" class="btn-secondary-saas text-xs" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" action="">
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
@endsection

@push('scripts')
<script>
    function confirmDelete(caseNumber, deleteUrl) {
        confirmDeleteCase(caseNumber, deleteUrl);
    }
</script>
@endpush