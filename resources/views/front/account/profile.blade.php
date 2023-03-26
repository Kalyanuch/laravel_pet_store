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
                                        <li><a href="{{ route('front.dashboard') }}">{{ __('front.text_account') }}</a></li>
                                        <li>{{ __('front.text_profile') }}</li>
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
                <div class="col-lg-12">
                    <h1 class="section_title">{{ __('front.text_profile') }}</h1>
                </div>
                <div class="col-lg 3">
                    @include('front.account.account_menu')
                </div>
                <div class="col-lg-9">
                    <h2>{{ __('front.account.text_edit_profile_title') }}</h2>
                    <div class="information">{{ __('front.account.text_edit_profile_info') }}</div>
                    @if(session('status') === 'profile-updated')
                        <div class="success">{{ __('front.account.text_profile_updated') }}</div>
                    @endif
                    <form action="{{ route('front.profile.update') }}" method="post" id="login_form" class="contact_form">
                        @csrf
                        @method('patch')
                        <fieldset>
                            <div>
                                <label for="name">{{ __('front.entry_username') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="contact_input">
                                @error('name') <div class="error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label for="email">{{ __('front.entry_email') }}</label>
                                <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}" class="contact_input">
                                @error('email') <div class="error">{{ $message }}</div> @enderror
                            </div>
                        </fieldset>
                        <button type="submit" class="button contact_button newsletter_button"><span>{{ __('front.text_save') }}</span></button>
                    </form>
                    <hr/>
                    <h2>{{ __('front.account.text_update_password_title') }}</h2>
                    <div class="information">{{ __('front.account.text_update_password_info') }}</div>
                    @if(session('status') === 'password-updated')
                        <div class="success">{{ __('front.account.text_password_updated') }}</div>
                    @endif
                    <form action="{{ route('password.update') }}" method="post" id="login_form" class="contact_form">
                        @csrf
                        @method('put')
                        <fieldset>
                            <div>
                                <label for="current_password">{{ __('front.account.entry_current_password') }}</label>
                                <input type="password" id="current_password" name="current_password" value="" class="contact_input">
                                @error('current_password') <div class="error">{{ $message }}</div> @enderror
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
                        </fieldset>
                        <button type="submit" class="button contact_button newsletter_button"><span>{{ __('front.text_save') }}</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
