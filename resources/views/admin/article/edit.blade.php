@extends('layouts.admin')

@section('header')
    Edit article
@endsection

@section('content')
    <div class="card card-default">
        @include('admin.components.card-header', ['header' => 'Editing form'])

        <div class="card-body">
            <article-form
                :props-article='@json($article)'
                :props-categories='@json($categories)'
                :available-tags='@json($tags)'
                update-route="{{ route('article.update', ['article' => $article->id]) }}"
                redirect-route="{{ route('article') }}"
            >
            </article-form>
        </div>
    </div>
@endsection
