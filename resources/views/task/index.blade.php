@extends('layouts.app')

@section('content')
    <nav-component></nav-component>
    <div class="flex justify-center mt-15">
        <router-view/>
    </div>
@endsection
