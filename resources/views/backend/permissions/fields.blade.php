<div class="col-xl-6 ui-sortable">
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="roleName">@lang('backend.name'):</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::text('name', null,['id'=>'roleName', 'class'=>'form-control','placeholder'=>__('backend.name'), 'required', 'data-parsley-required']) !!}
        </div>
    </div>
    <div class="form-group row m-b-15 m-t-30">
        <label class="col-md-4 col-sm-4"></label>
        <div class="col-md-8 col-sm-8">
            @include('backend.elements.save_buttons', ['back_link' => route('backend.permissions.index')])
        </div>
    </div>
</div>
