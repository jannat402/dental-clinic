@php $size = $size ?? 32; $stroke = '#b8c9d5'; @endphp

{{-- Doctor / Stethoscope --}}
@if($icon === 'doctor')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M4 8a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v2a6 6 0 0 1-6 6h-4a6 6 0 0 1-6-6V8z"/>
  <path d="M15 14v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4"/>
  <circle cx="8" cy="11" r="1"/>
  <circle cx="12" cy="11" r="1"/>
  <circle cx="16" cy="11" r="1"/>
</svg>
@endif

{{-- Client / Person --}}
@if($icon === 'client')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="8" r="4"/>
  <path d="M20 21a8 8 0 1 0-16 0"/>
</svg>
@endif

{{-- Treatment / Cross --}}
@if($icon === 'treatment')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M9 3h6v6h6v6h-6v6H9v-6H3V9h6V3z"/>
</svg>
@endif

{{-- Admin / Shield --}}
@if($icon === 'admin')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M12 2l7 4v5c0 5-3.5 9.7-7 11-3.5-1.3-7-6-7-11V6l7-4z"/>
  <path d="M9 12l2 2 4-4"/>
</svg>
@endif

{{-- Schedule / Clock --}}
@if($icon === 'schedule')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="10"/>
  <path d="M12 6v6l4 2"/>
</svg>
@endif

{{-- Cita / Clipboard --}}
@if($icon === 'appointment')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <rect x="4" y="3" width="16" height="18" rx="2"/>
  <path d="M9 3v2h6V3"/>
  <path d="M8 10h8"/>
  <path d="M8 14h8"/>
  <path d="M8 18h5"/>
</svg>
@endif

{{-- Payment / Card --}}
@if($icon === 'payment')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <rect x="2" y="5" width="20" height="14" rx="2"/>
  <path d="M2 10h20"/>
  <path d="M6 15h4"/>
</svg>
@endif

{{-- Document / File --}}
@if($icon === 'document')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
  <path d="M14 2v6h6"/>
  <path d="M8 13h8"/>
  <path d="M8 17h8"/>
</svg>
@endif

{{-- Plus --}}
@if($icon === 'plus')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="10"/>
  <path d="M12 8v8"/>
  <path d="M8 12h8"/>
</svg>
@endif

{{-- Calendar --}}
@if($icon === 'calendar')
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="{{ $stroke }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <rect x="3" y="4" width="18" height="18" rx="2"/>
  <path d="M3 10h18"/>
  <path d="M8 2v4"/>
  <path d="M16 2v4"/>
</svg>
@endif
