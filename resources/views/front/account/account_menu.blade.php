<ul>
    <li>
        <a href="{{ route('front.dashboard') }}">{{ __('front.text_dashboard') }}</a>
    </li>
    <li>
        <a href="{{ route('front.profile.edit') }}">{{ __('front.text_profile') }}</a>
    </li>
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="this.closest('form').submit(); return false;">{{ __('front.text_logout') }}</a>
        </form>
    </li>
</ul>
