@extends('backend.layouts.app')

@section('title', __('backend.clients.label'))

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">@lang('backend.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.clients.index') }}">@lang('backend.clients')</a></li>
        <li class="breadcrumb-item active">{{ $client->fulName }}</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">{{ $client->fulName }}</h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-success">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">{{ $client->fulName }}</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

    @include('backend.elements.messages')
    <!-- begin panel-body -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                <tbody>
                <tr>
                    <td>@lang('backend.name')</td>
                    <td>{{ $client->first_name }}</td>
                </tr>
                <tr>
                    <td>@lang('backend.last_name')</td>
                    <td>{{ $client->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('backend.phone')</td>
                    <td>{{ $client->phone }}</td>
                </tr>
                <tr>
                    <td>@lang('backend.email')</td>
                    <td>{{ $client->email }}</td>
                </tr>
                <tr>
                    <td>@lang('backend.status')</td>
                    <td>{{ $client->status }}</td>
                </tr>
                <tr>
                    <td>@lang('backend.created_at')</td>
                    <td>{{ $client->created_at }}</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
@endsection

