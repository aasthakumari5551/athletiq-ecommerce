@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
    @include('admin.products.form', ['product' => $product, 'action' => route('admin.products.update', $product), 'method' => 'PUT'])
@endsection
