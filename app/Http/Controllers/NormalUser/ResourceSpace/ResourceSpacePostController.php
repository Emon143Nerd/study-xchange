<?php

namespace App\Http\Controllers\NormalUser\ResourceSpace;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePost;
use Illuminate\Http\Request;

class ResourceSpacePostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resource_space_id' => 'required|integer|exists:resource_spaces,id', // Ensure it exists in the resource_spaces table
            'user_id' => 'required|integer|exists:users,id', // Ensure it exists in the users table
            'title' => 'required|string|max:255', // Required, string, maximum 255 characters
            'description' => 'required|string', // Required, no maximum limit
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, must be an image with size <= 2MB
            'status' => 'nullable|integer|in:0,1', // Optional, must be 0 or 1
        ]);
        ResourceSpacePost::newResourceSpacePost($request);
        return back()->with('message','Post Created Successfully');
    }

    public function edit($id)
    {
        // Find the post by ID or show a 404 if not found
        $post = ResourceSpacePost::findOrFail($id);

        // Pass the post to the view
        return view('normal-user.resource-space.detail', compact('post'));
    }


    public function update(Request $request, $id)
    {
//        dd($request->all()); // Check request data before updating

        $request->validate([
            'resource_space_id' => 'required|integer|exists:resource_spaces,id', // Ensure it exists in the resource_spaces table
            'user_id' => 'required|integer|exists:users,id', // Ensure it exists in the users table
            'title' => 'required|string|max:255', // Required, string, maximum 255 characters
            'description' => 'required|string', // Required, no maximum limit
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, must be an image with size <= 2MB
            'status' => 'nullable|integer|in:0,1', // Optional, must be 0 or 1
        ]);
        $post = ResourceSpacePost::findOrFail($id);
        // If the status is set to 1, reset all other posts' statuses to 0
        if ($request->status == 1) {
            ResourceSpacePost::where('id', '!=', $post->id)
                ->update(['status' => 0]);
        }
        ResourceSpacePost::updateResourceSpacePost($request, $post->id);
        return back()->with('message','Post Updated Successfully');
    }

    public function delete($id)
    {
        $post = ResourceSpacePost::findOrFail($id);
        ResourceSpacePost::deleteResourceSpacePost($post->id);
        return back()->with('message','Post Deleted Successfully');
    }


    public function upvote($id)
    {
        $post = ResourceSpacePost::findOrFail($id);
        $existingVote = $post->votes()->where('user_id', auth()->id())->first();

        // Check if the user has voted already
        if ($existingVote) {
            if ($existingVote->vote_type == 'upvote') {
                // User already upvoted, so we remove the upvote and reset
                $existingVote->delete();
                $post->decrement('upvotes');
            } else {
                // User has downvoted previously, change their vote to upvote
                $existingVote->update(['vote_type' => 'upvote']);
                $post->increment('upvotes');
                $post->decrement('downvotes');
            }
        } else {
            // User hasn't voted, create an upvote
            $post->votes()->create([
                'user_id' => auth()->id(),
                'vote_type' => 'upvote',
            ]);
            $post->increment('upvotes');
        }

        return back()->with('message', 'Post upvoted successfully');
    }

    public function downvote($id)
    {
        $post = ResourceSpacePost::findOrFail($id);
        $existingVote = $post->votes()->where('user_id', auth()->id())->first();

        // Check if the user has voted already
        if ($existingVote) {
            if ($existingVote->vote_type == 'downvote') {
                // User already downvoted, so we remove the downvote and reset
                $existingVote->delete();
                $post->decrement('downvotes');
            } else {
                // User has upvoted previously, change their vote to downvote
                $existingVote->update(['vote_type' => 'downvote']);
                $post->increment('downvotes');
                $post->decrement('upvotes');
            }
        } else {
            // User hasn't voted, create a downvote
            $post->votes()->create([
                'user_id' => auth()->id(),
                'vote_type' => 'downvote',
            ]);
            $post->increment('downvotes');
        }

        return back()->with('message', 'Post downvoted successfully');
    }


}
