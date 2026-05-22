@extends('layouts.admin')
@section('title', 'Create Brand')
@section('content')
    @include('admin.brands.form', ['brand' => new App\Models\Brand(['is_active' => true]), 'action' => route('admin.brands.store'), 'method' => 'POST'])
@endsection
