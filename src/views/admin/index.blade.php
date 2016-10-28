@extends('dashboard::layouts.master')


@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">{{$tableConfig['header']}}</h1>
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
        <li class="active">Alle gebruikers</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        @include('flash::message')
        <div class="panel">

            <div class="panel-heading">
                <div class="panel-control wi-control">
                        <span id="createPageUIT">
                            <a class="btn btn-warning btn-labeled fa fa-cog btn-defxault"
                                   href="{{route('admin::user.create')}}">
                                Nieuwe gebruiker toevoegen
                            </a>
                        </span>
                </div>
                <h3 class="panel-title">
                    Overzicht van alle gebruikers
                </h3>

            </div>

            <!-- Laravel/DataTables Table - Filtering -->
            <!--===================================================-->

            <div class="panel-body">
                <table class="table table-bordered table-hover toggle-circle table-striped-uit sortable-uit showExtraData" id="users-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Naam</th>
                        <th>Bedrijf</th>
                        <th>Type</th>
                        <th>Rechten</th>
                        <th>Gewijzigd op</th>
                        <th>Actie</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Naam</th>
                        <th>Bedrijf</th>
                        <th>Type</th>
                        <th>Rechten</th>
                        <th>Gewijzigd op</th>
                        <th>Actie</th>

                    </tr>
                    </tfoot>
                </table>
            </div>
            <!--===================================================-->
            <!-- End Laravel/DataTables - Filtering -->
        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
@endsection


@section('css.head')
    <link href="https://cdn.datatables.net/t/bs/dt-1.10.11,rr-1.1.1/datatables.min.css" rel="stylesheet">
@endsection


@section('scripts.footer')

    <!--<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/t/bs/dt-1.10.11,rr-1.1.1/datatables.min.js"></script>
    -->
    <script type="text/javascript" src="/js/wi/datatables/datatables-tonny.js"></script>
    <script type="text/javascript" src="/themes/nifty-2.4.1/vendor/bootbox/bootbox.min.js"></script>
    <!--<script src="/js/dashboard.js"></script>-->
    <script src="/js/wi-data.js"></script>
    <script>
        var tableConfig = {

            urlIndex: '',//niet gebruikt geen subpage
            urlDataRoot: '',//niet gebruikt subpage
            urlData: '{{route('admin::user.all.data')}}',

            urlSort: '{{ route('admin::sitemap.sort')}}',
            urlWiDeleteUser: '{{ route('admin::user.destroy')}}',
            csrf_token: '{{ csrf_token() }}',

            customSearchButtonValue:'groep',
            customSearchColumn:'roles.name',
            customSearchColumnValues:{!! $tableConfig['customSearchColumnValues'] !!},

            allowSortable:'{{$tableConfig['allowSortable']}}',

            orderColumnInit:1,
            orderColumnInitType:'asc',
            columns: [
                //{data: 'path', name: 'path',visible:true, searchable: false,class:'dragpointer',width:'1%'},
                {data: 'id', name: 'users.id',visible:true},

                {data: 'user_name', name: 'users.name',searchable: true,widthx:'40%' },
                {data: 'company_name', name: 'companies.name',visible:true},
                {data: 'usertype_name', name: 'usertypes.name',visible:true},


                {data: 'roles_name', name: 'roles.name',searchable: true,widthx:'40%' },

                //{data: 'locaties', name: 'sctest_st.name'},
                //{data: 'description', name: 'description',searchable: true,widthx:'100px' },
                //{data: 'published_at', name: 'sitemaptranslations.published_at'},
                //{data: 'created_at', name: 'sitemaps.created_at',searchable: true,widthx:'140px',visible:false },
                {data: 'users.updated_at', name: 'users.updated_at',searchable: true,widthx:'140px' },
                {data: 'action', name: 'action', orderable: false, searchable: false,visible:true,width:'1px'}
            ],
            "language": {
                "lengthMenu": "Toon _MENU_  gebruikers per pagina",
                "zeroRecords": "Geen gebruiker gevonden",
                //"info": "Toon pagina _PAGE_ van _PAGES_ _TOTAL_",
                "info" :  "Toon _START_ t/m _END_ van _TOTAL_ items",
                "infoEmpty": "Geen pagina's beschikbaar",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "first":      "Eerste",
                    "last":       "Laatste",
                    "next":       "Volgende",
                    "previous":   "Vorige"
                },
                //"processing":     "Processing...",
                "search":         "Zoeken:"
            },
            "pageLength":10,
            "bulkActions":false
        };
        //console.info({!! $tableConfig['customSearchColumnValues'] !!});
        setTable(tableConfig);
    </script>
@endsection


