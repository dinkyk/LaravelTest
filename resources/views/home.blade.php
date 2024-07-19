@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Home')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Home')

{{-- Content body: main page content --}}

@section('content_body')

@stop

@section('content')
<ul>
    @foreach ($users as $user)
       <li> <x-user-list :user="$user" /> </li>
    @endforeach
</ul>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush
