{{--
  Template Name: System - 404
--}}

@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())

        @include('partials.blocks.init')
    @endwhile
@endsection
