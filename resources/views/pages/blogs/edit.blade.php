@extends('layouts.admin')

@section('page-content')
    <blogs-form :_blog="{{ $blog->toJson() }}"></blogs-form>
@endsection