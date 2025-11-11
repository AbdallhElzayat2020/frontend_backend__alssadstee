@extends('website.layouts.master')
@section('title', 'Quote')
@section('content')
    <!-- Quote Page Header -->
    <section class="about-page-header">
        <div class="about-header-overlay"></div>
        <div class="container">
            <div class="about-header-content">
                <h1 class="about-page-title">{{ __('quote.title') }}</h1>
            </div>
        </div>
    </section>

    <!-- Quote Request Section -->
    <section class="jobs-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="jobs-intro text-center mb-5">
                        <h2 class="jobs-main-title mb-3">{{ __('quote.intro_title') }}</h2>
                        <p class="jobs-subtitle">{{ __('quote.intro_subtitle') }}</p>
                    </div>

                    <div class="jobs-form-card p-4 p-lg-5 rounded-4 shadow-lg">
                        <h3 class="form-title mb-4">
                            <i class="fas fa-file-invoice-dollar me-2"></i>
                            {{ __('quote.form_title') }}
                        </h3>

                        <form id="quoteRequestForm" action="{{ route('quote.store') }}" method="POST">
                            @csrf
                            <!-- Company Information -->
                            <div class="form-section mb-4">
                                <h4 class="section-title mb-3">
                                    <i class="fas fa-building me-2"></i>
                                    {{ __('quote.form_company_info') }}
                                </h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">{{ __('quote.form_company_name') }}</label>
                                        <input required value="{{ old('name') }}" type="text"
                                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                                            id="name" name="name"
                                            placeholder="{{ __('quote.form_company_name_placeholder') }}" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">{{ __('quote.form_company_email') }}</label>
                                        <input required value="{{ old('email') }}" type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            placeholder="{{ __('quote.form_company_email_placeholder') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">{{ __('quote.form_company_phone') }}</label>
                                        <input required value="{{ old('phone') }}" type="tel"
                                            class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            placeholder="{{ __('quote.form_company_phone_placeholder') }}" />
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subject" class="form-label">{{ __('quote.form_product_type') }}</label>
                                        <select required
                                            class="form-select form-select-lg @error('subject') is-invalid @enderror"
                                            id="subject" name="subject">
                                            <option value="">{{ __('quote.form_select_product_type') }}</option>
                                            <option value="rebar" {{ old('subject') == 'rebar' ? 'selected' : '' }}>
                                                {{ __('quote.form_product_rebar') }}
                                            </option>
                                            <option value="pipes" {{ old('subject') == 'pipes' ? 'selected' : '' }}>
                                                {{ __('quote.form_product_pipes') }}
                                            </option>
                                            <option value="bars" {{ old('subject') == 'bars' ? 'selected' : '' }}>
                                                {{ __('quote.form_product_bars') }}
                                            </option>
                                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>
                                                {{ __('quote.form_product_other') }}
                                            </option>
                                        </select>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="message"
                                            class="form-label">{{ __('quote.form_additional_info') }}</label>
                                        <textarea
                                            class="form-control form-control-lg @error('message') is-invalid @enderror"
                                            id="message" name="message" rows="4"
                                            placeholder="{{ __('quote.form_additional_info_placeholder') }}">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Terms and Conditions -->
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" required type="checkbox" id="quoteTerms" />
                                        <label class="form-check-label" for="quoteTerms">
                                            {{ __('quote.form_terms') }} <a href="#"
                                                class="text-primary">{{ __('quote.form_terms_link') }}</a>
                                            {{ __('quote.form_terms_text') }}
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg rounded-3 py-3">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            {{ __('quote.form_submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
