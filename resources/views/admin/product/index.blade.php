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
                            <li class="breadcrumb-item active">{{ __('admin.products.list') }}</li>
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
                    <h3 class="card-title">{{ __('admin.products.list') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        @include('admin.common.form_success', ['success_message' => __('admin.products.success')])
                    @endif
                    @if (session()->has('error_delete'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> {{ __('admin.operation_failed') }}!</h5>
                            {{ __('admin.error_has_child') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('admin.products.create') }}" class="btn bg-gradient-info btn-lg">{{ __('admin.products.add_new') }}</a>
                        </div>
                    </div>
                    @if (count($products))
                        <table class="table table-bordered table-hovers mt-3">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('admin.column_title') }}</th>
                                <th>{{ __('admin.column_slug') }}</th>
                                <th>{{ __('admin.column_sort_order') }}</th>
                                <th>{{ __('admin.column_status') }}</th>
                                <th>{{ __('admin.column_actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $item)
                                @include('admin.product.row', ['item' => $item])
                            @endforeach
                            </tbody>
                        </table>
                        @include('admin.common.pagination_component', ['items' => $products])
                    @else
                        <p class="lead">{{ __('admin.list_empty') }}.</p>
                    @endif
                </div>
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
