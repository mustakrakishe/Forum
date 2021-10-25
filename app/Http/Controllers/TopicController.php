<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Topic::class, 'topic');
    }

    // Resource methods

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = $this->validateTopic($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }
        
        $topic = Topic::create([
            'header' => $request['header'],
            'description' => $request['description'],
            'author_id' => Auth::id(),
        ]);

        return [
            'status' => 1,
            'view' => view('components.topic.index', compact('topic'))->render(),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $comments = TopicCommentController::fetch_comments($topic);
        return view('topics.show', compact('topic', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return [
            'status' => 1,
            'view' => view('components.topic.edit', compact('topic'))->render(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $errors = $this->validateTopic($request);
        if ($errors) return [
            'status' => 0,
            'errors' => $errors,
        ];

        $topic->update($request->only($topic->fillable));

        return [
            'status' => 1,
            'view' => view('components.topic.show', compact('topic'))->render(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index');
    }

    // Other methods

    /**
     * Validate a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validateTopic(Request $request)
    {
        $this->authorize('validateTopic', Topic::class);

        $input = $request->all();

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
            'header' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1024'],
        ]);
    }
}
