@extends('layouts.admin')

@section('header')
    Edit tag
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-body">
            <tag-form
                :props-tag='@json($tag)'
                update-route="{{ route('tag.update', ['tag' => $tag->id]) }}"
                redirect-route="{{ route('tag') }}"
            >
            </tag-form>
        </div>
    </div>
@endsection
