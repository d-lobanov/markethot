@extends('layout_app')

@section('content')
    <homepage :best-selling='@json($products)'></homepage>
@endsection
