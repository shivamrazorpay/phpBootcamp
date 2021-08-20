<?php

namespace App\Http\Controllers;

use App\Models\MediaServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
//
    protected $media_services;

    public function __construct(MediaServices $media_services)
    {
        $this->media_services = $media_services;
    }

    public function addUser(Request $request): JsonResponse{
        return $this->media_services->addUser($request);
    }

    public function getAllUser(Request $request){
        $limit = $request->limit;
        $skip = $request ->skip;
        return $this->media_services->getAllUser();
    }

    public function createPost(Request $request,$user): JsonResponse{
        return $this->media_services->createPost($request,$user);
    }

    public function getAllPostByUserId(Request $request,$user): JsonResponse{
        $tag = $request->tag;
        $limit = $request->limit;
        $skip = $request ->skip;
        return $this->media_services->getAllPostByUserId($user,$tag,$skip,$limit);
    }

    public function createCommentByPostId(Request  $request, $post){
        return $this->media_services->createCommentByPostId($request, $post);
    }

    public function getAllCommentByPostId(Request $request,$post){
        $limit = $request->limit;
        $skip = $request ->skip;
        return $this->media_services->getAllCommentByPostId($post,$skip,$limit);
    }

}
