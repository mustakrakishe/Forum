<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Topic $topic)
    {
        $comment = new Comment([
            'answer_to_id' => $request->answerToId,
            'topic_id' => $topic->id,
        ]);

        $comment->author = $request->user();

        return view('components.comment', compact('comment'))->with(['mode' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Topic $topic)
    {
        $errors = $this->xhrValidate($request);

        if(!$errors){
            $comment = Comment::create([
                'text' => $request->text,
                'author_id' => $request->user()->id,
                'topic_id' => $topic->id,
                'answer_to_id' => $request->answerToId,
            ]);

            return view('components.comment.sub-tree', compact('comment'))->render();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic, Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic, Comment $comment)
    {
        return view('components.comment.content.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic, Comment $comment)
    {
        $errors = $this->xhrValidate($request);

        if(!$errors){
            $comment->text = $request->text;
            $comment->save();

            return view('components.comment.content.show', compact('comment'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Comment $comment)
    {
        $comment->delete();
    }

    // Other methods

    /**
     * Validate a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function xhrValidate(Request $request)
    {
        // $this->authorize('xhrValidate', Comment::class);

        return $input = $request->all();

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'text' => ['required', 'string', 'max:1024'],
        ]);
    }
}
