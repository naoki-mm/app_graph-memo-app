<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function graphs()
    {
        return $this->hasMany('App\Graph');
    }

    /**
     * ログインユーザーのタグを全権取得する。
     *
     * @return array $all_tags
     */
    public function getAllTagsAttribute(): array {
        $user_id = Auth::id();

        $users = self::with('graphs.tags')->get();
        $user_graphs = $users->find($user_id)->graphs;

        $all_tags = [];
        // グラフのタグを取得して、タグ名の重複を削除した配列に変換
        foreach($user_graphs as $user_graph) {
            $user_graph_tags = $user_graph->tags;
            foreach($user_graph_tags as $user_graph_tag) {
                if(!in_array($user_graph_tag->name, array_column($all_tags, 'text'), true)) {
                    array_push($all_tags, ['text' => $user_graph_tag->name]);
                }
            }
        }
        return  $all_tags;
    }
}
