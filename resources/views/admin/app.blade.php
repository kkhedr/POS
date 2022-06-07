<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ladies Shop</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">


    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.css') }}">
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('dist/css/image_style.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap4.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('css')
   <style>
       .content-wrapper{
           background-color: rgba(5, 4, 9, 0.85);
           color: rgba(5, 4, 9, 0.89);
       }

       /* @font-face {
  font-family: 'Musamim_Bold';
  src: url('../dist/fonts/Musamim_Bold.ttf');
  
}
a,h1,h2,h3,h4,label,strong,table th,table td{
    font-family: 'Musamim_Bold';
} */
   </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="border: none">
<div class="wrapper" >

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand" style="background-color: rgba(5,4,9,0.89);border: none">
        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto-navbav">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown" >
                <a style="color: #ffffff" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                   
                    <strong class="fas fa-door-open">تسجيل الخروج</strong>
                </a>

                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>


            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    @include ('admin.aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="border: none">

@yield('content_header')
        <!-- Main content -->
        <section class="content" style="border: none">
            <div class="container-fluid" style="border: none">
                @include('admin.partials._session')
@yield('content')

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="background-color: rgba(5,4,9,0.89);border: none">
        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> كل الحقوق محفوظة <i class="fa fa-heart" aria-hidden="true"></i> by <a style="color: #ffffff" href="/">Ladies shop</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('dist/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('dist/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dist/js/jszip.min.js') }}"></script>
<script src="{{ asset('dist/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('dist/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('dist/js/buttons.html5.min.js') }}"></script>

<!-- jQuery -->
{{--<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>--}}
<!-- jQuery UI 1.11.4 -->
{{--<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

@stack('js')
<script>
    $(document).ready(function(){
        var table = $('#data_table_show').DataTable( {
            "language": {
                "url": "{{asset('json_file/ar.json')}}"
            },
            'pageLength': 10,
            'lengthMenu': [[10, 20, 25, 50,100, -1], [10, 20, 25, 50,100, 'All']],


        } );
        //delete
        $('.delete').click(function (e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "تأكيد عملية المسح",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("مسح", 'btn btn-danger mr-2', function () {
                        that.closest('form').submit();
                    }),
                    Noty.button("إغلاق", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        });//end of delete
        //Approve

        // image preview
        $(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                    $(".image-preview").css("display", "block");
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        CKEDITOR.config.language =  "{{ app()->getLocale() }}";
    });
</script>


</body>
</html>
