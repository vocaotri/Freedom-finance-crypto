@extends('front.layout')
@section('title')
    New crypto
@stop
@section('css')
    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="{{ asset('front/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/plugins/timeline/timeline.css') }}" rel="stylesheet">
@stop
@section('content')
    {{-- @dd($cryptos) --}}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New crypto</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Fill in the form
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">
                    <form role="form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" placeholder="Symbol" name="symbol" autofocus required>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button class="btn btn-lg btn-success btn-block">Create</button>
                    </form>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@stop
@section('js')
    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="{{ asset('front/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/morris/morris.js') }}"></script>
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script>
        $(document).ready(function() {
            console.log('ok');
        });
    </script>
@stop
