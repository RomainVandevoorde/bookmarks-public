@extends('layout')

@section('rightcontent')

<div class="contentList">
  <h2>{{ $bookmark->title }}</h2>
  <p>URL: <a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->url }}</a></p>
  <p>{{ $bookmark->description }}</p>
  <p>Added by: {{ $bookmark->user->name }}</p>
  <p>Catégorie: {{ $bookmark->category->title }}</p>
  <p>Type: {{ $bookmark->type->name }}</p>
  @auth
  @if(Auth::user()->auth_level > 1 || Auth::user()->id === $bookmark->user_id)
  <a class="button is-large" href="{{ route('bookmarks.edit', $bookmark->id) }}"><i class="fas fa-pencil-alt fa-xs"></i></a>
  @endif
  @endauth
</div>

@endsection
