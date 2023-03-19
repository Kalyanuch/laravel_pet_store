@extends('admin.layout.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.categories.title') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('front.homepage') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ __('admin.admin') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.categories.list') }}</li>
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
                    <h3 class="card-title">{{ __('admin.categories.edit') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @if ($errors->any())
                            @include('admin.common.form_error')
                        @endif
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn bg-gradient-success btn-lg">{{ __('admin.save') }}</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn bg-gradient-warning btn-lg">{{ __('admin.cancel') }}</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ __('admin.entry_title') }}</label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   value="{{ old('title', $category->title) }}"
                                   placeholder="{{ __('admin.entry_title') }}"
                                   @error('title') aria-describedby="title-error" aria-invalid="true"@enderror
                            >
                            @error('title')
                            <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_category">{{ __('admin.categories.entry_parent') }}</label>
                            <select name="parent_id" class="form-control" id="parent_category">
                                <option value="0">{{ __('admin.choose_from_list') }}</option>
                                @foreach($parent as $item)
                                    <option value="{{ $item->id }}" @if(old('parent_id', $category->parent_id) == $item->id) selected="selected"@endif>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ __('admin.entry_status') }}</label>
                            <select name="status" class="form-control" id="status">
                                <option value="0" @if(old('status', $category->status) == 0) selected="selected" @endif>{{ __('admin.disabled') }}</option>
                                <option value="1" @if(old('status', $category->status) == 1) selected="selected" @endif>{{ __('admin.enabled') }}</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn bg-gradient-success btn-lg">{{ __('admin.save') }}</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn bg-gradient-warning btn-lg">{{ __('admin.cancel') }}</a>
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
