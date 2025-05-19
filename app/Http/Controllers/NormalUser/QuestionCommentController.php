<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\QuestionComment;
use Illuminate\Http\Request;

class QuestionCommentController extends Controller
{
    public function store(Request $request)
    {
//        return $request;
        // Validate the request data
        $request->validate([
            'user_id' => 'required|integer',
            'question_id' => 'required|integer',
            'answer' => 'required|string',
        ]);

        // Save the comment
        QuestionComment::newQuestionComment($request);

        // Redirect back with a success message
        return back()->with('message', 'Comment posted successfully.');
    }

    public function edit($id)
    {
        $comment = QuestionComment::where('id', $id)->firstOrFail();
        return view('normal-user.question.detail', compact('comment'));
    }



    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'answer' => 'required|string', // Validate the 'answer' field instead of 'message'
        ]);

        // Update the comment using the updated method
        QuestionComment::updateQuestionComment($request, $id);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Your comment has been updated');
    }


    public function delete($id)
    {
        QuestionComment::deleteQuestionComment($id);
        return back()->with('message', 'Rating info delete successfully.');

    }

    public function reportSpam(Request $request, $id)
    {
        $comment = QuestionComment::findOrFail($id);

        // Increment spam report count
        $comment->reportSpam();

        return redirect()->back()->with('message', 'The comment has been reported successfully.');
    }


}
