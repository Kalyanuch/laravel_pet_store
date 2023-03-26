<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link{{ Route::currentRouteName() == 'admin.dashboard.index' ? ' active' : '' }}">
            <p>{{ __('admin.dashboard.dashboard') }}</p>
        </a>
    </li>
    <li class="nav-item{{ Route::is('admin.categories*') ? ' menu-is-opening menu-open' : '' }}">
        <a href="{{ route('admin.categories.index') }}" class="nav-link">
            <p>{{ __('admin.categories.title') }} <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link{{ Route::currentRouteName() == 'admin.categories.index' ? ' active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('admin.categories.list') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.create') }}" class="nav-link{{ Route::currentRouteName() == 'admin.categories.create' ? ' active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('admin.categories.add_new') }}</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item{{ Route::is('admin.products*') ? ' menu-is-opening menu-open' : '' }}">
        <a href="{{ route('admin.products.index') }}" class="nav-link">
            <p>{{ __('admin.products.title') }} <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link{{ Route::currentRouteName() == 'admin.products.index' ? ' active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('admin.products.list') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.create') }}" class="nav-link{{ Route::currentRouteName() == 'admin.products.create' ? ' active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('admin.products.add_new') }}</p>
                </a>
            </li>
        </ul>
    </li>
</ul>
