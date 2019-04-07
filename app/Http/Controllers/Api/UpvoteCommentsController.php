<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use App\User;
use App\UserDownvoteComment;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Comment;
use App\UserUpvoteComment;
use App\Http\Controllers\Controller;

class UpvoteCommentsController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function show($id)
    {
        return User::findOrFail($id);
    }*/
    public function store(Request $request){
        $inputs = $request->all();
        $getUserId = User::selectRaw("id")->whereRaw("username = ?",[$inputs["username"]])->first();
        $checkUsername = UserUpvoteComment::selectRaw("count(*) as usernames")->whereRaw("user_id = ?",[intval($getUserId->id)])->first();
        if(intval($checkUsername->usernames) > 0){
            return response()->json(["http" => "400", "Message" => "Cannot Upvote the comment. please try again later"]);
        }

        $getcommentVote = Comment::whereRaw("id = ?",[$inputs["comment_id"]])->first();

        //checkdownvote
        $checkDownVote = UserDownvoteComment::whereRaw("user_id = ? and comment_id = ?",[intval($getUserId->id),intval($inputs["comment_id"])])->first();
        if($checkDownVote != null){
            UserDownvoteComment::whereRaw("id = ?",[$checkDownVote->id])->delete();
            $getcommentVote->downvote = intval($getcommentVote->downvote) - 1;
        }
        $getcommentVote->upvote = intval($getcommentVote->upvote) + 1;
        $getcommentVote->save();
        $getUserId = User::selectRaw("id")->whereRaw("username = ?",[$inputs["username"]])->first();

        try {
            $userUpvoteComment = new UserUpvoteComment();
            $userUpvoteComment->user_id = $getUserId->id;
            $userUpvoteComment->comment_id = $inputs["comment_id"];
            $userUpvoteComment->created_at = Carbon::now();
            $userUpvoteComment->updated_at = Carbon::now();
            $userUpvoteComment->save();
            return response()->json(["http" => "200", "Message" => "Upvote Success"]);
        }catch (QueryException $e){
            return response()->json(["http" => "400", "Message" => "Cannot Upvote the comment. please try again later"]);
        }
    }
}