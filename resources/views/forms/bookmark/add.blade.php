@extends('layout')

@section('rightcontent')
<div class="contentList">
  <h2>Add</h2>
  <form class="add" action="{{ route('bookmarks.store') }}" method="post" name="form1" onsubmit="required()">
    {{ csrf_field() }}
    <div class="control-container">
      <div class="control">
        <label class="label">Topic</label>
        @if($errors->has('category'))
          <p class="help is-danger">{{ $errors->first('category') }}</p>
        @endif
        <div class="select{{ $errors->has('category') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('category')) ? ' is-success' : '' }}">
          <select name="category">
            <option value="0">Choose</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}"{{ old('category') == $category->id ? ' selected="selected"' : '' }}>{{ $category->title }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="control">
        <label class="label">Type</label>
        @if($errors->has('type'))
          <p class="help is-danger">{{ $errors->first('type') }}</p>
        @endif
        <div class="select{{ $errors->has('type') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('type')) ? ' is-success' : '' }}">
          <select name="type">
            <option value="0">Choose</option>
            @foreach($types as $type)
            <option value="{{ $type->id }}"{{ old('type') == $type->id ? ' selected="selected"' : '' }}>{{ $type->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="field-container">
      <div class="field">
        <label class="label">Name</label>
        <div class="control">
          <input class="input{{ $errors->has('title') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('title')) ? ' is-success' : '' }}" type="text" placeholder="ex: Bulma Framework" name="title" value="{{ old('title') }}">
        </div>
        @if($errors->has('title'))
          <p class="help is-danger">{{ $errors->first('title') }}</p>
        @endif
      </div>
      <div class="field">
        <label class="label">Link</label>
        <div class="control">
          <input class="input{{ $errors->has('url') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('url')) ? ' is-success' : '' }}" type="text" placeholder="ex: https://bulma.io/" name="url" value="{{ old('url') }}">
        </div>
        @if($errors->has('url'))
          <p class="help is-danger">{{ $errors->first('url') }}</p>
        @endif
      </div>
      <div class="field">
        <label class="label">About</label>
        <div class="control">
          <textarea class="textarea{{ $errors->has('description') ? ' is-danger' : '' }}{{ ($errors->any() && !$errors->has('description')) ? ' is-success' : '' }}" name="description" placeholder="Link description">{{ old('description') }}</textarea>
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
        <button class="button"><a href="index.html">Cancel</a></button>
      </div>
    </div>
  </form>
</div>
<script>
  function required()
    {
    var a = document.forms["form1"]["title"];
    var b = document.forms["form1"]["url"];
    var c = document.forms["form1"]["category"];
    var c1 = document.getElementsByClassName("select");
    if (a.value == "")
    {
      a.className = 'input is-danger';
    return false;
    }
    else if(b.value == "" || b.value == null){
      b.className = 'input is-danger';
      return false;
    }
    else if(c.value == 0){
      c1.className = 'select is-danger';
      return false;
    }
    else
    {
      a.className = 'input is-success';
      b.className = 'input is-success';
      c1.className = 'select is-success';
      // empt.classList.add("is-success");
    return true;
    }
  }
</script>
@endsection
