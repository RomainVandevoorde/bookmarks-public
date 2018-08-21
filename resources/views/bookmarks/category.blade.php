@extends('layout')

@section('rightcontent')

@php ($t = 0)

<div class="contentList">
    <h2>{{ $category->title }}</h2>
    @foreach($bookmarks as $bookmark)
      @if($bookmark->type->id !== $t)
        <h4>{{ $bookmark->type->name }}</h4>
        @php ($t = $bookmark->type->id)
      @endif
      <ul class="edit">
        <li class = "mark">
          <a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->title }}</a>
          <p>{{ $bookmark->description }}</p>
        </li>
        @auth
        <li class="edit">
          @if(Auth::user()->auth_level > 1 || Auth::user()->id === $bookmark->user_id)
          <a class="button" href="{{ route('bookmarks.edit', $bookmark->id) }}"><i class="fas fa-pencil-alt fa-xs"></i></a>
          @endif
          @if(Auth::user()->auth_level > 1)
          <a class="button"><i class="far fa-trash-alt fa-xs"></i></a>
          @endif
        </li>
        @endauth
      </ul>
    @endforeach
</div>

@endsection
