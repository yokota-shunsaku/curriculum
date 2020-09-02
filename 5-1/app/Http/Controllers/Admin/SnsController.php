<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class SnsController extends Controller
{
  public function create(Request $request)
  {
      // Varidationを行う
    $this->validate($request, Post::$rules);

    $post = new Post;
    $form = $request->all();
    $post->user_id = Auth::id();
    // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    $post->fill($form);
    
    // データベースに保存する
    $post->save();
      // sns/createにリダイレクトする
      return redirect('sns/create');
  }

  public function index(Request $request) {
        $posts = Post::orderBy('id', 'desc')->get();
        $users = User::all();
    return view('sns.create', ['posts' => $posts, 'users' => $users]);
    }

  public function delete($id)
    {
        Post::find($id)->delete(); // softDelete
 
        return redirect()->to('sns/create');
    }
}
