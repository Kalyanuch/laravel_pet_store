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
                                        <li><a href="index.html">Home</a></li>
                                        <li>Dashboard</li>
                                    </ul>
                                </div>
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
                    <h1 class="section_title">Dashboard</h1>
                </div>
                <div class="col-lg-3">
                    <ul>
                        <li>
                            <a href="{{ route('front.profile.edit') }}">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="this.closest('form').submit(); return false;">{{ __('front.text_logout') }}</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
