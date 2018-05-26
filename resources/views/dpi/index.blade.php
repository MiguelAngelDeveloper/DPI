<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>
  <!-- Bootstrap core CSS-->
  <link href={{asset('vendor/bootstrap/css/bootstrap.min.css')}} rel="stylesheet">
  <link href={{asset('vendor/bootstrap/css/bootstrap-reboot.min.css')}} rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href={{asset('vendor/font-awesome/css/font-awesome.min.css')}} rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href={{asset('vendor/datatables/dataTables.bootstrap4.css')}} rel="stylesheet">
  <link href={{asset('css/jquery-ui.min.css')}} rel="stylesheet">
    <link href={{asset('css/jquery-ui.structure.min.css')}} rel="stylesheet">
      <link href={{asset('css/jquery-ui.theme.min.css')}} rel="stylesheet">
  <link href={{asset('css/jquery-ui-timepicker-addon.css')}} rel="stylesheet">
<!--  <link href={{asset('css/jquery.datetimepicker.min.css')}} rel="stylesheet"> -->
  <!-- Custom styles for this template-->
 <link href={{asset('css/sb-admin.css')}} rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-dark fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top" id="mainNav">
    <a class="navbar-brand" href="/">{{Config('app.name')}}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="acordeon">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="@lang('dpi.channels')">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseChannels" id="channels">
            <i class="fa fa-fw fa-tv"></i>
            <span class="nav-link-text">@lang('dpi.channels')</span>
          </a>
            <ul class="sidenav-second-level collapse" id="collapseChannels"  data-parent="#acordeon">
              <li>
                <a href="/channels">@lang('dpi.view')</a>
              </li>
              <li>
                <a href="/channels/create">@lang('dpi.insert')</a>
              </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="@lang('dpi.windows')">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseWindows">
            <i class="fa fa-fw fa-tasks"></i>
            <span class="nav-link-text">@lang('dpi.windows')</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseWindows"  data-parent="#acordeon">
            <li>
              <a href="/windows">@lang('dpi.view')</a>
            </li>
            <li>
              <a href="/windows/create">@lang('dpi.insert')</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="@lang('dpi.ads')">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAds">
            <i class="fa fa-fw fa-bullhorn"></i>
            <span class="nav-link-text">@lang('dpi.ads')</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAds"  data-parent="#acordeon">
            <li>
              <a href="/ads">@lang('dpi.view')</a>
            </li>
            <li>
              <a href="/ads/create">@lang('dpi.insert')</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="@lang('dpi.scheduling')">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseScheduling">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">@lang('dpi.scheduling')</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseScheduling"  data-parent="#acordeon">
            <li>
              <a href="/scheduling/view">@lang('dpi.view')</a>
            </li>
            <li>
              <a href="/scheduling/create">@lang('dpi.insert')</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="@lang('dpi.reports')">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#acordeon">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Informes</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.html">Navbar</a>
            </li>
            <li>
              <a href="cards.html">Cards</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>@lang('auth.logout')</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
@section('content')
  <h1>DashBoard</h1>
@show
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © {{Config('app.name')}} 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('auth.readytoleave')</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">@lang('auth.logoutconfirm')</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('dialogs.cancel')</button>
            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">@lang('auth.logout')</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->

    <script src={{asset("vendor/jquery/jquery.min.js")}}></script>
    <script src={{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <script src={{asset("vendor/bootstrap/js/popper.js")}}></script>
    <script src={{asset("vendor/bootstrap/js/tooltip.min.js")}}></script>
    <script src={{asset("vendor/bootstrap/js/bootstrap.min.js")}}></script>


    <!-- Core plugin JavaScript-->
    <script src={{asset("vendor/jquery-easing/jquery.easing.min.js")}}></script>
    <!-- Page level plugin JavaScript-->
    <script src={{asset("vendor/datatables/jquery.dataTables.js")}}></script>
    <script src={{asset("vendor/datatables/dataTables.bootstrap4.js")}}></script>
    <script src={{asset("js/jquery-ui.min.js")}}></script>
    <script src={{asset("js/jquery-ui-timepicker-addon.js")}}></script>
    <script src={{asset("js/datepicker-es.js")}}></script>
    <script src={{asset("js/jquery-ui-timepicker-addon-i18n.min.js")}}></script>
  <!--  <script src={{asset("js/jquery.datetimepicker.full.min.js")}}></script> -->

    <!-- Custom scripts for all pages-->
    <script src={{asset("js/sb-admin.min.js")}}></script>
    <!-- Custom scripts for this page-->
    <script src={{asset("js/sb-admin-datatables.min.js")}}></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle=tooltip]').tooltip();
        $.datepicker.setDefaults($.datepicker.regional['{{ app()->getLocale() }}']);
        $.timepicker.setDefaults($.timepicker.regional['{{ app()->getLocale() }}']);
        /*
        $.datetimepicker.setLocale('{{ app()->getLocale() }}');
          $('#init_date').datetimepicker({
            step: 1
          });
          $('#duration').datetimepicker({
            defaultTime: '00:00',
            datepicker: false,
            format: 'H:i',
            step: 1
          });
          */
          $('#init_date').datetimepicker({
            timeFormat: 'HH:mm:ss',
            controlType: 'select',
            oneLine: true
          });
          $('#duration').timepicker();
          $('#duration_ad').timepicker({
            timeFormat: 'HH:mm:ss'
          });
    });
    </script>

  </div>
</body>

</html>
