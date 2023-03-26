@extends('front.layout.layout')

@section('content')
    <!-- Home -->
    <div class="home home-small">
        <div class="home_container">
            <div class="home_background" style="background-image:url({{ asset('assets/front/images/contact.jpg') }})"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="{{ route('front.homepage') }}">{{ __('front.text_home') }}</a></li>
                                        <li>{{ __('front.text_login') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="row">
                <!-- Get in touch -->
                <div class="col-lg-12 contact_col">
                    <div class="get_in_touch">
                        <div class="section_title">{{ __('front.text_login') }}</div>
                        <div class="contact_form_container">
                            <form action="{{ route('login') }}" method="post" id="login_form" class="contact_form">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <label for="email">{{ __('front.entry_email') }}</label>
                                        <input type="text" id="email" class="contact_input" name="email" value="{{ old('email') }}">
                                        @error('email') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-xl-6 last_name_col">
                                        <!-- Last Name -->
                                        <label for="password">{{ __('front.entry_password') }}</label>
                                        <input type="password" id="password" name="password" value="" class="contact_input">
                                        @error('password') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div>
                                    <input type="checkbox" id="remember" name="remember" class="regular_checkbox">
                                    <label for="remember"><img src="{{ asset('assets/front/images/check.png') }}" alt=""></label>
                                    <span class="checkbox_title">{{ __('front.account.entry_remember_me') }}</span>
                                </div>
                                <button type="submit" class="button contact_button newsletter_button"><span>{{ __('front.text_login') }}</span></button>
                                <a href="{{ route('password.request') }}">{{ __('front.account.text_forgot_password') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
