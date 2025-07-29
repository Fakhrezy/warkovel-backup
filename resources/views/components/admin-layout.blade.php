@extends('layouts.admin')

@section('header')
    {{ $header ?? 'Admin Dashboard' }}
@endsection

@section('content')
    {{ $slot }}
@endsection
