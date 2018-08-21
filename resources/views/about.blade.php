@extends('layout')

@section('rightcontent')

<div class="contentList">
  <h2>About</h2>
  <p>Bookmarks is an open access web-based tool about web technologies. It was developed at <a href="https://www.becode.org/" target="_blank">becode</a> (coding school based in Belgium), where learners and coaches can share their resources and bookmarks.</p>
  <p class="feedback">Did you encounter any problem while navigating? Please send your observations and help us improve the Lovelace 2.0 using this <a href="https://github.com/RomainVandevoorde/Lovelace-Bookmarks/issues" target="_blank">link</a> (GitHub issues).</p>
  <h5>Team</h5>
  <ul class="credits">
    <li>Back-End: <a href="https://github.com/RomainVandevoorde/" target="_blank">Romain Vandevoorde</a></li>
    <li>Design & UX: <a href="https://github.com/pedroseromenho" target="_blank">Pedro Seromenho</a></li>
    <li>AJAX: <a href="https://github.com/tahrimostapha/" target="_blank">Mostapha Tahri</a></li>
  </ul>
  <h5>Technologies</h5>
  <p>Stack: Apache 2, PHP 7, MySQL 5.6</p>
  <ul class="credits">
    <li><a href="https://laravel.com/" target="_blank">Laravel 5.5</a> : Framework PHP</li>
    <li><a href="https://laravel.com/docs/5.5/socialite" target="_blank">Laravel Socialite</a> : Social Connection package</li>
    <li><a href="https://getcomposer.org/" target="_blank">Composer</a> : Dependencies Manager</li>
    <li><a href="https://bulma.io/" target="_blank">Bulma</a> : Framework CSS</li>
    <li><a href="https://fontawesome.com/" target="_blank">FontAwesome</a> : Icons</li>
  </ul>
</div>

@endsection
