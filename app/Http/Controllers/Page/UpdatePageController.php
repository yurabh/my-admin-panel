<?php

namespace App\Http\Controllers\Page;

use App\Actions\Page\UpdatePageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;

class UpdatePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page, UpdatePageRequest $request, UpdatePageAction $action)
    {
        return PageResource::make($action->handle($request, $page));
    }
}
