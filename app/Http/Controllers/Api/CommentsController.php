<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use App\Comment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
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
        $genericId = $username = $comment = "";
        $voteCounter = 0;

        if(isset($inputs['username']) && !empty($inputs['username'])){
            $username = $inputs['username'];
        }else{
            $genericId = $this->incrementalHash(9);
        }
        if(isset($inputs["comment"]) && !empty($inputs["comment"])){
            $comment = $inputs["comment"];
        }
        $carId = intval($inputs["carId"]);

        try {
            $comments = new Comment();
            $comments->car_id = $carId;
            $comments->generic_id = $genericId;
            $comments->username = $username;
            $comments->comment = $comment;
            $comments->vote_counter = $voteCounter;
            $comments->created_at = Carbon::now();
            $comments->updated_at = Carbon::now();
            $comments->save();
            return response()->json(["http" => "200","Message" => "Successfully Submitted!"]);
        }catch (QueryException $e){
            return response()->json(["http" => "400", "Message" => "System Error! Please Contact our support team!"]);
        }
    }

    public function update(Request $request){
        $inputs = $request->all();

    }

    public function destroy(Request $request){
        $inputs = $request->all();

    }
    //random alphanumeric for genericId
    public function incrementalHash($len = 9){
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base){
            $i = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }
        return substr($result, -9);
    }

}