<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('images/site/logo.png')}}">

    <title>
        {{$siteName}}
        |
        @yield('title')
    </title>

    @yield('styles')

{{--<link href="{{url('/design/admin')}}/assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />--}}
<!-- DataTables -->
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{url('/design/admin')}}/assets/plugins/morris/morris.css">

    <!-- App css -->
    <link href="{{url('/design/admin')}}/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <link href="{{url('/design/admin')}}/assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{url('/design/admin')}}/assets/js/modernizr.min.js"></script>


</head>


<body class="fixed-left" onload="myFunction()">
{{--<div id="loader"></div>--}}

<div class='box-loader' id="boxLoader">
    <div class='loader'>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--text'></div>
    </div>
</div>