{{ html()->modelForm(auth()->user(), 'POST', route('admin.auth.account.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    @method('PATCH')


    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('Full Name')->for('full_name') }}

                {{ html()->text('name')
                    ->class('form-control')
                    ->placeholder('Full Name')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('Email')->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->placeholder('Email')
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
            {{ Form::submit('Update', ['class' => 'btn btn-success btn-sm pull-right']) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}

