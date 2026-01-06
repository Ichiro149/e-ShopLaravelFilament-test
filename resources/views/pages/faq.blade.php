@extends('layouts.app')

@section('title', __('pages.faq_title'))

@push('styles')
    @vite('resources/css/pages/pages.css')
@endpush

@section('content')
<div class="static-page">
    <div class="container">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => __('pages.faq_title')]
        ]" />

        <div class="page-header">
            <h1>{{ __('pages.faq_title') }}</h1>
            <p class="page-subtitle">{{ __('pages.faq_subtitle') }}</p>
        </div>

        <!-- FAQ Categories -->
        <div class="faq-container">
            <!-- Orders & Shipping -->
            <div class="faq-category">
                <h2 class="faq-category-title">
                    <svg viewBox="0 -960 960 960" fill="currentColor" width="24" height="24">
                        <path d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-40-343 237-137-237-137-237 137 237 137ZM160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11L160-252Zm320-228Z"/>
                    </svg>
                    {{ __('pages.faq_category_orders') }}
                </h2>

                <div class="faq-accordion" x-data="{ open: null }">
                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 1 ? null : 1" :class="{ 'active': open === 1 }">
                            <span>{{ __('pages.faq_q1') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 1 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 1" x-collapse>
                            <p>{{ __('pages.faq_a1') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 2 ? null : 2" :class="{ 'active': open === 2 }">
                            <span>{{ __('pages.faq_q2') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 2 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 2" x-collapse>
                            <p>{{ __('pages.faq_a2') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 3 ? null : 3" :class="{ 'active': open === 3 }">
                            <span>{{ __('pages.faq_q3') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 3 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 3" x-collapse>
                            <p>{{ __('pages.faq_a3') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments -->
            <div class="faq-category">
                <h2 class="faq-category-title">
                    <svg viewBox="0 -960 960 960" fill="currentColor" width="24" height="24">
                        <path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                    </svg>
                    {{ __('pages.faq_category_payments') }}
                </h2>

                <div class="faq-accordion" x-data="{ open: null }">
                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 4 ? null : 4" :class="{ 'active': open === 4 }">
                            <span>{{ __('pages.faq_q4') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 4 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 4" x-collapse>
                            <p>{{ __('pages.faq_a4') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 5 ? null : 5" :class="{ 'active': open === 5 }">
                            <span>{{ __('pages.faq_q5') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 5 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 5" x-collapse>
                            <p>{{ __('pages.faq_a5') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Returns & Refunds -->
            <div class="faq-category">
                <h2 class="faq-category-title">
                    <svg viewBox="0 -960 960 960" fill="currentColor" width="24" height="24">
                        <path d="M280-120 80-320l200-200 57 56-104 104h607v80H233l104 104-57 56Zm400-320-57-56 104-104H120v-80h607L623-784l57-56 200 200-200 200Z"/>
                    </svg>
                    {{ __('pages.faq_category_returns') }}
                </h2>

                <div class="faq-accordion" x-data="{ open: null }">
                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 6 ? null : 6" :class="{ 'active': open === 6 }">
                            <span>{{ __('pages.faq_q6') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 6 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 6" x-collapse>
                            <p>{{ __('pages.faq_a6') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 7 ? null : 7" :class="{ 'active': open === 7 }">
                            <span>{{ __('pages.faq_q7') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 7 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 7" x-collapse>
                            <p>{{ __('pages.faq_a7') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 8 ? null : 8" :class="{ 'active': open === 8 }">
                            <span>{{ __('pages.faq_q8') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 8 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 8" x-collapse>
                            <p>{{ __('pages.faq_a8') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account -->
            <div class="faq-category">
                <h2 class="faq-category-title">
                    <svg viewBox="0 -960 960 960" fill="currentColor" width="24" height="24">
                        <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/>
                    </svg>
                    {{ __('pages.faq_category_account') }}
                </h2>

                <div class="faq-accordion" x-data="{ open: null }">
                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 9 ? null : 9" :class="{ 'active': open === 9 }">
                            <span>{{ __('pages.faq_q9') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 9 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 9" x-collapse>
                            <p>{{ __('pages.faq_a9') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" @click="open = open === 10 ? null : 10" :class="{ 'active': open === 10 }">
                            <span>{{ __('pages.faq_q10') }}</span>
                            <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20" :class="{ 'rotate': open === 10 }">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/>
                            </svg>
                        </button>
                        <div class="faq-answer" x-show="open === 10" x-collapse>
                            <p>{{ __('pages.faq_a10') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Still have questions -->
        <div class="faq-cta">
            <div class="faq-cta-content">
                <h2>{{ __('pages.faq_still_questions') }}</h2>
                <p>{{ __('pages.faq_still_questions_text') }}</p>
                <a href="{{ route('pages.contact') }}" class="btn-primary">
                    <svg viewBox="0 -960 960 960" fill="currentColor" width="20" height="20">
                        <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                    </svg>
                    {{ __('pages.faq_contact_us') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
