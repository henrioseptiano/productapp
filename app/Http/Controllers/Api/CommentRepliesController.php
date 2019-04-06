<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Support\Facades\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;

class CommentRepliesController extends Controller
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

    }

    public function update(Request $request){
        $inputs = $request->all();

    }

    public function destroy(Request $request){
        $inputs = $request->all();

    }

}