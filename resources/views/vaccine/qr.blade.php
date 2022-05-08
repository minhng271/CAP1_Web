@extends('layouts.vaccine')

@section('content')
  <div class="content">
    <div class="card">
      <div class="card-header">
        <h3>DEMO QR CODE</h3>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div class="w-50" id="reader"></div>
        <input type="hidden" id="result" value="">      
      </div>
    </div>  
  </div>
@endsection
