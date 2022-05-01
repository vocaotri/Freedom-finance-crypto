@extends('front.layout')
@section('title')
    About
@stop
@section('css')
    <style>
        .key-show{
            display: none;
        }
        .paste-main{
            position: relative;
        }
        .paste-main .btn-paste{
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            border: 1px solid #ccc;
            text-align: center;
            cursor: pointer;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">About</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>You don't have a private key generate now! <span
                        style="color:red;font-weight: bold;font-size: 18px" id="total_usdt_main"></span>
                </div>
                <div class="panel-body">
                    <button onclick="generateKey()">Generate now</button>
                    <textarea id="key-show" class="key-show form-control" readonly></textarea>
                    <button id="copy-key" onclick="copyKey()" style="display: none">copy</button>
                    <button id="save-key" onclick="saveKeyTXT()" style="display: none">save</button>
                    <p style="color: red; margin-top:3px">Note: The private key is only visible once, save it if you don't have the private key you cannot get your data back</p>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>You don't have database url please create it on <a href="https://cloud.mongodb.com/">mongodb</a> <span
                        style="color:red;font-weight: bold;font-size: 18px" id="total_usdt_main"></span>
                </div>
                <div class="panel-body">
                    <div class="paste-main">
                        <input type="text" id="paste-key" class="form-control" placeholder="Enter private key">
                        <button class="btn-paste" onclick="pasteKey()">Paste</button>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter database url">
                    <small style="color: red; margin-top:3px">Database url example: mongodb+srv://username:password@cluster0.r4h1o.mongodb.net/myappdb?retryWrites=true&w=majority</small><br>
                    <button>Using database url now</button>
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
    <script>
        function generateKey(){
            $.ajax({
                url: '{{ route('key.generate.key') }}',
                data:{
                    _token: '{{ csrf_token() }}'
                },
                type: 'POST',
                success: function(data) {
                    $('.key-show').text(data);
                    $('.key-show').show();
                    $('#copy-key').show();
                    $('#save-key').show();
                }
            });
        }
        function copyKey(){
            var copyText = document.getElementById("key-show");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied the text: " + copyText.value);
        }
        function pasteKey(){
            var copyText = document.getElementById("key-show");
            if(!copyText.value){
                alert('Please generate key first');
                return false;
            }
            var pasteText = document.getElementById("paste-key").value  = copyText.value;
        }
        function saveKeyTXT(){
            var copyText = document.getElementById("key-show");
            var a = document.createElement("a");
            a.href = "data:text/plain;charset=utf-8," + encodeURIComponent(copyText.value);
            a.download = "key.txt";
            a.click();
        }
    </script>
@stop
