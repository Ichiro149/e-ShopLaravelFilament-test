@extends('layouts.app')

@section('title', __('pages.contact_title'))

@push('styles')
    @vite('resources/css/pages/pages.css')
@endpush

@section('content')
<div class="static-page">
    <div class="container">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => __('pages.contact_title')]
        ]" />

        <div class="page-header">
            <h1>{{ __('pages.contact_title') }}</h1>
            <p class="page-subtitle">{{ __('pages.contact_subtitle') }}</p>
        </div>

        <div class="contact-layout">
            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">
                        <svg viewBox="0 -960 960 960" fill="currentColor" width="28" height="28">
                            <path d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('pages.contact_address') }}</h3>
                        <p>123 Commerce Street<br>Riga, LV-1050, Latvia</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <svg viewBox="0 -960 960 960" fill="currentColor" width="28" height="28">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('pages.contact_email') }}</h3>
                        <p><a href="mailto:support@shop.com">support@shop.com</a></p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <svg viewBox="0 -960 960 960" fill="currentColor" width="28" height="28">
                            <path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('pages.contact_phone') }}</h3>
                        <p><a href="tel:+37120000000">+371 2000 0000</a></p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <svg viewBox="0 -960 960 960" fill="currentColor" width="28" height="28">
                            <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('pages.contact_hours') }}</h3>
                        <p>{{ __('pages.contact_hours_text') }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2>{{ __('pages.contact_form_title') }}</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('pages.contact.send') }}" method="POST" class="contact-form">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('pages.contact_name') }} *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('pages.contact_email_label') }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">{{ __('pages.contact_subject') }} *</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">{{ __('pages.contact_message') }} *</label>
                        <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">
                        <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20">
                            <path d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z"/>
                        </svg>
                        {{ __('pages.contact_send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
