{{ html()->form('PATCH', route('admin.auth.account.password.update'))->class('form-horizontal')->open() }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('Old password')->for('old_password') }}

                {{ html()->password('old_password')
                    ->class('form-control')
                    ->placeholder('Old password')
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('Password')->for('password') }}

                {{ html()->password('password')
                    ->class('form-control')
                    ->placeholder('Password')
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('Password Confirmation')->for('password_confirmation') }}

                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->placeholder('Password Confirmation')
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
{{ html()->form()->close() }}
