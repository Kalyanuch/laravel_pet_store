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
                                {{ \Diglactic\Breadcrumbs\Breadcrumbs::view('front.common.breadcrumbs', 'register') }}
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
                        <div class="section_title">{{ __('front.text_register') }}</div>
                        <div class="contact_form_container">
                            <form action="{{ route('register') }}" method="post" id="login_form" class="contact_form">
                                @csrf
                                <div>
                                    <label for="name">{{ __('front.entry_username') }}</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="contact_input">
                                    @error('name') <div class="error">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="email">{{ __('front.entry_email') }}</label>
                                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="contact_input">
                                    @error('email') <div class="error">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="password">{{ __('front.entry_password') }}</label>
                                    <input type="password" id="password" name="password" value="" class="contact_input">
                                    @error('password') <div class="error">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation">{{ __('front.entry_confirm') }}</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" value="" class="contact_input">
                                    @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="button contact_button newsletter_button"><span>{{ __('front.text_register') }}</span></button>
                                <a href="{{ route('login') }}">{{ __('front.account.text_already_registered') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
