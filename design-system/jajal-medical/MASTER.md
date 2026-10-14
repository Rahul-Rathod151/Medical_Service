# Design System Master File: Jajal Medical

> **LOGIC:** When building a specific page, first check `design-system/pages/[page-name].md`.
> If that file exists, its rules **override** this Master file.
> If not, strictly follow the rules below.

---

**Project:** Jajal Medical Case Management
**Category:** Healthcare SaaS / Clinical Surgical Implant Portal
**Design Standard:** UI UX Pro Max Healthcare SaaS Specification

---

## 1. Global Visual Rules

### Color Palette (Clean Clinical Light Theme)

| Role | Hex | CSS Variable | Usage |
|------|-----|--------------|-------|
| Primary | `#0284C7` | `--color-primary` | Primary clinical actions, active states, brand headers |
| Primary Dark | `#0369A1` | `--color-primary-dark` | Hover states, active links, emphasized text |
| Primary Light | `#F0F9FF` | `--color-primary-light` | Active background tints, subtle badges |
| Secondary | `#0D9488` | `--color-secondary` | Surgical accents, ISO compliance badges |
| Background | `#F8FAFC` | `--color-background` | Application canvas, clean off-white |
| Surface / Card | `#FFFFFF` | `--color-surface` | Pure white cards, modals, table surfaces |
| Border | `#E2E8F0` | `--color-border` | Hairline dividers, card outlines |
| Text Main | `#0F172A` | `--color-text-main` | High-contrast headings and body text |
| Text Muted | `#475569` | `--color-text-muted` | Accessible secondary labels (>= 4.5:1 ratio) |
| Destructive | `#DC2626` | `--color-destructive` | Permanent actions, deletion alerts |

### Typography

- **Heading Font:** `Figtree` (Weights: 600, 700, 800)
- **Body Font:** `Inter` (Weights: 400, 500, 600)
- **Monospace Font:** `JetBrains Mono` (Weights: 400, 500, 600) for Patient Reference tokens, Case Numbers, timestamps.
- **Mood:** Clinical, trustworthy, precision engineering, accessible, institutional credibility.

### Shadow Depths & Elevations

| Level | Value | Usage |
|-------|-------|-------|
| `--shadow-subtle` | `0 1px 2px 0 rgba(15, 23, 42, 0.04)` | Form controls, small badges |
| `--shadow-card` | `0 1px 3px 0 rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.03)` | KPI cards, data table wrappers |
| `--shadow-card-hover` | `0 10px 20px -3px rgba(15, 23, 42, 0.06), 0 4px 6px -4px rgba(15, 23, 42, 0.04)` | Lifted interactive cards on hover |
| `--shadow-modal` | `0 25px 50px -12px rgba(15, 23, 42, 0.25)` | Confirmation dialogs, overlay panels |

---

## 2. Motion & Interaction Standards (Framer Motion)

- **Library:** `motion` (`animate`, `stagger`)
- **Stagger entrances:** 30–50ms delays on metric cards and table rows for progressive perception.
- **Micro-transitions:** 150–220ms ease `[0.16, 1, 0.3, 1]` for hover elevation and active press.
- **Reduced motion:** Automatic detection via `(prefers-reduced-motion: reduce)` disables all transforms.

---

## 3. Anti-Patterns (Forbidden)

- ❌ **No Emojis as Structural Icons** — Use Lucide vector icons exclusively.
- ❌ **No Missing cursor-pointer** — Every clickable element must exhibit pointer behavior.
- ❌ **No Layout-shifting Hovers** — Avoid scale transforms that disrupt adjacent container boundaries.
- ❌ **No Low-Contrast Text** — Keep all primary and secondary text above 4.5:1 WCAG AA.
- ❌ **No Dark Mode Force** — Strictly maintain clean, sterile, clinical white/slate light mode.
