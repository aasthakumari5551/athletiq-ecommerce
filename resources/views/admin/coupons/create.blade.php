@extends('layouts.admin')
@section('title', 'Create Coupon')
@section('content')
    @include('admin.coupons.form', [
        'coupon'  => new \App\Models\Coupon(),
        'action'  => route('admin.coupons.store'),
        'method'  => 'POST'
    ])
@endsection