@extends('layouts.admin')
@section('title', 'Create Category')
@section('content')
    @include('admin.categories.form', ['category' => new App\Models\Category(), 'action' => route('admin.categories.store'), 'method' => 'POST'])
@endsection
