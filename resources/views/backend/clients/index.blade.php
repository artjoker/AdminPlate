@extends('backend.layouts.app')

@section('title', __('backend.clients'))

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">@lang('backend.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('backend.clients')</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">@lang('backend.clients') </h1>
    <!-- end page-header -->

    <div class="d-block d-md-flex align-items-center mb-3">
        <div class="d-flex">
            <!-- begin btn-group -->
            <div class="btn-group">
                @include('backend.elements.top_buttons', [
                            'create_link'  => route('backend.clients.create'),
                            'name'         => __('backend.create_client'),
                            ])
            </div>
            <!-- end btn-group -->
        </div>
    </div>

    <!-- begin panel -->
    <div class="panel panel-success">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">@lang('backend.clients')</h4>
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
                    <th width="20%">@lang('backend.name')</th>
                    <th width="20%">@lang('backend.email')</th>
                    <th width="15%">@lang('backend.phone')</th>
                    <th width="10%" data-orderable="false">@lang('backend.active')</th>
                    <th width="30%" data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($clients as $client)
                    <tr class="@if($loop->iteration  % 2 == 0) even @else odd @endif gradeA">
                        <td class="f-s-600 text-inverse">{{ $clients->firstItem() + $loop->index }}</td>
                        <td>{{ $client->first_name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>@if($client->active)
                                <span class="label label-success">@lang('backend.yes')</span>
                            @else
                                <span class="label label-default">@lang('backend.no')</span>
                            @endif
                        </td>
                        <td>
                            @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.clients.edit',['client'=> $client]),
                                'destroy_link' => route('backend.clients.destroy',['client' => $client]),
                                'restore_link' => route('backend.clients.restore',['client' => $client]),
                                'show_link'    => route('backend.clients.show', ['client' => $client]),
                                'model'        => $client,
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="gradeA">@lang('backend.nothing_found')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $clients->links() }}
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
@endsection

