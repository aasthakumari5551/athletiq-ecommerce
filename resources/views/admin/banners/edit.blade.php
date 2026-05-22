@extends('layouts.admin')
@section('title', 'Edit Banner')
@section('content')
    @include('admin.banners.form', ['banner' => $banner, 'action' => route('admin.banners.update', $banner), 'method' => 'PUT'])
@endsection
