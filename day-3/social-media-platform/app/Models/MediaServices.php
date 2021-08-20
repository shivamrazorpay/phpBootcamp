<?php


namespace App\Models;


//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class MediaServices
{

    //getAllUser will return all user details in the user_table
    public function getAllUser()
    {

        $users = User::all();

        if($users == null){
            return response()->json([
                'data' => 'BAD REQUEST',
                'description' => 'There is no user'
            ]);
        }else {
            return response()->json([
                'data' => $users,
                'description' => 'Successfully retrieved all users'
            ]);
        }
    }

    //addUser adds user to the user_table
    public function addUser(Request $request): JsonResponse {

        // checking if first name and last name is present in request
        // checking if the request email is valid
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=> 'required|regex:/(.+)@(.+)\.(.+)/i'
        ]);
        if($validator->fails()){
            return response()->json([
                "error"=> "BAD REQUEST",
                "description"=> "first_name/last_name/email not present or invalid email or email already used !"
            ],400);
        }


        $social_media_user = User::query()->create([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "email" => $request->get('email'),
        ]);
        if($social_media_user == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else{
            $social_media_user['token']='secret';
            return response()->json([
                "data"=>$social_media_user,
                "description"=>"success"
            ]);
        }
    }

    //addUser adds user to the user_table
    public function createPost(Request $request,$user): JsonResponse {

        // post length cannot be more than 500 alphabets
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:500',
        ]);
        if($validator->fails()){
            return response()->json([
                "error"=> "BAD REQUEST",
                "description"=> "description cannot be more than 500 words"
            ],400);
        }


        $post_data = Post::query()->create([
            'user_id'=>$user,
            "description"=>$request->get('description'),
            "tag"=>$request->get('tag')
        ]);
        if($post_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else{
            return response()->json([
                "data"=>$post_data,
                "description"=>"success"
            ]);
        }
    }

    //getAllCommentByPostId adds comment to the post with given id
    public function getAllPostByUserId($user,$tag,$skip,$limit): JsonResponse {
        $user_data = User::query()->where('id',$user)->get();
        if($user_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else if(count($user_data)==0){
            return response()->json([
                "data"=>"",
                "description"=>"No User with such id exist"
            ],404);
        }


        if($tag == null){
            $post_data = Post::query()->where('user_id',$user)
                                      ->skip($skip*$limit)->take($limit)
                                      ->get();
        }else{
            $post_data = Post::query()->where('user_id',$user)
                                      ->where('tag',$tag)
                                      ->skip($skip*$limit)->take($limit)
                                      ->get();
        }
        if($post_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else if(count($post_data)==0){
            return response()->json([
                "data"=> "",
                "description"=> "No Comment or no post"
            ],404);
        }else{
            return response()->json([
                "data"=>$post_data,
                "description"=>"success"
            ]);
        }
    }

    //createCommentByPostId adds comment to the post with given id
    public function createCommentByPostId(Request $request,$post): JsonResponse {

        // comment length cannot be more than 200 alphabets
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:200',
        ]);
        if($validator->fails()){
            return response()->json([
                "error"=> "BAD REQUEST",
                "description"=> "comment cannot be more than 200 words"
            ],400);
        }


        $post_data = Post::query()->where('id',$post)->get();
        if($post_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else if(count($post_data)==0){
            return response()->json([
                "data"=>"",
                "description"=>"No Post with such id exist"
            ],404);
        }

        $comment_data = Comment::query()->create([
            'post_id'=>$post,
            "description"=>$request->get('description')
        ]);

        if($comment_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else{
            return response()->json([
                "data"=>$comment_data,
                "description"=>"success"
            ]);
        }
    }

    //getAllCommentByPostId adds comment to the post with given id
    public function getAllCommentByPostId($post,$skip,$limit): JsonResponse {
        $comment_data = Comment::query()->where('post_id',$post)
                                        ->skip($skip*$limit)->take($limit)
                                        ->get();
        if($comment_data == null){
            return response()->json([
                "error"=> "SERVER ERROR",
                "description"=> "db query failed"
            ],500);
        }else if(count($comment_data)==0){
            return response()->json([
                "data"=> "",
                "description"=> "No Comment or no post"
            ],404);
        }else{
            return response()->json([
                "data"=>$comment_data,
                "description"=>"success"
            ]);
        }
    }
}
