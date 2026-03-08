<?php

namespace App\Actions\Tag;

use App\Http\Requests\Tag\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class UpdateTagAction
{
    public function __construct()
    {
    }

    public function handle(TagRequest $request, Tag $tag): Tag
    {
        $data = $request->validated();

        $tag->update($data);

        Log::debug('Tag updated with id: ' . $tag->id);

        return $tag;
    }
}
