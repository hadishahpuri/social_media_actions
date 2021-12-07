<?php

namespace Hadishahpuri\SocialMediaActions\Controllers;

use Hadishahpuri\SocialMediaActions\Requests\CommentRequests\ApproveCommentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Hadishahpuri\SocialMediaActions\Requests\CommentRequests\CommentsRequest;
use Hadishahpuri\SocialMediaActions\Models\Bookmark;
use Hadishahpuri\SocialMediaActions\Models\Comment;
use Hadishahpuri\SocialMediaActions\Models\Like;
use Hadishahpuri\SocialMediaActions\SocialMediaActions;
use Hadishahpuri\SocialMediaActions\Requests\BookmarkRequests\BookmarkRequest;
use Hadishahpuri\SocialMediaActions\Requests\BookmarkRequests\DeleteBookmarkRequest;
use Hadishahpuri\SocialMediaActions\Requests\CommentRequests\CreateCommentRequest;
use Hadishahpuri\SocialMediaActions\Requests\CommentRequests\DeleteCommentRequest;
use Hadishahpuri\SocialMediaActions\Requests\CommentRequests\UpdateCommentRequest;
use Hadishahpuri\SocialMediaActions\Requests\LikeRequests\LikeOrDislikeRequest;

class SocialMediaActionController extends Controller
{
    /**
     * @param ApproveCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveComment(ApproveCommentRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $validated['approved_by'] = auth()->id();
        return response()->json(Comment::query()->where('id', $request->get('id'))->update($validated));
    }

    /**
     * @param CommentsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments(CommentsRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Comment::query()->select('id', 'content', 'user_id', 'reply_id', 'approval')->with(['user:id,name,username,profile', 'childReplies'])->where('approval', true)
            ->where('commentable_id', $request->get('commentable_id'))->where('commentable_type', $request->get('commentable_type'))
            ->where('reply_id', null)->paginate($request->get('paginate', 15)));
    }

    /**
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComment(CreateCommentRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        return response()->json(Comment::query()->create($validated));
    }

    /**
     * @param UpdateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateComment(UpdateCommentRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Comment::query()->where('id', $request->get('id'))->update($request->validated()));
    }

    /**
     * @param DeleteCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment(DeleteCommentRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Comment::query()->where('id', $request->get('id'))->delete());
    }

    /**
     * @param LikeOrDislikeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeOrDislike(LikeOrDislikeRequest $request): \Illuminate\Http\JsonResponse
    {
        $like = Like::query()->where('likeable_type', $request->get('likeable_type'))->where('likeable_id', $request->get('likeable_id'))->where('user_id', auth()->id())->first();
        if (!empty($like))
            $like->delete();
        else {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();
            Like::query()->create($validated);
        }
        return response()->json(true);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookmarks(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Bookmark::with('bookmarkable')->where('user_id', auth()->id())->paginate(Config::get('settings.paginate')));
    }

    /**
     * @param BookmarkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookmark(BookmarkRequest $request): \Illuminate\Http\JsonResponse
    {
        $bookmark = Bookmark::query()->where('user_id', auth()->id())->where('bookmarkable_type', $request->get('bookmarkable_type'))
            ->where('bookmarkable_id', $request->get('bookmarkable_id'))->first();
        if (empty($bookmark)) {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();
            $bookmark = Bookmark::query()->create($validated);
        }
        return response()->json($bookmark);
    }

    /**
     * @param DeleteBookmarkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBookmark(DeleteBookmarkRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Bookmark::query()->where('id', $request->get('id'))->delete());
    }
}
