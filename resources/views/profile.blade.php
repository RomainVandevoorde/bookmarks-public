@extends('layout')

@section('rightcontent')

<div class="contentList">
  <h2>Your Profile</h2>
  <div class="profile">
    <p><strong>{{ $user->name }}</strong></p>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Github:</strong> {{ $user->github_html_url }}</p>
    <!-- <p>Auth level: {{ $user->auth_level }}</p> -->
  </div>
  <h2>Your bookmarks</h2>
  @if($bookmarks->count() > 0)
    @foreach($bookmarks as $bookmark)
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
  @else
  <p>You have no bookmarks</p>
  @endif
</div>

@endsection
