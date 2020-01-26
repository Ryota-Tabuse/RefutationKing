@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <h1>議論テーマ一覧</h1>
        </div>
        <div class="links">
            @foreach ($themes as $thema)
            <button type="button" class="btn btn-default btn-lg"
                href="{{ route('tasks.index', ['id' => $folder->id]) }}">{{$thema->name}}</button>
            </br>
            @endforeach
        </div>
    </div>
</div>
@endsection