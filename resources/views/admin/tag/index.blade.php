@extends('layouts.admin')

@section('header')
    Tags list
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('tag.create') }}">Add tag</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <admin-tags-list
                :props-tags='@json($tags)'
                edit-route="{{ route('tag.edit', ['tag' => 'TAG']) }}"
                delete-route="{{ route('tag.delete', ['tag' => 'TAG']) }}"
            >
            </admin-tags-list>
        </div>

        <div class="card-footer">
            {!! $tags->links() !!}
        </div>
    </div>
@endsection
