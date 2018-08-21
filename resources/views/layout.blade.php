<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script defer src="js/ajax.js" charset="utf-8"></script>
  <title>Bookmarks</title>
  <meta name="description" content="Bookmarks is an open access web-based tool about web technologies. It was developed at becode (coding school based in Belgium), where learners and coaches can share their resources and bookmarks."/>
  <meta property="og:image" content="../assets/img/bookmarks-img.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="../assets/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="../assets/img/favicon/safari-pinned-tab.svg" color="#2c76d6">
  <link rel="icon" href="../assets/img/favicon/favicon.ico"/>
  <meta name="msapplication-TileColor" content="#2c76d6">
  <meta name="theme-color" content="#ffffff">
</head>
<body>
  <main class="columns">
    <section class="column index nav-down" id="header">
      <h1><a href="{{ route('home') }}">Bookmarks</a></h1>
      <nav>
        @auth
        <div class="version desktop">
          <div class="tags has-addons">
            <span class="tag is-medium is-warning">{{ env('APP_VERSION') }}</span>
            <span class="tag is-medium is-dark">{{ env('APP_MAJOR') }}.{{ env('APP_MINOR') }}.{{ env('APP_BUGFIX') ?: "0" }}</span>
          </div>
          <div class="feedback">
            <a class="button desktop is-link feedback" href="https://github.com/RomainVandevoorde/Lovelace-Bookmarks/issues/new"><i class="fab fa-github"></i>Feedback</a>
          </div>
        </div>
        <a class="button desktop" href="{{ route('bookmarks.create') }}">Add</i></a>
        <a class="button desktop" href="{{ url('/profile') }}">Profile</a>
        <a class="button desktop" href="{{ url('about') }}">About</a>
        <a class="button desktop" href="{{ route('logout') }}">Log Out</a>
        <div class="menu-burger">
          <button class="lines-button lines"><span></span></button>
        </div>
        <div class="menu-mobile">
          <div class="menu-mobile-links">
            <a href="{{ route('bookmarks.create') }}">Add</i></a>
            <a href="{{ url('/profile') }}">Profile</a>
            <a href="{{ url('about') }}">About</a>
            <a href="https://github.com/RomainVandevoorde/Lovelace-Bookmarks/issues/new">Feedback</a>
            <a href="{{ route('logout') }}">Log Out</a>
          </div>
        </div>
        <!-- Dropdown categories mobile-->
        <script>
        $(document).ready(function () {
            $(document).on('click', ".lines-button", function () {
              $('.lines-button').addClass('close');
              $('.menu-mobile').toggle("drop");
              $('.indexList').css("height",'100vh');
              $(".index").css("overflow", "hidden");
              $("#header").css("top", "0px");
              $("#header").css("position", "fixed");
              $('.menu-mobile').css("height",'100vh');
            });
            $(document).on('click', ".lines-button.close", function () {
              $('.menu-mobile').hide("drop");
              $('.menu-mobile').hide();
              $('.indexList').css("height",'60px');
              $(".index").css("overflow", "hidden");
              $('.lines-button').removeClass('close');
            });
        });
        </script>
        @endauth
        @guest
        <a class="button" href="{{ url('about') }}">About</a>
        <a class="button is-info" href="{{ route('login') }}"><i class="fab fa-github"></i>Log In</a>
        @endguest
      </nav>
      <!-- This shall include the categories -->
      <div class="indexList">
        <div class="buttonIndex"></div>
        <h2 id="h2id">Categories</h2>
        <ol>
          @foreach($categories as $category)
          <li><a href="{{ url('bookmarks/category', $category->id) }}">{{ $category->title }}</a></li>
          @endforeach
        </ol>
      </div>
      <!-- Menu categories mobile -->
      <script type="text/javascript">
      $(document).ready(function(){
        $('#h2id').click(function(){
              if($(window).width() < 769){
                if($('ol').is( ":hidden" )){
                    $('ol').slideDown("slow");
                    $('.indexList').animate({height:'100vh'}, 500);
                    $('#h2id').toggleClass('changed');
                    $("#header").css("position", "fixed");
                    $("#header").css("top", "0px");
                    $(".index").css("overflow", "auto");
                }else{
                    $('ol').slideUp("slow");
                    // $('#header').animate({height:'134px'}, 500);
                    $('.indexList').animate({height:'60px'}, 500);
                    $('#h2id').removeClass('changed');
                    $(".index").css("overflow", "hidden");
                }
              }
            });
        // WIP display desktop/mobile category menu.

        //   $( window ).resize(function() {
        //     if($(window).width() > 769){
        //     $('ol').show();
        //   }else if ($(window).width() < 769){
        //     $('ol').hide();
        //   }
        // });
      });
    </script>
    </section>
    <section class="column content is-three-fifths">

      @if(Session::has('notification'))
      <div class="notification {{ Session::has('notification-class') ? Session::get('notification-class') : 'is-primary' }}">{{ Session::get('notification') }}</div>
      @endif

      @section('rightcontent')
      <div class="contentList">
        <h2 class="hello">Hey, looking for something?</h2>
        <div class="gif"><iframe id="gif"></iframe></div>
      </div>
      @show
    </section>
  </main>
  <script type="text/javascript">
  // Notification
  $( ".notification" ).delay(3200).fadeOut(300);
      $(function(){
          $(".delete").click(function(){
            $(this).parent().hide();
          });
      });
  </script>
  <!-- Random GIF Index -->
  <script>
    var description = [
      "https://giphy.com/embed/l4Ep99Cnz8D6P6lnq",
      "https://giphy.com/embed/l4FB42tbghjJmb2KI",
      "https://giphy.com/embed/j3gsT2RsH9K0w",
      "https://giphy.com/embed/13CoXDiaCcCoyk",
      "https://giphy.com/embed/8TFtMzqmrRkCJ7uGLg"
    ];
    var size = description.length
    var x = Math.floor(size*Math.random())
    document.getElementById('gif').src=description[x];
  </script>
  <!-- Menu mobile desappear scrool down -->
  <script>
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#header').outerHeight();
    $(window).scroll(function(event){
        didScroll = true;
    });
    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 10);
    function hasScrolled() {
        var st = $(this).scrollTop();
        if(Math.abs(lastScrollTop - st) <= delta)
            return;
        if (st > lastScrollTop && st > navbarHeight){
            $('#header').removeClass('nav-down').addClass('nav-up');
        } else {
            if(st + $(window).height() < $(document).height()) {
                $('#header').removeClass('nav-up').addClass('nav-down');
            }
        }
        lastScrollTop = st;
    }
  </script>
</body>
</html>
