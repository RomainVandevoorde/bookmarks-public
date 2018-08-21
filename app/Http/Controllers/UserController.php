<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Bookmark;

class UserController extends Controller
{
    public function profile(Request $request) {
        // return '<pre>'.print_r($request->session(), TRUE).'</pre>';
        if(!Auth::check()) return redirect(route('home'));

        $bookmarks = Bookmark::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('profile', ['user' => Auth::user(), 'bookmarks' => $bookmarks]);
    }

    public function devlogin() {
      // If not in dev environment, redirect to home
      if(getenv('APP_ENV') !== 'local') return redirect(route('home'));
      Auth::loginUsingId(1);
      return redirect(route('home'));
    }
}
