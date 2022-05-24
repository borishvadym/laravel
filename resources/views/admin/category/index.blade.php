@extends('layouts.admin')

@section('header')
    Categories list
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('category.create') }}">Add category</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <admin-categories-list
                :page-data='@json($categories)'
                sorting-update-route="{{ route('category.sorting.update') }}"
                edit-route="{{ route('category.edit', ['category' => 'CATEGORY']) }}"
                delete-route="{{ route('category.delete', ['category' => 'CATEGORY']) }}"
            >
            </admin-categories-list>
        </div>
    </div>
@endsection
