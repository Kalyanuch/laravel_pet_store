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
                                {{ \Diglactic\Breadcrumbs\Breadcrumbs::view('front.common.breadcrumbs', 'dashboard') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="section_title">{{ __('front.text_dashboard') }}</h1>
                </div>
                <div class="col-lg-3">
                    @include('front.account.account_menu')
                </div>
            </div>
        </div>
    </div>
@endsection
