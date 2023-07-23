@if(isset($create_link) && isset($name) && (isset($permission) || isset($custom_permission)))
    @can($custom_permission ?? 'add ' . $permission)
        <a href="{{ $create_link }}" class="btn btn-block btn-sm btn-warning">
            <i class="fas fa-plus"></i>
            {{$name}}
        </a>
    @endcan
@endif

