@extends('layouts.admin')

@section('header')
    All articles
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('article.create') }}">Add article</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <admin-article-list
                :props-articles='@json($articles)'
                edit-route="{{ route('article.edit', ['article' => 'ARTICLE']) }}"
                delete-route="{{ route('article.delete', ['article' => 'ARTICLE']) }}"
            >
            </admin-article-list>
        </div>

        <div class="card-footer">
            {!! $links !!}
        </div>
    </div>
@endsection
