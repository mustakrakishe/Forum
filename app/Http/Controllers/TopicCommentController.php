<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicCommentController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return array
     */
    public function index(Topic $topic)
    {
        $comments = $this->fetch_comments($topic);
        
        return [
            'status' => 1,
            'view' => view('components.comment.index', compact('comments'))->render(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $topicId
     * @return array
     */
    public function create(Request $request, string $topicId)
    {
        $comment = new Comment([
            'answer_to_id' => $request->answerToId,
            'topic_id' => $topicId,
        ]);

        $comment->author = $request->user();

        return [
            'status' => 1,
            'view' => view('components.comment', compact('comment'))
                ->with(['mode' => 'create'])->render(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $topicId
     * @return array
     */
    public function store(Request $request, string $topicId)
    {
        $errors = $this->validateComment($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }

        $comment = Comment::create([
            'text' => $request->text,
            'author_id' => $request->user()->id,
            'topic_id' => $topicId,
            'answer_to_id' => $request->answerToId,
        ]);
        
        return [
            'status' => 1,
            'view' => view('components.comment.sub-tree', compact('comment'))->render(),
        ];
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
     * @param  string  $topicId
     * @param  \App\Models\Comment  $comment
     * @return array
     */
    public function edit(string $topicId, Comment $comment)
    {
        return [
            'status' => 1,
            'view' => view('components.comment.content.edit', compact('comment'))->render(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $topicId
     * @param  \App\Models\Comment  $comment
     * @return array
     */
    public function update(Request $request, string $topicId, Comment $comment)
    {
        $errors = $this->validateComment($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }

        $comment->update($request->only($comment->fillable));

        return [
            'status' => 1,
            'view' => view('components.comment.content.show', compact('comment'))->render(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $topicId
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function destroy(string $topicId, Comment $comment)
    {
        $comment->delete();
    }

    // Other methods

    /**
     * Get paginated comments for the topic.
     *
     * @param  \App\Models\Topic  $topic
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function fetch_comments(Topic $topic)
    {
        return $topic->root_comments()
            ->paginate(10)
            ->withPath(route('topics.comments.index', ['topic' => $topic->id]));
    }

    /**
     * Validate a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    protected function validateComment(Request $request)
    {
        $this->authorize('validateComment', Comment::class);

        $input = $request->all();

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return [];
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
