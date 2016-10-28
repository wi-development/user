


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
    @include('errors.list')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{$frmHeader}}  </h3>
        </div>
        <div class="panel-body">







            @include('flash::message')

            {!!  Form::getFormGroupText('Naam','name',null,$errors) !!}

            {!!  Form::getFormGroupText('Label','label',null,$errors) !!}

            {!!  Form::getFormGroupText('Omschrijving','description',null,$errors) !!}




            <div class="form-group">
                {!! Form::label('permissiontype_id', 'permissiontype:') !!}
                {!! Form::select('permissiontype_id', $permissiontypes,null, ['class' => 'form-control','autocomplete'=>'off']) !!}
            </div>

        </div>
        <div class="panel-footer">
            <div class="form-group-x">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>