@extends('layouts.app')

@section('title', __('profile.title'))

@push('styles')
    @vite('resources/css/profile/profileedit.css')
    
@endpush

@push('scripts')
    @vite('resources/js/profile/profileedit.js')
@endpush

@section('content')
<main class="profile-page">
  <div class="profile-container">
    {{-- Status Message --}}
    @if(session('status'))
      <div class="status-toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('status') }}
      </div>
    @endif

    {{-- Page Header --}}
    <header class="profile-header">
      <div class="profile-header-content">
        <div class="profile-avatar-section">
          <div class="avatar-wrapper" id="avatarPreview">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
            <label class="avatar-upload-btn" for="avatarInput" title="{{ __('profile.change_avatar') }}">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            </label>
          </div>
          <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" id="avatarForm" class="hidden-form">
            @csrf
            <input type="file" name="avatar" id="avatarInput" accept="image/*" onchange="this.form.submit()">
          </form>
        </div>
        <div class="profile-info">
          <h1 class="profile-name">
            {{ $user->name }}
            @if($user->hasRole('admin'))
              <span class="admin-badge" data-tooltip="{{ __('profile.admin') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L15.5 8.5L23 9.5L17.5 15L19 23L12 19L5 23L6.5 15L1 9.5L8.5 8.5L12 1Z"/></svg>
                Admin
              </span>
            @endif
          </h1>
          <p class="profile-email">{{ $user->email }}</p>
          <div class="profile-meta">
            <span class="meta-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              {{ __('profile.member_since') }} {{ $user->created_at->format('M Y') }}
            </span>
          </div>
        </div>
      </div>

      {{-- Quick Actions --}}
      <div class="profile-actions">
        @if($user->hasRole('admin'))
          <a href="/admin" target="_blank" class="action-btn action-btn--admin">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
            {{ __('profile.open_admin') }}
          </a>
        @endif
        @if($user->isSeller())
          <a href="/seller" target="_blank" class="action-btn action-btn--seller">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            {{ __('profile.open_seller') }}
          </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="inline-form">
          @csrf
          <button type="submit" class="action-btn action-btn--danger">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </button>
        </form>
      </div>
    </header>

    {{-- Main Content Grid --}}
    <div class="profile-grid">
      {{-- Left Column --}}
      <div class="profile-column">
        {{-- Account Settings --}}
        <section class="profile-section">
          <div class="section-header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <h2>{{ __('profile.account_settings') }}</h2>
          </div>
          <form method="POST" action="{{ route('profile.update') }}" class="settings-form">
            @csrf
            <div class="form-group">
              <label class="form-label">{{ __('profile.name') }}</label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
              @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('profile.email') }}</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
              @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">{{ __('profile.new_password') }}</label>
                <input type="password" name="password" class="form-input" autocomplete="new-password" placeholder="••••••••">
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label class="form-label">{{ __('profile.confirm_password') }}</label>
                <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password" placeholder="••••••••">
              </div>
            </div>
            <button type="submit" class="btn-primary">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              {{ __('profile.save_account') }}
            </button>
          </form>
        </section>

        {{-- Two-Factor Authentication --}}
        <section class="profile-section">
          <div class="section-header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <h2>{{ __('profile.two_factor') }}</h2>
          </div>

          @if($user->hasTwoFactorEnabled())
            {{-- 2FA Enabled --}}
            <div class="two-factor-status two-factor-status--enabled">
              <div class="status-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              </div>
              <div class="status-text">
                <strong>{{ __('profile.two_factor_enabled') }}</strong>
                <span>{{ __('profile.two_factor_protected') }}</span>
              </div>
            </div>

            <div class="two-factor-actions">
              <a href="{{ route('two-factor.index') }}" class="btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                {{ __('profile.two_factor_manage') }}
              </a>
            </div>
          @else
            {{-- 2FA Not Enabled --}}
            <div class="two-factor-status two-factor-status--disabled">
              <div class="status-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </div>
              <div class="status-text">
                <strong>{{ __('profile.two_factor_disabled') }}</strong>
                <span>{{ __('profile.two_factor_add_security') }}</span>
              </div>
            </div>

            <div class="two-factor-actions">
              <a href="{{ route('two-factor.setup') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                {{ __('profile.two_factor_enable') }}
              </a>
            </div>

            <p class="section-hint">{{ __('profile.two_factor_hint') }}</p>
          @endif
        </section>

        {{-- Danger Zone --}}
        <section class="profile-section profile-section--danger">
          <div class="section-header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <h2>{{ __('profile.danger_zone') }}</h2>
          </div>
          <p class="section-desc">{{ __('profile.password_hint') }}</p>
          <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('{{ __('profile.delete_confirm') }}');" class="danger-form">
            @csrf
            @method('DELETE')
            <div class="form-group">
              <input type="password" name="current_password" class="form-input" placeholder="{{ __('profile.current_password') }}">
            </div>
            <button type="submit" class="btn-danger">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              {{ __('profile.delete_account') }}
            </button>
          </form>
        </section>
      </div>

      {{-- Right Column --}}
      <div class="profile-column">
        {{-- Company Info (for sellers) --}}
        @if($user->hasRole('seller'))
          <section class="profile-section" id="company-info">
            <div class="section-header">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              <h2>{{ __('company.my_company') }}</h2>
            </div>

            @if($user->hasCompany())
              @php $company = $user->company; @endphp
              <div class="company-card">
                <div class="company-card__header">
                  <img class="company-card__logo" 
                    src="{{ $company->logo_url }}" 
                    alt="{{ $company->name }}">
                  <div class="company-card__info">
                    <h3 class="company-card__name">
                      {{ $company->name }}
                      @if($company->is_verified)
                        <svg class="verified-badge" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                      @endif
                    </h3>
                    <span class="company-card__stats">
                      {{ $company->products()->count() }} {{ __('company.products') }} · 
                      {{ $company->followers()->count() }} {{ __('company.followers') }}
                    </span>
                  </div>
                </div>
                <div class="company-card__actions">
                  <a href="{{ $company->url }}" class="btn-secondary" target="_blank">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    {{ __('company.view_page') }}
                  </a>
                  <a href="{{ route('filament.seller.resources.companies.edit', $company) }}" class="btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    {{ __('company.edit') }}
                  </a>
                </div>
              </div>
            @else
              <div class="empty-company">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <p>{{ __('company.no_company_yet') }}</p>
                <a href="{{ route('filament.seller.resources.companies.create') }}" class="btn-primary">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                  {{ __('company.create_company') }}
                </a>
              </div>
            @endif
          </section>
        @endif

        {{-- Followed Companies --}}
        @if($user->followedCompanies()->count() > 0)
          <section class="profile-section" id="followed-companies">
            <div class="section-header">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <h2>{{ __('company.followed_companies') }}</h2>
            </div>

            <div class="followed-companies-list">
              @foreach($user->followedCompanies()->take(5)->get() as $followedCompany)
                <a href="{{ $followedCompany->url }}" class="followed-company-item">
                  <img class="followed-company-logo" 
                    src="{{ $followedCompany->logo_url }}" 
                    alt="{{ $followedCompany->name }}">
                  <div class="followed-company-info">
                    <span class="followed-company-name">
                      {{ $followedCompany->name }}
                      @if($followedCompany->is_verified)
                        <svg class="verified-badge" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                      @endif
                    </span>
                    <span class="followed-company-products">{{ $followedCompany->products()->count() }} {{ __('company.products') }}</span>
                  </div>
                </a>
              @endforeach
            </div>

            @if($user->followedCompanies()->count() > 5)
              <a href="{{ route('companies.index') }}" class="view-all-link">
                {{ __('company.view_all_companies') }} →
              </a>
            @endif
          </section>
        @endif
      </div>
    </div>
  </div>
</main>
@endsection

