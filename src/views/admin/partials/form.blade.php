


<div class="col-sm-12 hidden">
    <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">With optional icons</h3>
    </div>
    <div class="panel-body">
        <!--Validation States-->
        <!--===================================================-->
        <div class="form-group has-feedback">
            <label for="demo-oi-definput" class="control-label">Default input</label>
            <input type="text" id="demo-oi-definput" class="form-control">
            <span class="fa fa-user fa-lg form-control-feedback"></span>
        </div>
        <div class="form-group has-success has-feedback">
            <label for="demo-oi-sccinput" class="control-label">Input with success</label>
            <input type="text" id="demo-oi-sccinput" class="form-control">
            <span class="fa fa-check fa-lg form-control-feedback"></span>
        </div>
        <div class="form-group has-warning has-feedback">
            <label for="demo-oi-warinput" class="control-label">Input with warning</label>
            <input type="text" id="demo-oi-warinput" class="form-control">
            <span class="fa fa-warning fa-lg form-control-feedback"></span>
        </div>
        <div class="form-group has-error has-feedback">
            <label for="demo-oi-errinput" class="control-label">Input with error</label>
            <input type="text" id="demo-oi-errinput" class="form-control">
            <span class="fa fa-times fa-lg form-control-feedback"></span>
        </div>
        <!--===================================================-->
        <!--End Validation States-->

    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-info" type="submit">Submit</button>
    </div>
</div>
</div>



<div class="col-lg-7">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{$frmHeader}}  </h3>
        </div>
        <div class="panel-body">
            @include('flash::message')

            {!!  Form::getFormGroupText('Name','name',null,$errors) !!}

            {!!  Form::getFormGroupText('E-mail','email',null,$errors) !!}

            {!!  Form::getFormGroupText('Username','username',null,$errors) !!}


            <div class="form-group">
                {!! Form::label('usertype_id', 'Usertypes:') !!}
                {!! Form::select('usertype_id',$usertypes , null,['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('role_id', 'Rechten:') !!}
                {{Form::select('roles[]',$roles,(isset($user) ? $user->roles->pluck('id')->all() : null),['multiple'=>true,'class'=>'form-control']) }}
            </div>


            <div class="form-group">
                {!! Form::label('company_id', 'Bedrijf:') !!}
                {!! Form::select('company_id',$companies , null,['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('locale_id', 'Taal:') !!}
                {!! Form::select('locale_id',$locales , null,['class' => 'form-control']) !!}
            </div>

            {!! Form::getFormGroupPassword('Wachtwoord','password',null,$errors) !!}

            {!! Form::getFormGroupPassword('Bevestig wachtwoord','password_confirmation',null,$errors) !!}


            <?php

            /*
<div class="form-group">
{!! Form::label('role_id', 'Rechten ORG:') !!}
{!! Form::select('role_id',$roles , null,['class' => 'form-control']) !!}
</div>



		<div class="form-group">
			{!! Form::label('role_id', 'Rechten NEEW:') !!}
			{!! Form::select('role_id',$roles , null,['class' => 'form-control']) !!}

			@foreach ($roles as $id => $name)
				{{dc($value)}}
				{{Form::checkbox('roles[]',$value,$user->roles->pluck('id')->all(),array('class'=>'form-control')) }}
				{!! Form::label('service' . $value, $role) !!}
			@endforeach
		</div>
*/


            /*
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
                */
                ?>

        </div>
        <div class="panel-footer">
            <div class="form-group-x">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>