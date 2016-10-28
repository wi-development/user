@extends('dashboard::layouts.master')

@section('content')

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Rollen beheer</h1>

        <!--Searchbox-->
        <div class="searchbox">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search..">
                        <span class="input-group-btn">
                            <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                        </span>
            </div>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="{{route('admin::dashboard')}}">Dashboard</a></li>
        <li><a href="{{route('admin::role.all.index')}}">Alle rollen</a></li>
        <li class="active">toevoegen</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">


        <div class="panel hidden">
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



        <div class="row">
            <div class="col-sm-6 hidden">
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
            <?php
            $frmHeader = "Nieuwe rol toevoegen";

/*
            if ((null !== (request()->get('parent_id')))){
                if (request()->get('parent_id') == 12){
                    $frmHeader .= " toevoegen aan 'Zorg thuis'";
                }

                if (request()->get('parent_id') == 2){
                    $frmHeader .= " toevoegen aan 'Wonen met zorg'";
                }

                if (request()->get('parent_id') == 18){
                    $frmHeader .= " toevoegen aan 'Services'";
                }
            }
*/
            ?>


            @include('errors.list')



            {{ Form::open(['route'=>array('admin::role.store'), 'class'=>'forxm-horizontal foxrm-padding']) }}

            @include('user::role.partials.form', ['submitButtonText' => 'Rol toevoegen','frmHeader'=>''.$frmHeader.''])


            {{ Form::close() }}

                    <!-- END BASIC FORM ELEMENTS -->

        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->

@endsection

