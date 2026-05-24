@extends('layouts.admin')
@section('title', 'Edit Coupon')
@section('content')
    @include('admin.coupons.form', [
        'coupon'  => $coupon,
        'action'  => route('admin.coupons.update', $coupon),
        'method'  => 'PUT'
    ])
@endsection