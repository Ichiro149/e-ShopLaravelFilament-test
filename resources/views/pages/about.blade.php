@extends('layouts.app')

@section('title', __('pages.about_title'))

@push('styles')
    @vite('resources/css/pages/pages.css')
@endpush

@section('content')
<div class="about-page">
    <div class="container">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => __('pages.about_title')]
        ]" />

        <!-- Hero Section -->
        <section class="about-hero">
            <div class="about-hero__content">
                <span class="about-hero__badge">{{ __('pages.about_badge') }}</span>
                <h1 class="about-hero__title">{{ __('pages.about_title') }}</h1>
                <p class="about-hero__subtitle">{{ __('pages.about_subtitle') }}</p>
            </div>
        </section>

        <!-- Stats Strip -->
        <section class="about-stats-strip">
            <div class="stat-item">
                <span class="stat-item__number">10K+</span>
                <span class="stat-item__label">{{ __('pages.about_stat_customers') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-item__number">500+</span>
                <span class="stat-item__label">{{ __('pages.about_stat_products') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-item__number">99%</span>
                <span class="stat-item__label">{{ __('pages.about_stat_satisfaction') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-item__number">24/7</span>
                <span class="stat-item__label">{{ __('pages.about_stat_support') }}</span>
            </div>
        </section>

        <!-- Story Section -->
        <section class="about-story">
            <div class="about-story__image">
                <div class="story-visual">
                    <div class="story-visual__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="about-story__content">
                <span class="section-label">{{ __('pages.about_story_label') }}</span>
                <h2>{{ __('pages.about_mission_title') }}</h2>
                <p>{{ __('pages.about_mission_text') }}</p>
                <div class="about-story__features">
                    <div class="feature-check">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span>{{ __('pages.about_feature_quality') }}</span>
                    </div>
                    <div class="feature-check">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span>{{ __('pages.about_feature_fast') }}</span>
                    </div>
                    <div class="feature-check">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span>{{ __('pages.about_feature_support') }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="about-values-section">
            <div class="section-header">
                <span class="section-label">{{ __('pages.about_values_label') }}</span>
                <h2>{{ __('pages.about_values_title') }}</h2>
            </div>
            <div class="values-cards">
                <div class="value-card-new">
                    <div class="value-card-new__icon value-card-new__icon--orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3>{{ __('pages.about_value_quality') }}</h3>
                    <p>{{ __('pages.about_value_quality_text') }}</p>
                </div>
                <div class="value-card-new">
                    <div class="value-card-new__icon value-card-new__icon--blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <h3>{{ __('pages.about_value_support') }}</h3>
                    <p>{{ __('pages.about_value_support_text') }}</p>
                </div>
                <div class="value-card-new">
                    <div class="value-card-new__icon value-card-new__icon--green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"/>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                    </div>
                    <h3>{{ __('pages.about_value_delivery') }}</h3>
                    <p>{{ __('pages.about_value_delivery_text') }}</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="about-cta">
            <div class="about-cta__content">
                <h2>{{ __('pages.about_team_title') }}</h2>
                <p>{{ __('pages.about_team_text') }}</p>
                <a href="{{ route('products.index') }}" class="about-cta__btn">
                    <span>{{ __('pages.about_team_cta') }}</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
