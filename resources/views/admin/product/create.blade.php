@extends('admin.layout.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.products.title') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('front.homepage') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ __('admin.admin') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('admin.products.list') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.products.add_new') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.products.edit') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.products.store') }}">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            @include('admin.common.form_error')
                        @endif
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn bg-gradient-success btn-lg">{{ __('admin.save') }}</button>
                                <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-warning btn-lg">{{ __('admin.cancel') }}</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ __('admin.entry_title') }}</label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   value="{{ old('title') }}"
                                   placeholder="{{ __('admin.entry_title') }}"
                                   @error('title') aria-describedby="title-error" aria-invalid="true"@enderror
                            >
                            @error('title')
                            <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">{{ __('admin.entry_description') }}</label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      placeholder="{{ __('admin.entry_description') }}"
                                      @error('description') aria-describedby="title-error" aria-invalid="true"@enderror
                            >{{ old('description') }}</textarea>
                            @error('description')
                            <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sort_order">{{ __('admin.entry_sort_order') }}</label>
                            <input type="text"
                                   name="sort_order"
                                   class="form-control @error('sort_order') is-invalid @enderror"
                                   id="sort_order"
                                   value="{{ old('sort_order') }}"
                                   placeholder="{{ __('admin.entry_sort_order') }}"
                            >
                            @error('sort_order')
                            <span id="sort-order-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">{{ __('admin.entry_status') }}</label>
                            <select name="status" class="form-control" id="status">
                                <option value="0" @if(old('status') == 0) selected="selected" @endif>{{ __('admin.disabled') }}</option>
                                <option value="1" @if(old('status') == 1) selected="selected" @endif>{{ __('admin.enabled') }}</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn bg-gradient-success btn-lg">{{ __('admin.save') }}</button>
                                <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-warning btn-lg">{{ __('admin.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
