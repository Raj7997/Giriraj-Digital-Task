<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{$pageTitle}}</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <!-- Jquery UI -->
        <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
        <!-- Toastr -->
        <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    </head>
    <style>
        .errmsg{
            color: red;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <body>
    



    