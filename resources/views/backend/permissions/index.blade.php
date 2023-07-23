@extends('backend.layouts.app')

@section('title', __('backend.permissions'))

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">@lang('backend.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('backend.permissions')</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">@lang('backend.permissions') </h1>
    <!-- end page-header -->

    <div class="d-block d-md-flex align-items-center mb-3">
        <div class="d-flex">
            <!-- begin btn-group -->

            <!-- end btn-group -->
        </div>
    </div>

    <!-- begin panel -->
    <div class="panel panel-success">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">@lang('backend.permissions')</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

        @include('backend.elements.messages')

        <!-- begin panel-body -->
        <div class="panel-body">
            <table class="table table-striped table-bordered table-td-valign-middle">
                <thead>
                <tr>
                    <th width="1%">#</th>
                    <th>@lang('backend.name')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $currPermission)
                    <tr class="@if($loop->iteration  % 2 === 0) even @else odd @endif gradeA">
                        <td class="f-s-600 text-inverse">{{ $permissions->firstItem() + $loop->index }}</td>
                        <td>{{ $currPermission->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="gradeA">@lang('backend.nothing_found')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $permissions->links() }}
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
@endsection
