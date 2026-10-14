import './bootstrap';
import { animate, stagger } from 'motion';
import { 
    createIcons, 
    Hospital, 
    Activity, 
    Shield, 
    ShieldCheck, 
    FolderKanban, 
    FolderOpen, 
    Plus, 
    Search, 
    Filter, 
    X, 
    ChevronRight, 
    ChevronLeft, 
    User, 
    Users, 
    CheckCircle2, 
    CheckCircle, 
    Clock, 
    Calendar, 
    CalendarDays, 
    FileText, 
    Layers, 
    SlidersHorizontal, 
    AlertTriangle, 
    Trash2, 
    Edit, 
    Pencil, 
    Eye, 
    EyeOff,
    LogOut, 
    Menu, 
    ArrowRight, 
    Sparkles, 
    Copy, 
    Check,
    Stethoscope,
    Microscope,
    BadgeAlert,
    ExternalLink,
    RefreshCw
} from 'lucide';

// Initialize Lucide Icons globally
export function initIcons() {
    createIcons({
        icons: {
            Hospital,
            Activity,
            Shield,
            ShieldCheck,
            FolderKanban,
            FolderOpen,
            Plus,
            Search,
            Filter,
            X,
            ChevronRight,
            ChevronLeft,
            User,
            Users,
            CheckCircle2,
            CheckCircle,
            Clock,
            Calendar,
            CalendarDays,
            FileText,
            Layers,
            SlidersHorizontal,
            AlertTriangle,
            Trash2,
            Edit,
            Pencil,
            Eye,
            EyeOff,
            LogOut,
            Menu,
            ArrowRight,
            Sparkles,
            Copy,
            Check,
            Stethoscope,
            Microscope,
            BadgeAlert,
            ExternalLink,
            RefreshCw
        }
    });
}

// Framer Motion Subtle Animations for Healthcare SaaS UI
function initAnimations() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // 1. Staggered Entrance for KPI Metric Cards
    const kpiCards = document.querySelectorAll('.kpi-card');
    if (kpiCards.length > 0) {
        animate(
            kpiCards,
            { opacity: [0, 1], y: [14, 0] },
            { delay: stagger(0.05), duration: 0.45, ease: [0.16, 1, 0.3, 1] }
        );
    }

    // 2. Staggered Entrance for Pipeline Funnel Cards
    const funnelSteps = document.querySelectorAll('.funnel-step-item');
    if (funnelSteps.length > 0) {
        animate(
            funnelSteps,
            { opacity: [0, 1], y: [10, 0] },
            { delay: stagger(0.04, { start: 0.1 }), duration: 0.4, ease: [0.16, 1, 0.3, 1] }
        );
    }

    // 3. Table Rows Subtle Stagger Reveal
    const tableRows = document.querySelectorAll('.enterprise-table tbody tr');
    if (tableRows.length > 0 && tableRows.length <= 25) {
        animate(
            tableRows,
            { opacity: [0, 1], y: [6, 0] },
            { delay: stagger(0.025, { start: 0.12 }), duration: 0.3, ease: 'easeOut' }
        );
    }

    // 4. Main Surface Cards / Sections Fade & Slide In
    const surfaceCards = document.querySelectorAll('.surface-card-fade');
    if (surfaceCards.length > 0) {
        animate(
            surfaceCards,
            { opacity: [0, 1], y: [10, 0] },
            { duration: 0.38, ease: [0.16, 1, 0.3, 1] }
        );
    }
}

// Quick Demo Credentials Autofill Helper
window.fillDemoCredentials = function(email, password) {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    if (emailInput && passwordInput) {
        emailInput.value = email;
        passwordInput.value = password;
        
        // Highlight inputs smoothly with Framer Motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!prefersReducedMotion) {
            animate(
                [emailInput, passwordInput],
                { borderColor: ['#0284c7', '#bae6fd', '#e2e8f0'], scale: [0.99, 1] },
                { duration: 0.5, ease: 'easeOut' }
            );
        }
    }
};

// Copy Patient Reference or Case Number with visual feedback
window.copyToClipboard = function(text, element) {
    if (!navigator.clipboard) return;
    navigator.clipboard.writeText(text).then(() => {
        const originalContent = element.getAttribute('data-original-html') || element.innerHTML;
        if (!element.getAttribute('data-original-html')) {
            element.setAttribute('data-original-html', originalContent);
        }
        
        element.innerHTML = '<i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 inline"></i> <span class="text-emerald-700 text-[11px] font-semibold">Copied!</span>';
        initIcons();
        
        setTimeout(() => {
            element.innerHTML = element.getAttribute('data-original-html');
            initIcons();
        }, 1800);
    });
};

// Global Mobile Sidebar Controls
window.toggleSidebar = function() {
    const sidebar = document.getElementById('appSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    if (sidebar) {
        const isOpen = sidebar.classList.contains('mobile-open');
        if (isOpen) {
            sidebar.classList.remove('mobile-open');
            if (backdrop) backdrop.classList.add('hidden');
        } else {
            sidebar.classList.add('mobile-open');
            if (backdrop) backdrop.classList.remove('hidden');
        }
    }
};

window.closeSidebar = function() {
    const sidebar = document.getElementById('appSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    if (sidebar) sidebar.classList.remove('mobile-open');
    if (backdrop) backdrop.classList.add('hidden');
};

// Global Delete Modal Helper
window.confirmDeleteCase = function(caseNumber, deleteUrl) {
    const numberSpan = document.getElementById('deleteCaseNumber');
    const deleteForm = document.getElementById('deleteForm');
    if (numberSpan) numberSpan.textContent = caseNumber;
    if (deleteForm) deleteForm.action = deleteUrl;

    const modalElement = document.getElementById('deleteConfirmModal');
    if (modalElement && window.bootstrap && window.bootstrap.Modal) {
        const modal = new window.bootstrap.Modal(modalElement);
        modal.show();
    }
};

// Run on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    initIcons();
    initAnimations();

    // Prevent double form submissions with loading state
    const submitForms = document.querySelectorAll('form[data-loading-on-submit]');
    submitForms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;
            }
        });
    });
});
