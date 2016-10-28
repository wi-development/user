


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

        <!--Panel heading-->
        <div class="panel-heading">
            <div class="panel-control">
                <ul class="nav nav-tabs">
                    <li class="{{settings()->viewConfig('role_form_main_tab','info',['active','','default'])}}"><a href="#demo-tabs-box-1" data-user-settings='{"role_form_main_tab":"info"}' data-toggle="tab" aria-expanded="{{settings()->viewConfig('sitemap_form_left_tab','content',['true','false','default'])}}">Info</a></li>
                    <li class="{{settings()->viewConfig('role_form_main_tab','permission',['active',''])}}"><a href="#demo-tabs-box-2" data-user-settings='{"role_form_main_tab":"permission"}' data-toggle="tab" aria-expanded="{{settings()->viewConfig('sitemap_form_left_tab','banners',['true','false'])}}">Permissies</a></li>
                </ul>
            </div>
            <h3 class="panel-title">{{$frmHeader}}  </h3>

        </div>

        <!--Panel body-->
        <div class="panel-body">
            <div class="tab-content">
                @include('flash::message')
                <div class="tab-pane {{settings()->viewConfig('role_form_main_tab','info',['active in','','default'])}} fade" id="demo-tabs-box-1">

                    {!!  Form::getFormGroupText('Naam','name',null,$errors) !!}

                    {!!  Form::getFormGroupText('Label','label',null,$errors) !!}

                    {!!  Form::getFormGroupText('Omschrijving','description',null,$errors) !!}
                </div>
                <div class="tab-pane fade {{settings()->viewConfig('role_form_main_tab','permission',['active in',''])}}" id="demo-tabs-box-2">
                    <p>Hier kunnen alle permissie gezet worden van de gekozen rol. ()</p>



                    <div class="tab-base tab-stacked-left-uit">
                        <!--Nav tabs-->
                        <ul class="nav nav-tabs-uit nav-tabs-nested">
                        @foreach($permissions as $keyType => $permissionType)
                            <li class="{{($permissionType->class['nav-li'])}}">
                                <a data-toggle="tab" href="#tab-{{$keyType}}">{{$keyType}}</a>
                            </li>
                        @endforeach
                        </ul>



                        <!--Tabs Content-->
                        <div class="tab-content">
                            @foreach($permissions as $keyType => $permissionType)
                            <div id="tab-{{$keyType}}" class="tab-pane-even-uit fade-even-uit {{($permissionType->class['tab-div'])}}">
                                <h4 class="text-thin">permissies van {{$keyType}}</h4>
                                <p>Permissies van {{$keyType}}</p>

                                @foreach($permissionType as $key => $permission)
                                    {!! Form::getFormGroupCheckbox($permission->label,'permission_id[]',$permission->id,$permission->checked,$errors) !!}
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="panel-footer">
            <div class="form-group-x">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
@section('css.head')
<script src="/js/wi-form.js"></script>
@endsection