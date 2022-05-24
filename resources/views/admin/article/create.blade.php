@extends('layouts.admin')

@section('header')
    Create article
@endsection

@section('content')
    <div class="card card-default">
        @include('admin.components.card-header', ['header' => 'Creating form'])

        <div class="card-body">
            <article-form
                :props-categories='@json($categories)'
                :available-tags='@json($tags)'
                store-route="{{ route('article.store') }}"
                redirect-route="{{ route('article') }}"
            >
            </article-form>
        </div>
    </div>
@endsection
