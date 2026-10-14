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

// Framer Motion Subtle Animations
function initAnimations() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // Stagger KPI Cards Entrance
    const kpiCards = document.querySelectorAll('.kpi-card');
    if (kpiCards.length > 0) {
        animate(
            kpiCards,
            { opacity: [0, 1], y: [16, 0] },
            { delay: stagger(0.06), duration: 0.45, ease: [0.16, 1, 0.3, 1] }
        );
    }

    // Table Rows Stagger Entrance
    const tableRows = document.querySelectorAll('.enterprise-table tbody tr');
    if (tableRows.length > 0 && tableRows.length <= 15) {
        animate(
            tableRows,
            { opacity: [0, 1], y: [8, 0] },
            { delay: stagger(0.03, { start: 0.15 }), duration: 0.35, ease: 'easeOut' }
        );
    }

    // Form or Card Surface Fade In
    const mainCards = document.querySelectorAll('.surface-card-fade');
    if (mainCards.length > 0) {
        animate(
            mainCards,
            { opacity: [0, 1], y: [12, 0] },
            { duration: 0.4, ease: [0.16, 1, 0.3, 1] }
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
        
        // Highlight inputs briefly
        animate(
            [emailInput, passwordInput],
            { borderColor: ['#0284c7', '#e2e8f0'] },
            { duration: 0.8 }
        );
    }
};

// Copy Patient Reference or Case Number
window.copyToClipboard = function(text, element) {
    if (!navigator.clipboard) return;
    navigator.clipboard.writeText(text).then(() => {
        const originalText = element.getAttribute('data-original-title') || element.innerHTML;
        element.innerHTML = '<i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 inline"></i> Copied!';
        initIcons();
        setTimeout(() => {
            element.innerHTML = originalText;
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
                const originalHtml = submitBtn.innerHTML;
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
