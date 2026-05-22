@extends('layouts.admin')
@section('title', 'Edit Category')
@section('content')
    @include('admin.categories.form', ['category' => $category, 'action' => route('admin.categories.update', $category), 'method' => 'PUT'])
@endsection
