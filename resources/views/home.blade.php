@extends('layouts.default')

@section('vendor-style')
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}"  />
  <link href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}"  />
  <link href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}"   />
  <link href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}"   />
  <link href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}"   />
  <link href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}"   />
   
  
    <style>
        .table {
            font-size: 12px;
        }

        .table tbody td {
            font-size: 12px;
        }

        #sinSalida thead th {
            font-size: 12px;
        }

        #sinSalida_filter input {
            font-size: 12px;
        }

        #sinSalida_paginate .paginate_button {
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
<div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Bienvenid@</h5>
        </div>
        <div class="card-body text-center">
           <h4 class="mt-5">Bienvenid@ {{ Auth::user()->name }} al sistema {{ config('app.name', 'Laravel') }}</h4> 
        </div>
    </div>
@endsection
 
