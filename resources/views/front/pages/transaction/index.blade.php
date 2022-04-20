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
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List transaction</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: 1em">
            <a href="{{ route('transaction.add') }}" class="btn btn-success">New</a>
            <select id="filterByCrypto" class="form-control" style="width: 20%;display: inline;">
                <option value="">Filter by crypto</option>
                @foreach ($cryptos as $crypto)
                    <option value="{{ $crypto->id }}" {{ $crypto->id === $cryptoID ? 'selected' : '' }}>
                        {{ $crypto->symbol }}</option>
                @endforeach
            </select>
            <a href="{{ route('transaction.index') }}">Reset filter</a>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Transactions
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Buy/Sell</th>
                                    <th>Price USDT</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->crypto?->symbol }}</td>
                                        <td>{{ $transaction->market->value }}</td>
                                        <td>${{ number_format($transaction->price, 2) }}</td>
                                        <td>{{ number_format($transaction->amount, 2) }}</td>
                                        <td>
                                            <div style="display: flex;justify-content: center">
                                                <a style="display: none" href="{{ route('transaction.edit', $transaction->id) }}"
                                                    style="min-width: 75px" class="btn btn-info">Edit</a>
                                                <button class="btn btn-danger" style="min-width: 75px"
                                                    onclick="deleteTransaction(`{{ route('transaction.delete', $transaction->id) }}`)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
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
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script>
        function deleteTransaction(url) {
            var isDelete = confirm('Are you sure to delete this transaction?');
            if (isDelete) {
                window.location.href = url;
            }
        }
        $(document).ready(function() {
            $('#filterByCrypto').change(function() {
                var url = '{{ route('transaction.index') }}';
                var crypto_id = $(this).val();
                if (crypto_id) {
                    url += '/' + crypto_id;
                }
                window.location.href = url;
            });
        });
    </script>
@stop
