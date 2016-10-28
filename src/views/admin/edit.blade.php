@extends('dashboard::layouts.master')

@section('content')




        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Gebruikers beheer</h1>

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
            <li><a href="{{route('admin::user.all.index')}}">Alle gebruikers</a></li>
            <li class="active">Wijzigen</li>
        </ol>

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">
                <?php
                $frmHeader = "Profiel wijzigen van '".$user->name."'";
                ?>
               @include('errors.list')
                <!-- BASIC FORM ELEMENTS -->
                {{ Form::model($user,['method'=>'PATCH', 'route'=>array('admin::user.update',$user->id), 'class'=>'forxm-horizontal foxrm-padding']) }}
                {{--@include('errors.sitemap')--}}
                    @include('user::partials.form', ['submitButtonText' => 'Aanpassen','frmHeader' => ''.$frmHeader.''])
                {{ Form::close() }}
                <!-- END BASIC FORM ELEMENTS -->

            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->




@endsection


