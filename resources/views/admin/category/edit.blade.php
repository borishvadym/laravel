@extends('layouts.admin')

@section('header')
    Edit category
@endsection

@section('content')
    <div class="card card-default">
        @include('admin.components.card-header', ['header' => 'Editing form'])

        <div class="card-body">
            <category-form
                :root-categories='@json($categories)'
                :props-category='@json($category)'
                update-route="{{ route('category.update', ['category' => $category->id]) }}"
                redirect-route="{{ route('category') }}"
            >
            </category-form>
        </div>
    </div>
@endsection
