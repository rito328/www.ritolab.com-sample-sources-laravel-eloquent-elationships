<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Phone;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Role;
use App\Models\Feed;
use Illuminate\Support\Arr;

class SampleController extends Controller
{
    public function index()
    {
        /*
         * hasOne
         */
        $data = [];
        $members = Member::all();

        foreach ($members as $member) {
            $data[] = [
                // membersテーブル - nameカラム
                'name'  => $member->name,
                // phonesテーブル - numberカラム
                'phone' => $member->phone->number
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [name] => Michael Ritchie
        //            [phone] => 09000000001
        //        )
        //
        //    [1] => Array
        //        (
        //            [name] => Miss Caroline Howell
        //            [phone] => 09000000002
        //        )
        //
        //    [2] => Array
        //        (
        //            [name] => Verna Jacobi
        //            [phone] => 09000000003
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * hasOne - belongsTo
         */
        $data = [];
        $phones = Phone::all();
        foreach ($phones as $phone) {
            $data[] = [
                // phonesテーブル - numberカラム
                'phone'  => $phone->number,
                // membersテーブル - nameカラム
                'name' => $phone->member->name
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [phone] => 09000000001
        //            [name] => Michael Ritchie
        //        )
        //
        //    [1] => Array
        //        (
        //            [phone] => 09000000002
        //            [name] => Miss Caroline Howell
        //        )
        //
        //    [2] => Array
        //        (
        //            [phone] => 09000000003
        //            [name] => Verna Jacobi
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * hasMany
         */
        $members = Member::all();
        $data = [];
        foreach ($members as $member) {
            $data[] = [
                // membersテーブル - nameカラム
                'name'     => $member->name,
                // commentsテーブル - id/comment/created_atカラムの配列
                'comments' => $member->comments()->select('id', 'comment', 'created_at')->get()->toArray()
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [name] => Michael Ritchie
        //            [comments] => Array
        //                (
        //                    [0] => Array
        //                        (
        //                            [id] => 4
        //                            [comment] => Rerum distinctio amet in et.
        //                            [created_at] => 2019-08-15 12:47:58
        //                        )
        //
        //                    [1] => Array
        //                        (
        //                            [id] => 12
        //                            [comment] => Molestias aut ipsum est recusandae.
        //                            [created_at] => 2019-08-15 12:47:58
        //                        )
        //
        //                    [2] => Array
        //                        (
        //                            [id] => 37
        //                            [comment] => Voluptatem consectetur id quisquam maiores.
        //                            [created_at] => 2019-08-15 12:47:58
        //                        )
        //                    .
        //                    .
        //                    .
        //                    .


        /*
         * hasMany - belongsTo
         */
        $comments = Comment::all();
        $data = [];
        foreach ($comments as $comment) {
            $data[] = [
                // commentsテーブル - comment
                'comment' => $comment->comment,
                // membersテーブル - name
                'name'    => $comment->member->name
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [comment] => Itaque perferendis quia qui corrupti voluptatem facilis repudiandae quas.
        //            [name] => Verna Jacobi
        //        )
        //
        //    [1] => Array
        //        (
        //            [comment] => Deleniti qui sequi illum maxime sunt et.
        //            [name] => Bianka Ferry
        //        )
        //
        //    [2] => Array
        //        (
        //            [comment] => Sint alias mollitia dolores porro id nihil distinctio.
        //            [name] => Bianka Ferry
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * belongsToMany
         */
        $posts = Post::all();
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                // postsテーブル
                'id' => $post->id,
                'post' => $post->post,
                // tagsテーブル（タグ名のみを抽出）
                'tags' => Arr::pluck($post->tags()->select('tag')->get()->toArray(), 'tag')
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [post] => post 01
        //            [tags] => Array
        //                (
        //                    [0] => dolores
        //                    [1] => incidunt
        //                )
        //        )
        //
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [post] => post 02
        //            [tags] => Array
        //                (
        //                    [0] => in
        //                    [1] => ullam
        //                    [2] => ut
        //                    [3] => consequatur
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * belongsToMany
         */
        $tags = Tag::all();
        $data = [];
        foreach ($tags as $tag) {
            $data[] = [
                // tagsテーブル
                'id' => $tag->id,
                'tag' => $tag->tag,
                // postsテーブル（postのみ抽出）
                'post' => $tag->post()->select('post')->first()->post
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [tag] => dolores
        //            [post] => post 01
        //        )
        //
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [tag] => ut
        //            [post] => post 02
        //        )
        //
        //    [2] => Array
        //        (
        //            [id] => 3
        //            [tag] => voluptatem
        //            [post] => post 03
        //        )
        //     .
        //     .
        //     .
        //     .


        /**
         * belongsToMany - pivot
         */
        $post = Post::find(1);
        $data['post'] = $post->post;
        foreach ($post->tags as $t) {
            $data['tag'] = $t->tag;
            $data['pivot'] = [
                'id' => $t->cng_name->id,
                // 'created_at' => $t->pivot->created_at->format('Y-m-d H:i:s'),
                'created_at' => $t->cng_name->created_at->format('Y-m-d H:i:s'),
                // 'updated_at' => $t->pivot->updated_at->format('Y-m-d H:i:s')
                'updated_at' => $t->cng_name->updated_at->format('Y-m-d H:i:s')
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [post] => post 01
        //    [tag] => fuga
        //    [pivot] => Array
        //        (
        //            [created_at] => 2019-08-16 07:16:18
        //            [updated_at] => 2019-08-16 07:16:18
        //        )
        //
        //)


        /**
         * belongsToMany - wherePivot
         */
        $posts = Post::all();
        $i = 0;
        foreach ($posts as $post) {
            $data[$i]['post'] = $post->post;
            if (!empty($post->tags)) {
                foreach ($post->tags as $tag) {
                    $data[$i]['tag'] = $tag->tag;
                    $data[$i]['pivot'] = [
                        'created_at' => $tag->pivot->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $tag->pivot->updated_at->format('Y-m-d H:i:s')
                    ];
                }
            }
            $i++;
        }


        /*
         * hasManyThrough
         */
        $members = Member::all();
        $data = [];
        foreach ($members as $member) {
            $data[] = [
                // membersテーブル
                'name' => $member->name,
                // rolesテーブル
                'role' => $member->role->name,
                // postsテーブル
                'posts' => array_map(function($post) {
                    return $post['post'];
                }, $member->posts->toArray())
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [name] => Merle Labadie
        //            [role] => Role03
        //            [posts] => Array
        //                (
        //                    [0] => post 01
        //                    [1] => post 11
        //                )
        //
        //        )
        //
        //    [1] => Array
        //        (
        //            [name] => Cullen Fisher
        //            [role] => Role01
        //            [posts] => Array
        //                (
        //                    [0] => post 02
        //                    [1] => post 12
        //                )
        //
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * hasManyThrough - 別方向からのリレーション
         */
        $data = [];
        $roles = Role::all();
        foreach ($roles as $role) {
            $data[] = [
                'role' => $role->name,
                'posts' => array_map(function ($post) {
                    return $post['post'];
                }, $role->posts->toArray())
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [role] => Role01
        //            [posts] => Array
        //                (
        //                    [0] => post 02
        //                    [1] => post 12
        //                    [2] => post 07
        //                    [3] => post 17
        //                    [4] => post 10
        //                    [5] => post 20
        //                )
        //
        //        )
        //
        //    [1] => Array
        //        (
        //            [role] => Role02
        //            [posts] => Array
        //                (
        //                )
        //
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * morphMany - ポリモーフィック
         * post comment
         */
        $posts = Post::all();
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                // postsテーブル
                'id' => $post->id,
                'post' => $post->post,
                // commentsテーブル
                'comments' => array_map(function ($comment) {
                    return $comment['comment'];
                }, $post->comments->toArray())
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [post] => post 01
        //            [comments] => Array
        //                (
        //                    [0] => Post Comment 013
        //                    [1] => Post Comment 024
        //                    [2] => Post Comment 053
        //                    [3] => Post Comment 066
        //                    [4] => Post Comment 094
        //                )
        //        )
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [post] => post 02
        //            [comments] => Array
        //                (
        //                    [0] => Post Comment 015
        //                    [1] => Post Comment 021
        //                    [2] => Post Comment 030
        //                    [3] => Post Comment 093
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * morphMany - ポリモーフィック
         * feed comment
         */
        $feeds = Feed::all();
        $data = [];
        foreach ($feeds as $feed) {
            $data[] = [
                // postsテーブル
                'id' => $feed->id,
                'feed' => $feed->body,
                // commentsテーブル
                'comments' => array_map(function ($comment) {
                    return $comment['comment'];
                }, $feed->comments->toArray())
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [feed] =>
        //            [comments] => Array
        //                (
        //                    [0] => Feed Comment 028
        //                    [1] => Feed Comment 086
        //                    [2] => Feed Comment 089
        //                )
        //        )
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [feed] =>
        //            [comments] => Array
        //                (
        //                    [0] => Feed Comment 005
        //                    [1] => Feed Comment 008
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * morphToMany - 多対多ポリモーフィック
         * post tag
         */
        $posts = Post::all();
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                // postsテーブル
                'id' => $post->id,
                'post' => $post->post,
                // tagsテーブル
                'tags' => array_map(function ($tag) {
                    return $tag['tag'];
                }, $post->tags->toArray())
            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [post] => post 01
        //            [tags] => Array
        //                (
        //                    [0] => tag 01
        //                    [1] => tag 07
        //                    [2] => tag 03
        //                    [3] => tag 02
        //                )
        //        )
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [post] => post 02
        //            [tags] => Array
        //                (
        //                    [0] => tag 05
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .


        /*
         * morphToMany - 多対多ポリモーフィック
         * feed tag
         */
        $tags = Tag::all();
        $data = [];
        foreach ($tags as $tag) {
            $data[] = [
                'tag' => $tag->tag,
                'posts' => array_map(function ($post) {
                    return $post['post'];
                }, $tag->posts->toArray()),
                'feeds' => array_map(function ($feed) {
                    return $feed['body'];
                }, $tag->feeds->toArray())

            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [tag] => tag 01
        //            [posts] => Array
        //                (
        //                    [0] => post 01
        //                    [1] => post 19
        //                )
        //            [feeds] => Array
        //                (
        //                    [0] => Et itaque totam non laudantium.
        //                    [1] => Aperiam nobis incidunt commodi minus.
        //                    [2] => Et itaque totam non laudantium.
        //                    [3] => Suscipit omnis et aut et reprehenderit.
        //                    [4] => Iure voluptatem et explicabo deserunt eligendi.
        //                )
        //        )
        //    [1] => Array
        //        (
        //            [tag] => tag 02
        //            [posts] => Array
        //                (
        //                    [0] => post 05
        //                    [1] => post 09
        //                    [2] => post 01
        //                )
        //            [feeds] => Array
        //                (
        //                    [0] => Est saepe tenetur sunt inventore.
        //                    [1] => Officia ut corrupti accusamus.
        //                    [2] => Est molestias quidem assumenda est.
        //                    [3] => Quae ut debitis distinctio et ipsum culpa.
        //                    [4] => Laborum quis voluptate et sed aut ipsa.
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .


        // 記事を持つメンバーのみを取得する
        $members = Member::has('posts')->get();


        // 記事を３件以上持つメンバーのみを取得する
        $members = Member::has('posts', '>=', 3)->get();


        // 文字列「hoge」を含む記事を持つメンバーを取得する
        $members = Member::whereHas('posts', function ($query) {
            $query->where('post', 'like', '%hoge%');
        })->get();


        // 記事を持たないメンバーを取得する
        $members = Member::doesntHave('posts')->get();


        // 文字列「hoge」を含む記事を持たないメンバーを取得する
        $members = Member::whereDoesntHave('posts', function ($query) {
            $query->where('post', 'like', '%hoge%');
        })->get();



        // 記事の件数も取得する
        $members = Member::withCount('posts')->get();

        $data = [];
        foreach ($members as $member) {
            $data[] = [
                'id' => $member->id,
                'count' => $member->posts_count, // 件数へアクセス
                'post' => array_map(function ($post) {
                    return $post['post'];
                }, $member->posts->toArray())

            ];
        }

        // print_r($data);
        // => Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [count] => 6
        //            [post] => Array
        //                (
        //                    [0] => post 15 buzz
        //                    [1] => post 19 fizz
        //                    [2] => post 20 hoge
        //                    [3] => post 23 fizz
        //                    [4] => post 24 buzz
        //                    [5] => post 26 buzz
        //                )
        //        )
        //    [1] => Array
        //        (
        //            [id] => 2
        //            [count] => 7
        //            [post] => Array
        //                (
        //                    [0] => post 06 hoge
        //                    [1] => post 09 fizz
        //                    [2] => post 10 fizz
        //                    [3] => post 13 fizz
        //                    [4] => post 21 fizz
        //                    [5] => post 25 buzz
        //                    [6] => post 30 buzz
        //                )
        //        )
        //     .
        //     .
        //     .
        //     .

        // posts & role をEagerロード
        $members = Member::with(['posts', 'role'])->get();
    }
}
