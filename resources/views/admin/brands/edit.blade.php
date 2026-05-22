@extends('layouts.admin')
@section('title', 'Edit Brand')
@section('content')
    @include('admin.brands.form', ['brand' => $brand, 'action' => route('admin.brands.update', $brand), 'method' => 'PUT'])
@endsection
