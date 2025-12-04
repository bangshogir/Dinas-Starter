# Icon Quick Reference - Heroicons

## 🚀 Quick Start

### Basic Usage
```blade
<x-heroicon-o-icon-name class="w-5 h-5" />
```

---

## 📦 Common Icons untuk Diskumindag Project

### Navigation & Menu
```blade
<!-- Dashboard -->
<x-heroicon-o-squares-2x2 class="w-6 h-6" />

<!-- Home -->
<x-heroicon-o-home class="w-6 h-6" />

<!-- Building/Office -->
<x-heroicon-o-building-office-2 class="w-6 h-6" />

<!-- News/Articles -->
<x-heroicon-o-newspaper class="w-6 h-6" />

<!-- Settings -->
<x-heroicon-o-cog-6-tooth class="w-6 h-6" />

<!-- Users -->
<x-heroicon-o-users class="w-6 h-6" />
```

### Actions
```blade
<!-- Add/Create -->
<x-heroicon-o-plus class="w-5 h-5" />

<!-- Edit -->
<x-heroicon-o-pencil class="w-5 h-5" />

<!-- Delete -->
<x-heroicon-o-trash class="w-5 h-5" />

<!-- View/Show -->
<x-heroicon-o-eye class="w-5 h-5" />

<!-- Save -->
<x-heroicon-o-check class="w-5 h-5" />

<!-- Cancel -->
<x-heroicon-o-x-mark class="w-5 h-5" />

<!-- Upload -->
<x-heroicon-o-arrow-up-tray class="w-5 h-5" />

<!-- Download -->
<x-heroicon-o-arrow-down-tray class="w-5 h-5" />
```

### UI Elements
```blade
<!-- Search -->
<x-heroicon-o-magnifying-glass class="w-5 h-5" />

<!-- Filter -->
<x-heroicon-o-adjustments-horizontal class="w-5 h-5" />

<!-- Sort -->
<x-heroicon-o-arrows-up-down class="w-5 h-5" />

<!-- Dropdown Arrow -->
<x-heroicon-o-chevron-down class="w-5 h-5" />

<!-- Back Arrow -->
<x-heroicon-o-arrow-left class="w-5 h-5" />

<!-- Forward Arrow -->
<x-heroicon-o-arrow-right class="w-5 h-5" />

<!-- Close -->
<x-heroicon-o-x-mark class="w-5 h-5" />

<!-- Menu (Hamburger) -->
<x-heroicon-o-bars-3 class="w-6 h-6" />
```

### Content Types
```blade
<!-- Document/Article -->
<x-heroicon-o-document-text class="w-5 h-5" />

<!-- Image/Photo -->
<x-heroicon-o-photo class="w-5 h-5" />

<!-- Folder -->
<x-heroicon-o-folder class="w-5 h-5" />

<!-- Calendar -->
<x-heroicon-o-calendar class="w-5 h-5" />

<!-- Tag -->
<x-heroicon-o-tag class="w-5 h-5" />

<!-- Link -->
<x-heroicon-o-link class="w-5 h-5" />
```

### Status & Notifications
```blade
<!-- Success/Check -->
<x-heroicon-o-check-circle class="w-5 h-5 text-success-500" />

<!-- Warning -->
<x-heroicon-o-exclamation-triangle class="w-5 h-5 text-warning-500" />

<!-- Error -->
<x-heroicon-o-x-circle class="w-5 h-5 text-error-500" />

<!-- Info -->
<x-heroicon-o-information-circle class="w-5 h-5 text-info-500" />

<!-- Clock/Pending -->
<x-heroicon-o-clock class="w-5 h-5" />

<!-- Archive -->
<x-heroicon-o-archive-box class="w-5 h-5" />

<!-- Bell/Notification -->
<x-heroicon-o-bell class="w-5 h-5" />
```

### User & Profile
```blade
<!-- User -->
<x-heroicon-o-user class="w-5 h-5" />

<!-- User Group -->
<x-heroicon-o-user-group class="w-5 h-5" />

<!-- User Circle -->
<x-heroicon-o-user-circle class="w-6 h-6" />

<!-- Login -->
<x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />

<!-- Logout -->
<x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5" />
```

---

## 🎨 Styling Examples

### Size Variants
```blade
<!-- Extra Small (16px) -->
<x-heroicon-o-plus class="w-4 h-4" />

<!-- Small (20px) - Default -->
<x-heroicon-o-plus class="w-5 h-5" />

<!-- Medium (24px) -->
<x-heroicon-o-plus class="w-6 h-6" />

<!-- Large (32px) -->
<x-heroicon-o-plus class="w-8 h-8" />

<!-- Extra Large (48px) -->
<x-heroicon-o-plus class="w-12 h-12" />
```

### Color Variants
```blade
<!-- Gray (Default) -->
<x-heroicon-o-plus class="w-5 h-5 text-gray-500" />

<!-- Brand Color -->
<x-heroicon-o-plus class="w-5 h-5 text-brand-500" />

<!-- Success -->
<x-heroicon-o-check class="w-5 h-5 text-success-500" />

<!-- Warning -->
<x-heroicon-o-exclamation-triangle class="w-5 h-5 text-warning-500" />

<!-- Error -->
<x-heroicon-o-x-circle class="w-5 h-5 text-error-500" />

<!-- White -->
<x-heroicon-o-plus class="w-5 h-5 text-white" />
```

### Interactive States
```blade
<!-- Hover -->
<x-heroicon-o-plus class="w-5 h-5 text-gray-500 hover:text-brand-500" />

<!-- Active -->
<x-heroicon-o-plus class="w-5 h-5 {{ $active ? 'text-brand-500' : 'text-gray-500' }}" />

<!-- Disabled -->
<x-heroicon-o-plus class="w-5 h-5 text-gray-300 opacity-50 cursor-not-allowed" />

<!-- With Transition -->
<x-heroicon-o-plus class="w-5 h-5 text-gray-500 hover:text-brand-500 transition-colors duration-200" />
```

### Icon Variants
```blade
<!-- Outline (Default - untuk UI) -->
<x-heroicon-o-plus class="w-5 h-5" />

<!-- Solid (untuk emphasis) -->
<x-heroicon-s-plus class="w-5 h-5" />

<!-- Mini (20x20 - untuk compact UI) -->
<x-heroicon-m-plus class="w-5 h-5" />
```

---

## 💡 Usage Patterns

### Button with Icon
```blade
<!-- Icon Left -->
<button class="flex items-center gap-2">
    <x-heroicon-o-plus class="w-5 h-5" />
    <span>Tambah Data</span>
</button>

<!-- Icon Right -->
<button class="flex items-center gap-2">
    <span>Lihat Detail</span>
    <x-heroicon-o-arrow-right class="w-5 h-5" />
</button>

<!-- Icon Only -->
<button class="p-2">
    <x-heroicon-o-pencil class="w-5 h-5" />
</button>
```

### Input with Icon
```blade
<div class="relative">
    <input type="text" class="pl-10 ..." />
    <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
</div>
```

### Dropdown with Icon
```blade
<select class="...">
    <option>Pilih Status</option>
</select>
<x-heroicon-o-chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
```

### Badge with Icon
```blade
<span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-success-50 text-success-700">
    <x-heroicon-o-check-circle class="w-4 h-4" />
    <span>Published</span>
</span>
```

### Empty State
```blade
<div class="text-center py-12">
    <div class="inline-flex p-4 rounded-full bg-gray-100 mb-4">
        <x-heroicon-o-document-text class="w-8 h-8 text-gray-400" />
    </div>
    <h3 class="text-lg font-semibold">Belum ada data</h3>
    <p class="text-gray-500">Mulai dengan menambahkan data baru</p>
</div>
```

### Loading State
```blade
<x-heroicon-o-arrow-path class="w-5 h-5 animate-spin" />
```

---

## 🔍 Icon Search

### By Category

**Navigation:**
- `home`, `squares-2x2`, `bars-3`, `bars-3-bottom-left`

**Actions:**
- `plus`, `minus`, `pencil`, `trash`, `eye`, `eye-slash`

**Arrows:**
- `arrow-left`, `arrow-right`, `arrow-up`, `arrow-down`
- `chevron-left`, `chevron-right`, `chevron-up`, `chevron-down`

**Content:**
- `document`, `document-text`, `folder`, `photo`, `video-camera`

**Communication:**
- `envelope`, `phone`, `chat-bubble-left`, `bell`

**Status:**
- `check`, `check-circle`, `x-mark`, `x-circle`
- `exclamation-triangle`, `information-circle`

**User:**
- `user`, `user-circle`, `user-group`, `users`

**Settings:**
- `cog`, `cog-6-tooth`, `adjustments-horizontal`, `wrench`

**Business:**
- `building-office`, `building-office-2`, `building-library`
- `briefcase`, `chart-bar`, `currency-dollar`

### Full Icon List
Visit: https://heroicons.com/

---

## 📝 Best Practices

### DO ✅
- Use outline variant (`o-`) for most UI elements
- Keep icon size consistent in same context
- Use appropriate size (w-5 h-5 for buttons, w-6 h-6 for navigation)
- Add descriptive class names for context
- Use text-* classes for colors (better for dark mode)

### DON'T ❌
- Don't mix inline SVG with Heroicons
- Don't use inconsistent sizes in same section
- Don't forget to add proper spacing (gap-2, etc)
- Don't use fill-* classes (use text-* instead)
- Don't use solid variant everywhere (save for emphasis)

---

## 🎯 Project Standards

### Sidebar Navigation
- Size: `w-6 h-6`
- Variant: Outline (`o-`)
- Active color: `text-brand-500`
- Inactive color: `text-gray-500`

### Action Buttons
- Size: `w-5 h-5`
- Variant: Outline (`o-`)
- Spacing: `gap-2` with text

### Form Inputs
- Size: `w-5 h-5`
- Position: `absolute left-3 top-1/2 -translate-y-1/2`
- Color: `text-gray-400`

### Status Badges
- Size: `w-4 h-4`
- Variant: Solid (`s-`) or Outline (`o-`)
- Spacing: `gap-1` with text

### Empty States
- Size: `w-8 h-8` or `w-12 h-12`
- Container: Rounded background
- Color: `text-gray-400`

---

## 🔗 Resources

- **Heroicons Website:** https://heroicons.com/
- **Blade Package Docs:** https://github.com/blade-ui-kit/blade-heroicons
- **Tailwind CSS:** https://tailwindcss.com/
- **Project Docs:** See `ICON-ANALYSIS.md` and `ICON-IMPLEMENTATION-SUMMARY.md`
