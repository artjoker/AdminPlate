<div class="col-xl-6 ui-sortable">
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="clientFirstName">@lang('backend.name')* :</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::text('first_name', null,['id'=>'clientFirstName', 'class'=>'form-control','placeholder'=>__('backend.name'), 'required', 'data-parsley-required']) !!}
        </div>
    </div>
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="clientLastName">@lang('backend.last_name')* :</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::text('last_name', null,['id'=>'clientLastName', 'class'=>'form-control','placeholder'=>__('backend.last_name'), 'required', 'data-parsley-required']) !!}
        </div>
    </div>
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="clientCreateEmail">@lang('backend.email')* :</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::email('email', null,['id'=>'clientCreateEmail', 'class'=>'form-control','placeholder'=>__('backend.email'),'required', 'data-parsley-required', 'data-parsley-type' => 'email']) !!}
            <small class="f-s-12 text-grey-darker">@lang('backend.email_help')</small>
        </div>
    </div>
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="clientCreatePhone">@lang('backend.phone'):</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::text('phone', null,['id'=>'clientCreatePhone', 'class'=>'form-control','placeholder'=>__('backend.phone'), 'data-parsley-type' => 'phone']) !!}
            <small class="f-s-12 text-grey-darker">@lang('backend.phone_help')</small>
        </div>
    </div>
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="active">@lang('backend.active'):</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::hidden('active', 0) !!}
            <div class="switcher">
                {!! Form::checkbox('active', 1, null, ['id' => 'switcher-active']) !!}
                <label for="switcher-active"></label>
            </div>
        </div>
    </div>
    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label text-lg-right" for="clientCreatePassword">@lang('backend.password'):</label>
        <div class="col-md-8 col-sm-8">
            {!! Form::password('password', ['id'=>'clientCreatePassword', 'class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row m-b-15 m-t-30">
        <label class="col-md-4 col-sm-4"></label>
        <div class="col-md-8 col-sm-8">
            @include('backend.elements.save_buttons', ['back_link' => route('backend.clients.index')])
        </div>
    </div>
</div>
