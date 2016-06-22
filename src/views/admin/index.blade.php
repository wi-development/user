@extends('dashboard::layouts.master')

@section('content')
<!--Page Title-->
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
<!--End page title-->


<!--Breadcrumb-->
<ol class="breadcrumb">
    <li><a href="{{route('admin::dashboard')}}">Dashboard</a></li>
    <li><a href="{{route('admin::user.index')}}">Alle gebruikers</a></li>
    <li class="active">overzicht</li>
</ol>
<!--End breadcrumb-->


<!--Page content-->
<!--===================================================-->
<div id="page-content">






    <div class="panel">

        <div class="panel-heading">
            <div class="panel-control">
                <div class="btn-group">

                    <button data-target="#demo-chat-body" data-toggle="collapse" type="button" class="btn btn-default hidden"><i class="fa fa-chevron-down"></i></button>
                    <button data-toggle="dropdown" class="btn btn-default" type="button"><i class="fa fa-gear"></i></button>

                    <a class="btn btn-warning btn-labeled fa fa-save btn-lg" href="{{ route('admin::user.create') }}">Nieuwe gebruiker</a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Available</a></li>
                        <li><a href="#">Busy</a></li>
                        <li><a href="#">Away</a></li>
                        <li class="divider"></li>
                        <li><a data-target="#demo-chat-body" class="disabled-link" href="#" id="demo-connect-chat">Connect</a></li>
                        <li><a data-target="#demo-chat-body" href="#" id="demo-disconnect-chat">Disconect</a></li>
                    </ul>
                </div>
            </div>
            <h3 class="panel-title">
                Alle gebruikers
            </h3>

        </div>

        <!-- Foo Table - Filtering -->
        <!--===================================================-->

        <div class="panel-body">

            @include('flash::message')
            <table id="demo-foo-filtering" class="table table-bordered table-hover toggle-circle" data-page-size="6">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Rechten</th>
                    <th class="hidden-xs hidden-sm hidden-md">E-mail</th>
                    <th data-type="numeric" class="hidden-xs hidden-sm hidden-md">Created at</th>
                    <th data-sort-ignore="true">Edit</th>
                </tr>
                </thead>

                <div class="pad-btm form-inline">
                    <div class="row">
                        <div class="col-sm-6 text-xs-center">
                            <div class="form-group">
                                <label class="control-label">Rechten</label>
                                <select id="demo-foo-filter-status" class="form-control">
                                    <option value="">Alle</option>
                                    <option value="Root">Root</option>
                                    <option value="Administrator">Administator</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 text-xs-center text-right">
                            <div class="form-group">
                                <input id="demo-foo-search" type="text" placeholder="Search" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <tbody>
                @foreach($users as $key => $user)
                    <?php $cnt = ($key+1);if ($pagination)$cnt = $cnt+(($users->currentPage()-1)*$users->perPage());?>
                    <tr>
                        <td>{{$cnt}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{ $user->role->name }}</td>
                        <td class="hidden-xs hidden-sm hidden-md">{{$user->email}}</td>
                        <td class="hidden-xs hidden-sm hidden-md" data-value="{{$user->created_at->timestamp}}">
                            {{$user->created_at->diffForHumans()}}
                            {{$user->created_at->formatLocalized('%A %d %B %Y')}}
                        </td>
                        <td>

                            <a href="{{ route('admin::user.edit',[$user->id]) }}"
                               class="btn btn-primary btn-labeled fa fa-save"
                            >Wijzigen</a>


                            {{ Form::open(['method'=>'DELETE', 'route'=>array('admin::user.destroy',$user->id,'&name='.$user->name.'')])  }}
                            {{ Form::submit('Deletex', ['class' => '']) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
                </tbody>


                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="text-left pull-left">{{$users->total()}}  users</div>
                        <div class="text-right">
                            <ul class="pagination"></ul>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>



        </div>
        <!--===================================================-->
        <!-- End Foo Table - Filtering -->

    </div>









</div>
<!--===================================================-->
<!--End page content-->
@stop
