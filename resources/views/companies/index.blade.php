@extends('layouts.app')

@section('title', __('company.all_companies'))

@push('styles')
    @vite('resources/css/pages/company.css')
@endpush

@section('content')
<div class="companies-page">
    <div class="container">
        <div class="page-header">
            <h1>{{ __('company.all_companies') }}</h1>
            <p class="page-subtitle">{{ __('company.discover_sellers') }}</p>
        </div>

        <!-- Filters -->
        <div class="companies-filters">
            <form action="{{ route('companies.index') }}" method="GET" class="filters-form">
                <div class="search-input-wrapper">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="{{ __('company.search_placeholder') }}" class="form-input">
                </div>
                <div class="sort-wrapper">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>{{ __('company.sort_name') }}</option>
                        <option value="products" {{ request('sort') === 'products' ? 'selected' : '' }}>{{ __('company.sort_products') }}</option>
                        <option value="followers" {{ request('sort') === 'followers' ? 'selected' : '' }}>{{ __('company.sort_followers') }}</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>{{ __('company.sort_newest') }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('common.search') }}</button>
            </form>
        </div>

        <!-- Companies Grid -->
        @if($companies->count() > 0)
            <div class="companies-grid">
                @foreach($companies as $company)
                    <a href="{{ route('companies.show', $company->slug) }}" class="company-card">
                        <div class="company-card__logo">
                            @if($company->logo_url)
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}">
                            @else
                                <div class="company-card__logo-placeholder">
                                    {{ strtoupper(substr($company->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="company-card__info">
                            <h3 class="company-card__name">
                                {{ $company->name }}
                                @if($company->is_verified)
                                    <span class="company-verified-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                                            <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </h3>
                            @if($company->short_description)
                                <p class="company-card__description">{{ Str::limit($company->short_description, 100) }}</p>
                            @endif
                            <div class="company-card__stats">
                                <span>{{ $company->products_count }} {{ __('company.products') }}</span>
                                <span>{{ $company->followers_count }} {{ __('company.followers') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $companies->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <h3>{{ __('company.no_companies') }}</h3>
                <p>{{ __('company.no_companies_text') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
