@extends('layout_app')

@section('content')
    <div class="col-12 category">
        <div class="row">
            <span class="category_field-name">Title</span>
            <span>{{ $category->title }}</span>
        </div>
        @if($category->parent)
            <div class="row">
                <span class="category_field-name">Parent</span>
                <span><a href="{{ route('category.view', $category->parent->alias) }}">{{ $category->parent->title }}</a></span>
            </div>
        @endif
    </div>
    <products-list :products='@json($category->products)'></products-list>
@endsection
