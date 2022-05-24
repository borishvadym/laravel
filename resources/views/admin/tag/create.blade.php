@extends('layouts.admin')

@section('header')
    Create tag
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-body">
            <tag-form
                store-route="{{ route('tag.store') }}"
                redirect-route="{{ route('tag') }}"
            >
            </tag-form>
        </div>
    </div>
@endsection
