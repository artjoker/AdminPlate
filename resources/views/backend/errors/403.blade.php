@extends('backend.layouts.empty')

@section('title', '403 Error Page')

@section('content')
    <!-- begin error -->
    <div class="error">
        <div class="error-code">403</div>
        <div class="error-content">
            <div class="error-message">Forbidden</div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                You don’t have permission to access this route.<br />
                Perhaps, there pages will help find what you're looking for.
            </div>
            <div>
                <a href="{{ route('backend.dashboard') }}" class="btn btn-success p-l-20 p-r-20">Go Home</a>
            </div>
        </div>
    </div>
    <!-- end error -->
@endsection

