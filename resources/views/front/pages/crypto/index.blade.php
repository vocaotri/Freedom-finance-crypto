@extends('front.layout')
@section('title')
    List crypto
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
            <h1 class="page-header">List crypto</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: 1em">
            <a href="{{ route('crypto.add') }}" class="btn btn-success">New</a>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Crypto average price
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Total transaction</th>
                                    <th>Average price USDT</th>
                                    <th>Total coin</th>
                                    <th>Total average USDT</th>
                                    <th>Total now USDT</th>
                                    <th>Current Price USDT</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="main-crypto">
                                @php
                                    $total_transaction = 0;
                                    $total_average_usdt = 0;
                                    $total_now_usdt = 0;
                                @endphp
                                @foreach ($cryptos as $crypto)
                                    <tr>
                                        <td>{{ $crypto->symbol }}</td>
                                        <td><a
                                                href="{{ route('transaction.index', $crypto->id) }}">{{ $crypto->transactions->count() }}</a>
                                        </td>
                                        <td>{{ number_format($crypto->avg_price, 2) }}</td>
                                        <td>{{ number_format($crypto->total_coin, 2) }}</td>
                                        <td>${{ number_format($crypto->total_usdt, 2) }}</td>
                                        <td>${{ number_format($crypto->total_usdt, 2) }}</td>
                                        <td>Loading</td>
                                        <td>
                                            <div style="display: flex;justify-content: space-around">
                                                <a href="{{ route('crypto.edit', $crypto->id) }}" style="min-width: 75px"
                                                    class="btn btn-info">Edit</a>
                                                <button class="btn btn-danger" style="min-width: 75px"
                                                    onclick="deleteCrypto(`{{ route('crypto.delete', $crypto->id) }}`)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $total_transaction += $crypto->transactions->count();
                                        $total_average_usdt += $crypto->total_usdt;
                                        $total_now_usdt += $crypto->total_usdt;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td><a href="javascript:;">{{ $total_transaction }}</a></td>
                                    <td></td>
                                    <td></td>
                                    <td>${{ number_format($total_average_usdt, 2) }}</td>
                                    <td id="total_usdt">${{ number_format($total_now_usdt, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
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
    <script src="{{asset('front/js/binance-ws.js')}}"></script>
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script>
        function deleteCrypto(url) {
            var isDelete = confirm('Are you sure delete this crypto?');
            if (isDelete) {
                window.location.href = url;
            }
        }
    </script>
@stop
