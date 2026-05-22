@extends('layouts.admin')
@section('title', 'Create Banner')
@section('content')
    @include('admin.banners.form', ['banner' => new App\Models\Banner(['is_active' => true, 'sort_order' => 0]), 'action' => route('admin.banners.store'), 'method' => 'POST'])
@endsection
