<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Comment::class);

        return view('dashboard.comment.index', [
            'comments' => Comment::with(['user', 'product'])->get(),
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        Gate::authorize('view', $comment);

        return view('dashboard.comment.show', [
            'comment' => $comment->load(['user', 'product']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return to_route('dashboard.comment.index')->with('success', __('Comment deleted successfully.'));
    }
}
