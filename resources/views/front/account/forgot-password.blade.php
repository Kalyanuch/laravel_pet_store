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
                                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                                        <li>Forgot password?</li>
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
                        <div class="section_title">{{ __('front.account.text_forgot_password') }}</div>
                        <div>{{ __('front.account.text_forgot_info') }}
                        </div>
                        <div class="contact_form_container">
                            <form action="{{ route('password.email') }}" method="post" id="login_form" class="contact_form">
                                @csrf
                                <div>
                                    <label for="email">{{ __('front.entry_email') }}</label>
                                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="contact_input">
                                    @error('email') <div class="error">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="button contact_button newsletter_button"><span>{{ __('front.text_login') }}</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
