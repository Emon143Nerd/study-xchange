<?php

namespace App\Http\Controllers\NormalUser\ResourceSpace;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePost;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePostComment;
use Illuminate\Http\Request;

class ResourceSpacePostCommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:resource_space_post_comments,id', // Validate parent_id for nested replies
        ]);

        ResourceSpacePostComment::newResourceSpacePostComment($request->merge(['resource_space_post_id' => $postId]));

        return back()->with('success', 'Comment added successfully!');
    }

    public function edit($id)
    {
        $comment = ResourceSpacePostComment::findOrFail($id);

        // Ensure the user is authorized to edit the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return response()->json(['comment' => $comment], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = ResourceSpacePostComment::findOrFail($id);

        // Ensure the user is authorized to update the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->update(['comment' => $request->comment]);

        return back()->with('success', 'Comment updated successfully!');
    }


    public function destroy($id)
    {
        // Find the comment by ID
        $comment = ResourceSpacePostComment::findOrFail($id);

        // Ensure the authenticated user is the owner of the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Call recursive delete function
        $this->deleteCommentAndReplies($comment);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Comment and all its replies deleted successfully.');
    }

    private function deleteCommentAndReplies(ResourceSpacePostComment $comment)
    {
        // Delete all replies (children comments) of this comment
        foreach ($comment->replies as $reply) {
            $this->deleteCommentAndReplies($reply); // Recursive call to delete replies
        }

        // Now delete the main comment
        $comment->delete();
    }


}
