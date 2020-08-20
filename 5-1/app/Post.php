<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes; // SoftDeletesトレイトを使用します

    protected $guarded = array('id');
  // 以下を追記
  public static $rules = array(
      'body' => 'required',
      'user_id' => 'integer',
  );

  public function user()
{
    return $this->belongsTo('App\User');
}
}
