<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Bookmark;
use App\Category;
use App\User;
use App\Type;
use Validator;

class BookmarkController extends Controller
{

    public function show($bookmark) {
      $bookmark_data = Bookmark::find($bookmark);
      return view('bookmark', ['bookmark' => $bookmark_data]);
    }

    public function index() {
      $bookmarks = Bookmark::all();
      return view('bookmarks.index', compact('bookmarks'));
    }

    public function indexByCategory($category) {
      $category_data = Category::findOrFail($category);
      // $bookmarks = Bookmark::where('category_id', $category)->get();
      // $bookmarks = $category_data->bookmarks->orderBy('type')->get();
      $bookmarks = Bookmark::where('category_id', $category)->orderBy('type_id')->get();
      return view('bookmarks.category', ['bookmarks' => $bookmarks, 'category' => $category_data]);
    }

    public function indexByUser($id) {
      $user = User::findOrFail($id);
      $bookmarks = $user->bookmarks;
      return $bookmarks;
    }

    public function store(Request $request) {

      $request->validate([
        'title' => 'required|min:2|max:150',
        'url' => 'required|url',
        'description' => 'nullable|string|max:255',
        'category' => 'required|exists:categories,id',
        'type' => 'required|exists:types,id'
      ]);

      $bookmark = new Bookmark;

      $bookmark->title = $request->input('title');
      $bookmark->url = $request->input('url');
      $bookmark->description = (empty($request->input('description')) || is_null($request->input('description'))) ? '' : $request->input('description');
      $bookmark->user_id = Auth::user()->id;
      $bookmark->category_id = $request->input('category');
      $bookmark->type_id = $request->input('type');

      $bookmark->save();
        Session::flash('notification-class', 'is-success');
        Session::flash('notification', 'Bookmark added !');

      return redirect(url('bookmarks', $bookmark->id));

    }

    public function create() {

      if(!Auth::check() || !Auth::user()->can('create', Bookmark::class)) {
        Session::flash('notification-class', 'is-danger');
        Session::flash('notification', 'Insufficient rights');
        return redirect(route('home'));
      }

      $types = Type::all();

      return view('forms.bookmark.add', compact('types'));
    }

    // Shows edit form after checking for permission
    public function edit(Request $request, $bookmark) {

      $bookmark_data = Bookmark::find($bookmark);

      if(!Auth::check() || !Auth::user()->can('update', $bookmark_data)) return redirect(route('home'));

      $types = Type::all();

      return view('forms.bookmark.edit', ['bookmark' => $bookmark_data, 'types' => $types]);
    }

    // Updates a bookmark entry
    public function update(Request $request, $id) {
      $data = $request->all();
      $data['id'] = $id;

      Validator::make($data, [
        'id' => 'integer|exists:bookmarks',
        'title' => 'required|string|min:2|max:150',
        'url' => 'required|url',
        'description' => 'nullable|string|max:255',
        'category' => 'required|integer|exists:categories,id',
        'type' => 'required|integer|exists:types,id'
      ])->validate();

      $bookmark = Bookmark::find($id);

      $bookmark->title = $request->input('title');
      $bookmark->url = $request->input('url');
      $bookmark->description = (empty($request->input('description')) || is_null($request->input('description'))) ? '' : $request->input('description');
      $bookmark->category_id = $request->input('category');
      $bookmark->type_id = $request->input('type');

      $bookmark->save();
        Session::flash('notification-class', 'is-success');
        Session::flash('notification', 'Bookmark updated !');

      return redirect(url('bookmarks', $id));
    }
}
