<?php

namespace App\Http\Controllers\NormalUser\ResourceSpace;

use App\Http\Controllers\Controller;
use App\Models\NormalUser\ResourceSpace\ResourceSpaceBlog;
use App\Models\NormalUser\ResourceSpace\ResourceSpacePost;
use Illuminate\Http\Request;

class ResourceSpaceBlogController extends Controller
{
    public function detail($id)
    {
        $blog = ResourceSpaceBlog::findOrFail($id); // Retrieve the blog or return 404 if not found
        $blog->increment('hit_count');
        return view('normal-user.resource-space.blog-detail', compact('blog'));
    }


    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'resource_space_id' => 'required|integer|exists:resource_spaces,id', // Ensure it exists in the resource_spaces table
            'user_id' => 'required|integer|exists:users,id', // Ensure it exists in the users table
            'title' => 'required|string|max:255', // Required, string, maximum 255 characters
            'description' => 'required|string', // Required, no maximum limit
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, must be an image with size <= 2MB
            'status' => 'nullable|integer|in:0,1', // Optional, must be 0 or 1
        ]);
        ResourceSpaceBlog::newResourceSpaceBlog($request);
        return back()->with('message','New Blog Created Successfully');
    }

    public function edit($id)
    {
        // Find the post by ID or show a 404 if not found
        $blog = ResourceSpaceBlog::findOrFail($id);

        // Pass the post to the view
        return view('normal-user.resource-space.detail', compact('blog'));
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
        $blog = ResourceSpaceBlog::findOrFail($id);
        // If the status is set to 1, reset all other posts' statuses to 0
        if ($request->status == 1) {
            ResourceSpacePost::where('id', '!=', $blog->id)
                ->update(['status' => 0]);
        }
        ResourceSpaceBlog::updateResourceSpaceBlog($request, $blog->id);
        return back()->with('message','Blog Updated Successfully');
    }

    public function delete($id)
    {
        $post = ResourceSpaceBlog::findOrFail($id);
        ResourceSpaceBlog::deleteResourceSpaceBlog($post->id);
        return redirect()->route('normal-user.resource-space.index')->with('message','Blog Deleted Successfully');
    }
}
