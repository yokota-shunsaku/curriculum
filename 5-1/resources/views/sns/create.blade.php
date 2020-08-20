@extends('layouts.app')
@section('body', 'snsの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ホーム</h2>

                <form action="{{ action('Admin\SnsController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="body" placeholder="いまどうしてる？" value="{{ old('body') }}">
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" class="create-btn" value="つぶやく">
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ str_limit($post->created_at, 100) }}</td>
                                <td>{{ str_limit($post->body, 100) }}</td>
                                <td>
                                @auth
                                    @if( ( $post->user_id ) === ( Auth::user()->id ) )
                                    <div>
                                        <a href="{{ action('Admin\SnsController@delete', ['id' => $post->id]) }}">削除</a>
                                    </div>
                                </td>
                                @endif
                                @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection