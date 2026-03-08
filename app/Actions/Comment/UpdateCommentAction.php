<?php

namespace App\Actions\Comment;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateCommentAction
{
    public function __construct()
    {
    }

    /**
     * @throws \Throwable
     */
    public function handle(CommentRequest $request, Comment $comment): Comment|JsonResponse
    {
        $data = $request->validated();

        Log::debug('Validation passed successfully');

        DB::transaction(fn() => $comment->update($data));

        Log::debug('Comment updated with id: ' . $comment->id);

        return $comment;
    }
}
