<div class="space-y-6">
    <!-- Section 1: Identification -->
    <div>
        <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
            <i data-lucide="folder-kanban" class="w-4 h-4 text-sky-600"></i>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-0">
                1. Case Identification & Patient Token
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Case Number -->
            <div>
                <label for="case_number" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Case Number <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <input type="text"
                           name="case_number"
                           id="case_number"
                           class="form-control-saas font-mono-code @error('case_number') is-invalid @enderror"
                           value="{{ old('case_number', $case->case_number) }}"
                           placeholder="e.g. CASE-0001"
                           required>
                </div>
                @error('case_number')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @else
                    <div class="text-[11px] text-slate-400 mt-1">Must be a unique clinical identifier across the platform.</div>
                @enderror
            </div>

            <!-- Patient Reference Dummy Code -->
            <div>
                <label for="patient_reference" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Patient Reference Code <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <input type="text"
                           name="patient_reference"
                           id="patient_reference"
                           class="form-control-saas font-mono-code @error('patient_reference') is-invalid @enderror"
                           value="{{ old('patient_reference', $case->patient_reference) }}"
                           placeholder="e.g. JM-PT-10023"
                           required>
                </div>
                @error('patient_reference')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @else
                    <div class="text-[11px] text-slate-400 mt-1">Anonymized token (strictly non-identifiable medical reference).</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Section 2: Clinical Team & Device -->
    <div>
        <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
            <i data-lucide="stethoscope" class="w-4 h-4 text-sky-600"></i>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-0">
                2. Clinical Team & Custom Implant
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Surgeon Name -->
            <div>
                <label for="surgeon_name" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Attending Surgeon Name <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       name="surgeon_name"
                       id="surgeon_name"
                       class="form-control-saas @error('surgeon_name') is-invalid @enderror"
                       value="{{ old('surgeon_name', $case->surgeon_name) }}"
                       placeholder="e.g. Dr. Rajesh Jajal, MD"
                       required>
                @error('surgeon_name')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Implant Specification -->
            <div>
                <label for="implant_type" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Implant Specification / Type <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       name="implant_type"
                       id="implant_type"
                       class="form-control-saas @error('implant_type') is-invalid @enderror"
                       value="{{ old('implant_type', $case->implant_type) }}"
                       placeholder="e.g. Titanium Cranial Mesh, PEEK Vertebral Cage"
                       required>
                @error('implant_type')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Section 3: Workflow, Priority & Schedule -->
    <div>
        <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
            <i data-lucide="calendar" class="w-4 h-4 text-sky-600"></i>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-0">
                3. Lifecycle Stage & Logistics
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Status -->
            <div>
                <label for="status" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Case Lifecycle Status <span class="text-rose-500">*</span>
                </label>
                <select name="status" id="status" class="form-select-saas @error('status') is-invalid @enderror" required>
                    <option value="" disabled {{ old('status', $case->status) ? '' : 'selected' }}>Select status...</option>
                    @foreach($statuses as $st)
                        <option value="{{ $st }}" {{ old('status', $case->status) === $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Priority -->
            <div>
                <label for="priority" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Clinical Priority <span class="text-rose-500">*</span>
                </label>
                <select name="priority" id="priority" class="form-select-saas @error('priority') is-invalid @enderror" required>
                    <option value="" disabled {{ old('priority', $case->priority) ? '' : 'selected' }}>Select priority...</option>
                    @foreach($priorities as $pr)
                        <option value="{{ $pr }}" {{ old('priority', $case->priority) === $pr ? 'selected' : '' }}>
                            {{ $pr }}
                        </option>
                    @endforeach
                </select>
                @error('priority')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Surgery Date -->
            <div>
                <label for="surgery_date" class="block text-xs font-bold text-slate-700 mb-1.5">
                    Scheduled Surgery Date
                </label>
                <input type="date"
                       name="surgery_date"
                       id="surgery_date"
                       class="form-control-saas @error('surgery_date') is-invalid @enderror"
                       value="{{ old('surgery_date', $case->surgery_date ? $case->surgery_date->format('Y-m-d') : '') }}">
                @error('surgery_date')
                    <div class="text-xs text-rose-600 font-medium mt-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @else
                    <div class="text-[11px] text-slate-400 mt-1">Optional surgical date for implant delivery.</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Security & Audit Trail Banner -->
    <div class="p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl flex items-start gap-3 text-xs text-slate-600">
        <div class="w-6 h-6 rounded-md bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 mt-0.5">
            <i data-lucide="shield-check" class="w-4 h-4"></i>
        </div>
        <div>
            <strong class="text-slate-800">Automated Audit Governance:</strong>
            The <code>created_by</code> record is cryptographically verified to the authenticated administrator (<strong>{{ Auth::user()->name }}</strong>). On updates, the original case creator cannot be overwritten.
        </div>
    </div>
</div>