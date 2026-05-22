@extends('layouts.admin')
@section('title', 'Create Product')
@section('content')
    @include('admin.products.form', ['product' => $product, 'action' => route('admin.products.store'), 'method' => 'POST'])
@endsection
