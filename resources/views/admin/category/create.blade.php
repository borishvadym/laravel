@extends('layouts.admin')

@section('header')
    Create category
@endsection

@section('content')
    <div class="card card-default">
        @include('admin.components.card-header', ['header' => 'Creating form'])

        <div class="card-body">
            <category-form
                :root-categories='@json($categories)'
                store-route="{{ route('category.store') }}"
                redirect-route="{{ route('category') }}"
            >
            </category-form>
        </div>
    </div>
@endsection
