<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use App\User;
use App\UserUpvoteComment;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Comment;
use App\UserDownvoteComment;
use App\Http\Controllers\Controller;

class DownvoteCommentsController extends Controller
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
        $checkUsername = UserDownvoteComment::selectRaw("count(*) as usernames")->whereRaw("user_id = ?",[intval($getUserId->id)])->first();
        if(intval($checkUsername->usernames) > 0){
            return response()->json(["http" => "400", "Message" => "Cannot Upvote the comment. please try again later"]);
        }


        $getcommentVote = Comment::whereRaw("id = ?",[$inputs["comment_id"]])->first();
        //checkupvote
        $checkUpVote = UserUpvoteComment::selectRaw("id")
            ->whereRaw("user_id = ? and comment_id = ?",[intval($getUserId->id),intval($inputs["comment_id"])])
            ->first();
        if($checkUpVote != null){
            UserUpvoteComment::whereRaw("id = ?",[$checkUpVote->id])->delete();
            $getcommentVote->upvote = intval($getcommentVote->upvote) - 1;
        }


        $getcommentVote->downvote = intval($getcommentVote->downvote) + 1;
        $getcommentVote->save();

        $getUserId = User::selectRaw("id")->whereRaw("username = ?",[$inputs["username"]])->first();

        try {
            $userDownvoteComment = new UserDownvoteComment();
            $userDownvoteComment->user_id = $getUserId->id;
            $userDownvoteComment->comment_id = $inputs["comment_id"];
            $userDownvoteComment->created_at = Carbon::now();
            $userDownvoteComment->updated_at = Carbon::now();
            $userDownvoteComment->save();
            return response()->json(["http" => "200", "Message" => "Downvote Success"]);
        }catch (QueryException $e){
            return response()->json(["http" => "400", "Message" => "Cannot Upvote the comment. please try again later"]);
        }

    }


}