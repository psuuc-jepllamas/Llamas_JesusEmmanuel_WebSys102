@extends('model')

@section('documenttitle')
Order
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 22rem; background: #274b69;">
        <div class="card-body">
            <h3 class="card-title text-center mb-3 text-light">Order</h3>
            
            <div class="mb-3">
                <label for="custid" class="form-label text-light">Customer ID</label>
                <input type="text" class="form-control" id="custid" value="{{ $custid }}" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label text-light">Name</label>
                <input type="text" class="form-control" id="name" value="{{ $name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label text-light">Order No</label>
                <input type="text" class="form-control" id="address" value="{{ $orderno }}" readonly>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label text-light">Date</label>
                <input type="text" class="form-control" id="address" value="{{ $date }}" readonly>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection