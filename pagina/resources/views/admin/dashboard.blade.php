@extends('admin.layout')
@section('title', 'Dashboard')

@section('admin-content')
<script>window.STATS_URL = "{{ route('admin.stats') }}";</script>
<div id="admin-app"></div>
@vite(['resources/js/admin.js'])
@endsection
