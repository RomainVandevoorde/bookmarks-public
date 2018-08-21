@extends('layout')

@section('rightcontent')

<div class="contentList">
<h2>Edit</h2>
<!-- @if($errors->any())
<article class="message is-danger">
  <div class="message-body"><p>Please correctly fill the form</p></div>
</article>
@endif -->
@if($errors->has('id'))
<p class="help is-danger">{{ $errors->first('id') }}</p>
@endif
<form class="add" action="{{ route('bookmarks.update', $bookmark->id) }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
    <div class="control-container">
        <div class="control">
         <label class="label">Topic</label>
        <div class="select{{ $errors->has('category') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('category')) ? ' is-success' : '' }}">
            <select name="category">
              @foreach($categories as $category)
              <option value="{{ $category->id }}"{{ old('category', $bookmark->category_id) == $category->id ? ' selected="selected"' : '' }}>{{ $category->title }}</option>
              @endforeach
            </select>
        </div>
        </div>
        @if($errors->has('category'))
          <p class="help is-danger">{{ $errors->first('category') }}</p>
        @endif
    </div>
      <div class="control-container">
          <div class="control">
           <label class="label">Type</label>
          <div class="select{{ $errors->has('type') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('type')) ? ' is-success' : '' }}">
              <select name="type">
                @foreach($types as $type)
                <option value="{{ $type->id }}"{{ old('type', $bookmark->type_id) == $type->id ? ' selected="selected"' : '' }}>{{ $type->name }}</option>
                @endforeach
              </select>
          </div>
          </div>
          @if($errors->has('type'))
            <p class="help is-danger">{{ $errors->first('type') }}</p>
          @endif
      </div>
    <div class="field-container">
        <div class="field">
        <label class="label">Title</label>
            <div class="control">
                <input class="input{{ $errors->has('title') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('title')) ? ' is-success' : '' }}" type="text" value="{{ old('title', $bookmark->title) }}" name="title">
            </div>
            @if($errors->has('title'))
              <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>
        <div class="field">
        <label class="label">Link</label>
            <div class="control">
                <input class="input{{ $errors->has('url') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('url')) ? ' is-success' : '' }}" type="text" value="{{ old('url', $bookmark->url) }}" name="url">
            </div>
            @if($errors->has('url'))
              <p class="help is-danger">{{ $errors->first('url') }}</p>
            @endif
        </div>
        <div class="field">
        <label class="label">About</label>
            <div class="control">
                <textarea class="textarea{{ $errors->has('description') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('description')) ? ' is-success' : '' }}" name="description">{{ old('description', $bookmark->description) }}</textarea>
            </div>
            @if($errors->has('description'))
              <p class="help is-danger">{{ $errors->first('description') }}</p>
            @endif
        </div>
    </div>
    <div class="buttons-container">
        <div class="control">
            <button class="button is-primary" role="submit">Submit</button>
        </div>
        <div class="control">
            <button class="button"><a href="profile.php">Cancel</a></button>
        </div>
    </div>
  </form>
  </div>

  <!-- @if($errors->any())
  <p>erreur</p>
  <pre>
    @php
    print_r($errors);
    @endphp
  </pre>
  @endif

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif -->

@endsection
