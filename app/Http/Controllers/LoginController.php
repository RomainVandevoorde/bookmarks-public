<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Socialite;
use App\User;

class LoginController extends Controller
{
  /**
  * Redirect the user to the GitHub authentication page.
  *
  * @return \Illuminate\Http\Response
  */
  public function redirectToProvider()
  {
    return Socialite::driver('github')
      ->scopes(['read:user'])
      ->redirect();
  }

  /**
  * Obtain the user information from GitHub.
  *
  * @return \Illuminate\Http\Response
  */
  public function handleProviderCallback()
  {
    $user_github = Socialite::driver('github')->user();
    // return '<pre>'.print_r($user_github, TRUE).'</pre>';
    // return $user->getId();

    // $user = User::where('github_id', $user_github->getId())->first();
    //
    // if($user) return $user;
    // else return "empty";


    $authUser = $this->findOrCreateUser($user_github);

    // return print_r($user, TRUE);

    Auth::login($authUser);

    if (Auth::check()) {
        return redirect(route('home'));
    }
  }

  private function findOrCreateUser($user_github) {

    $user = User::where('github_id', $user_github->getId())->first();

    if($user) return $user;

    return User::create([
      'name' => $user_github->nickname,
      'github_id' => $user_github->getId(),
      'github_html_url' => $user_github->user['html_url'],
      'github_avatar_url' => $user_github->user['avatar_url'],
      'auth_level' => 0
    ]);

  }

  public function logout() {
    Auth::logout();
    return redirect(route('home'));
  }

}
