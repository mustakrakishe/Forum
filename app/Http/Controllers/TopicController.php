<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Factories\Factory;

class TopicController extends Controller
{
    // Resource methods

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with('author')->get();
        return view('topics/index', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = $this->xhrValidate($request);
        if(!$errors){
            $topic = Topic::create([
                'header' => $request['header'],
                'description' => $request['description'],
                'author_id' => Auth::id(),
            ]);

            return view('components.topic.index', compact('topic'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::with('root_comments.answers')->findOrFail($id);

        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        return view('components.topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = $this->xhrValidate($request);

        if(!$errors){
            $topic = Topic::findOrFail($id);

            $topic->header = $request->header;
            $topic->description = $request->description;
            $topic->save();

            return view('components\topic\show', compact('topic'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Topic::findOrFail($id)->delete();
        return redirect()->route('topics.index');
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
