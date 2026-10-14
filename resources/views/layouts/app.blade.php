<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Case Portal') | Jajal Medical Case Management</title>
    
    <!-- Vite CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 JS Bundle CDN for modal & alert compatibility -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased flex flex-col font-sans">
    @auth
    <div class="app-container">
        <!-- Mobile Sidebar Backdrop -->
        <div id="sidebarBackdrop" 
             onclick="closeSidebar()" 
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-35 hidden lg:hidden transition-opacity"></div>

        <!-- Sidebar Navigation -->
        <aside id="appSidebar" class="app-sidebar" aria-label="Main Navigation">
            <!-- Sidebar Header / Brand -->
            <div class="h-16 px-5 border-b border-slate-200 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 text-decoration-none group">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-sky-600 to-teal-600 flex items-center justify-center text-white shadow-sm shadow-sky-600/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="hospital" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-bold text-slate-900 tracking-tight text-base font-heading leading-none">Jajal Medical</span>
                        </div>
                        <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider">Implant Case Vault</span>
                    </div>
                </a>
                <button type="button" 
                        onclick="closeSidebar()" 
                        class="lg:hidden p-1.5 text-slate-400 hover:text-slate-600 rounded-md hover:bg-slate-100 transition-colors"
                        aria-label="Close sidebar">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <div class="px-3 pb-2 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                    Core Workflows
                </div>
                
                <a href="{{ route('dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i data-lucide="activity" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('cases.index') }}" 
                   class="sidebar-link {{ request()->routeIs('cases.index') || request()->routeIs('cases.show') ? 'active' : '' }}">
                    <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                    <span>Medical Cases</span>
                </a>

                @can('create', App\Models\MedicalCase::class)
                <a href="{{ route('cases.create') }}" 
                   class="sidebar-link {{ request()->routeIs('cases.create') ? 'active' : '' }}">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>New Case</span>
                    <span class="ms-auto text-[10px] bg-sky-100 text-sky-700 px-1.5 py-0.5 rounded font-semibold uppercase">Admin</span>
                </a>
                @endcan

                <div class="pt-4 px-3 pb-2 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                    Quick Pipeline
                </div>

                <a href="{{ route('cases.index', ['status' => 'Planning']) }}" 
                   class="sidebar-link {{ request('status') === 'Planning' ? 'active' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                    <span>Planning Queue</span>
                </a>

                <a href="{{ route('cases.index', ['status' => 'In Review']) }}" 
                   class="sidebar-link {{ request('status') === 'In Review' ? 'active' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span>In Clinical Review</span>
                </a>

                <a href="{{ route('cases.index', ['status' => 'Approved']) }}" 
                   class="sidebar-link {{ request('status') === 'Approved' ? 'active' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Approved for Surgery</span>
                </a>
            </div>

            <!-- Compliance and Regulatory Tag -->
            <div class="p-3 mx-3 mb-3 bg-slate-50 border border-slate-200/80 rounded-lg">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-700 mb-1">
                    <i data-lucide="shield-check" class="w-4 h-4 text-teal-600"></i>
                    <span>ISO-13485 Compliant</span>
                </div>
                <p class="text-[11px] text-slate-500 mb-0 leading-tight">Patient data anonymized with immutable audit trail.</p>
            </div>

            <!-- Current User & Role Profile -->
            <div class="p-3 border-t border-slate-200 bg-white">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-600 text-xs shrink-0">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold text-slate-900 truncate leading-tight">{{ Auth::user()->name }}</div>
                            <div class="flex items-center gap-1 mt-0.5">
                                <span class="badge {{ Auth::user()->isAdmin() ? 'bg-sky-600 text-white' : 'bg-slate-200 text-slate-700' }} text-[9px] px-1.5 py-0.5 rounded font-bold uppercase tracking-wider">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                        @csrf
                        <button type="submit" 
                                class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-md transition-colors" 
                                title="Sign out of account"
                                aria-label="Sign out">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Workspace Area -->
        <div class="app-main-wrapper flex flex-col min-h-screen">
            <!-- Header Bar -->
            <header class="app-header justify-between">
                <div class="flex items-center gap-3">
                    <button type="button" 
                            onclick="toggleSidebar()" 
                            class="lg:hidden p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors"
                            aria-label="Open sidebar menu">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500">
                        <span>Clinical Portal</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                        <span class="font-semibold text-slate-800">@yield('title', 'Dashboard')</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden md:flex items-center gap-2 px-2.5 py-1 bg-emerald-50 border border-emerald-200/80 rounded-full text-[11px] font-semibold text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Clinical Cluster Online</span>
                    </div>

                    @can('create', App\Models\MedicalCase::class)
                    <a href="{{ route('cases.create') }}" class="btn-primary-saas text-xs py-1.5 px-3">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">New Case</span>
                    </a>
                    @endcan
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
                {{-- Flash Notifications --}}
                @if(session('success'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start gap-3 shadow-xs alert-dismissible fade show" role="alert">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close text-xs" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('info'))
                <div class="mb-5 p-4 rounded-xl bg-sky-50 border border-sky-200 text-sky-900 flex items-start gap-3 shadow-xs alert-dismissible fade show" role="alert">
                    <i data-lucide="sparkles" class="w-5 h-5 text-sky-600 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('info') }}
                    </div>
                    <button type="button" class="btn-close text-xs" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 flex items-start gap-3 shadow-xs alert-dismissible fade show" role="alert">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close text-xs" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @yield('content')
            </main>

            <!-- Enterprise Footer -->
            <footer class="mt-auto border-t border-slate-200 bg-white/80 py-4 px-6 text-xs text-slate-500">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-slate-700">Jajal Medical</span>
                        <span>&mdash; Patient-Specific Surgical Implant Case Management</span>
                    </div>
                    <div class="flex items-center gap-4 text-slate-400">
                        <span>v2.4.0 Clinical</span>
                        <span>&bull;</span>
                        <span>RBAC Policy Enforced</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @else
    <!-- Guest Layout (Login & Landing) -->
    <div class="min-h-screen flex flex-col bg-slate-50">
        <!-- Guest Top Navigation Bar -->
        <header class="h-16 border-b border-slate-200 bg-white/90 backdrop-blur-md px-6 flex items-center justify-between sticky top-0 z-30">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 text-decoration-none group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-sky-600 to-teal-600 flex items-center justify-center text-white shadow-sm shadow-sky-600/20 group-hover:scale-105 transition-transform">
                    <i data-lucide="hospital" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="font-bold text-slate-900 tracking-tight text-base font-heading">Jajal Medical</span>
                    <span class="ms-2 text-[10px] bg-slate-100 text-slate-600 border border-slate-200 px-1.5 py-0.5 rounded font-semibold uppercase">Portal</span>
                </div>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="btn-primary-saas text-xs py-1.5 px-3.5">
                    <i data-lucide="user" class="w-3.5 h-3.5"></i>
                    <span>Portal Sign In</span>
                </a>
            </div>
        </header>

        <main class="flex-1 flex flex-col justify-center">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white py-4 px-6 text-xs text-center text-slate-500">
            <span>&copy; {{ date('Y') }} Jajal Medical Inc. Built for Medical Case Management. All rights reserved.</span>
        </footer>
    </div>
    @endauth

    @stack('scripts')
</body>
</html>