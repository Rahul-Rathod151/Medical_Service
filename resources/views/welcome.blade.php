<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jajal Medical &mdash; Patient-Specific Surgical Implant Case Management</title>
    
    <!-- Google Fonts Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased flex flex-col font-sans selection:bg-sky-100 selection:text-sky-900">
    <!-- Navigation Bar -->
    <header class="h-20 border-b border-slate-200/90 bg-white/90 backdrop-blur-md sticky top-0 z-40 px-6">
        <div class="max-w-7xl mx-auto h-full flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-decoration-none group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-600 to-teal-600 flex items-center justify-center text-white shadow-md shadow-sky-600/25 group-hover:scale-105 transition-transform">
                    <i data-lucide="hospital" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="font-black text-slate-900 tracking-tight text-lg font-heading">Jajal Medical</span>
                    <span class="ms-2 text-[10px] bg-sky-50 text-sky-800 border border-sky-200 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">
                        Surgical Portal
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="#pipeline" class="hidden md:inline-flex text-xs font-semibold text-slate-600 hover:text-sky-600 px-3 py-2 transition-colors">
                    Clinical Pipeline
                </a>
                <a href="#governance" class="hidden md:inline-flex text-xs font-semibold text-slate-600 hover:text-sky-600 px-3 py-2 transition-colors">
                    RBAC & Security
                </a>
                <a href="#demo" class="hidden sm:inline-flex text-xs font-semibold text-slate-600 hover:text-sky-600 px-3 py-2 transition-colors">
                    Demo Access
                </a>
                <a href="{{ route('login') }}" class="btn-primary-saas text-xs py-2 px-4 shadow-sm">
                    <i data-lucide="log-out" class="w-3.5 h-3.5 rotate-180"></i>
                    <span>Access Portal</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-50 border border-sky-200/90 text-sky-800 text-xs font-bold mb-5 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                    <span>Precision Healthcare SaaS &bull; ISO-13485 & HIPAA Architecture</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight font-heading leading-tight mb-5">
                    Patient-Specific Surgical Implant Lifecycle Management
                </h1>
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    A clinical-grade case management platform built for tracking custom titanium and PEEK implants from 3D anatomical planning through multi-disciplinary review to sterile surgical delivery.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3.5 mt-8">
                    <a href="{{ route('login') }}" class="btn-primary-saas text-sm py-2.5 px-6 shadow-md">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>Open Clinical Portal</span>
                    </a>
                    <a href="#demo" class="btn-secondary-saas text-sm py-2.5 px-6">
                        <i data-lucide="users" class="w-4 h-4 text-slate-500"></i>
                        <span>View Demo Accounts</span>
                    </a>
                </div>
            </div>

            <!-- Hero Live Case Preview Card -->
            <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-2xl shadow-xl p-6 sm:p-8 relative overflow-hidden surface-card-fade">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold">
                            <i data-lucide="microscope" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-extrabold text-slate-900 font-mono-code text-base">CASE-0001</span>
                                <span class="badge-status badge-status-approved text-xs">
                                    <span class="badge-status-dot"></span>
                                    <span>Approved</span>
                                </span>
                            </div>
                            <span class="text-xs text-slate-400">Titanium Cranial Reconstruction Plate &bull; JM-PT-10023</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="badge-priority badge-priority-high text-xs">High Priority</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 py-5 text-center">
                    <div class="p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/70">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Surgeon</div>
                        <div class="text-sm font-bold text-slate-800 mt-0.5">Dr. Rajesh Jajal, MD</div>
                    </div>
                    <div class="p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/70">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Surgery Date</div>
                        <div class="text-sm font-bold text-sky-700 mt-0.5">Oct 28, 2026</div>
                    </div>
                    <div class="p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/70">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Audit Status</div>
                        <div class="text-sm font-bold text-emerald-700 mt-0.5 flex items-center justify-center gap-1">
                            <i data-lucide="shield-check" class="w-4 h-4 inline"></i> Verified
                        </div>
                    </div>
                    <div class="p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/70">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Access Level</div>
                        <div class="text-sm font-bold text-slate-800 mt-0.5">RBAC Guarded</div>
                    </div>
                </div>

                <div class="pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Cryptographic Audit Trail &bull; Created by Clinical Admin</span>
                    <span class="text-teal-600 font-semibold flex items-center gap-1">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                        Cleanroom Production Clearance
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Clinical Pipeline Section -->
    <section id="pipeline" class="py-16 px-6 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-sky-600 uppercase tracking-widest">Quality Gate Progression</span>
                <h2 class="text-3xl font-black text-slate-900 font-heading mt-1">
                    Structured 5-Stage Clinical Pipeline
                </h2>
                <p class="text-sm text-slate-500 mt-2">Every patient-specific implant progresses through deterministic verification gates.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 shadow-2xs">
                    <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center font-bold text-xs mb-3">1</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Draft Case</h3>
                    <p class="text-xs text-slate-500 mb-0">Initial scan upload, surgeon referral, and patient token generation.</p>
                </div>
                <div class="p-5 rounded-xl bg-sky-50 border border-sky-200 shadow-2xs">
                    <div class="w-8 h-8 rounded-full bg-sky-600 text-white flex items-center justify-center font-bold text-xs mb-3">2</div>
                    <h3 class="text-sm font-bold text-sky-900 mb-1">Planning</h3>
                    <p class="text-xs text-sky-700 mb-0">3D patient anatomy segmentation, screw trajectory planning, and finite element modeling.</p>
                </div>
                <div class="p-5 rounded-xl bg-amber-50 border border-amber-200 shadow-2xs">
                    <div class="w-8 h-8 rounded-full bg-amber-600 text-white flex items-center justify-center font-bold text-xs mb-3">3</div>
                    <h3 class="text-sm font-bold text-amber-900 mb-1">In Review</h3>
                    <p class="text-xs text-amber-700 mb-0">Multi-disciplinary surgical lead review and biomechanical stress sign-off.</p>
                </div>
                <div class="p-5 rounded-xl bg-emerald-50 border border-emerald-200 shadow-2xs">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs mb-3">4</div>
                    <h3 class="text-sm font-bold text-emerald-900 mb-1">Approved</h3>
                    <p class="text-xs text-emerald-700 mb-0">Sterile 5-axis CNC titanium milling and ISO-13485 cleanroom sterilization.</p>
                </div>
                <div class="p-5 rounded-xl bg-teal-50 border border-teal-200 shadow-2xs">
                    <div class="w-8 h-8 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-xs mb-3">5</div>
                    <h3 class="text-sm font-bold text-teal-900 mb-1">Completed</h3>
                    <p class="text-xs text-teal-700 mb-0">Surgical operation conducted, post-op imaging verified, case archived.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Governance & Security Section -->
    <section id="governance" class="py-16 px-6 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-4">
                        <i data-lucide="shield" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 font-heading">Strict Role-Based Access</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-0">
                        Admin accounts have full clinical CRUD authority, while Viewer accounts are constrained to read-only surveillance with HTTP 403 server policy enforcement.
                    </p>
                </div>

                <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mb-4">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 font-heading">Immutable Audit Governance</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-0">
                        Every case automatically binds to its original creator. System updates preserve the originating author to guarantee complete audit compliance.
                    </p>
                </div>

                <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 font-heading">RESTful API & Sanctum Auth</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-0">
                        Standardized JSON envelopes with tokenized bearer authentication powered by Laravel Sanctum, ready for hospital EHR/EMR surgical system integrations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Access Section -->
    <section id="demo" class="py-16 px-6 bg-white border-t border-slate-200">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-xs font-bold text-sky-600 uppercase tracking-widest">Evaluation & Assessment</span>
            <h2 class="text-3xl font-black text-slate-900 font-heading mt-1 mb-3">
                Pre-Seeded Demo Credentials
            </h2>
            <p class="text-sm text-slate-500 mb-8 max-w-lg mx-auto">
                Evaluate the dual-role experience directly using the verified accounts below.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left mb-8">
                <div class="p-5 rounded-xl border border-sky-200 bg-sky-50/50 shadow-2xs">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-sky-900">Administrator Role</span>
                        <span class="text-[10px] bg-sky-600 text-white px-2 py-0.5 rounded font-bold uppercase tracking-wider">Full Control</span>
                    </div>
                    <div class="text-xs text-slate-600 space-y-1 font-mono-code mb-4">
                        <div>Email: <strong>admin@jajalmedical.com</strong></div>
                        <div>Password: <strong>Admin@12345</strong></div>
                    </div>
                    <a href="{{ route('login') }}" class="btn-primary-saas text-xs w-full py-2">
                        <span>Sign In as Admin</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 shadow-2xs">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-slate-900">Viewer Role</span>
                        <span class="text-[10px] bg-slate-200 text-slate-700 px-2 py-0.5 rounded font-bold uppercase tracking-wider">Read Only</span>
                    </div>
                    <div class="text-xs text-slate-600 space-y-1 font-mono-code mb-4">
                        <div>Email: <strong>viewer@jajalmedical.com</strong></div>
                        <div>Password: <strong>Viewer@12345</strong></div>
                    </div>
                    <a href="{{ route('login') }}" class="btn-secondary-saas text-xs w-full py-2">
                        <span>Sign In as Viewer</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto border-t border-slate-200 bg-slate-50 py-8 px-6 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-gradient-to-br from-sky-600 to-teal-600 flex items-center justify-center text-white">
                    <i data-lucide="hospital" class="w-3.5 h-3.5"></i>
                </div>
                <span class="font-bold text-slate-800">Jajal Medical Case Management</span>
            </div>
            <div class="text-slate-400 text-center sm:text-right">
                <span>&copy; {{ date('Y') }} Jajal Medical Inc. Built for Medical Case Management.</span>
            </div>
        </div>
    </footer>
</body>
</html>
