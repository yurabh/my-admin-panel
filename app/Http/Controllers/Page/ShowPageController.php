<?php

namespace App\Http\Controllers\Page;

use App\Actions\Page\ShowPageAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;

class ShowPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, ShowPageAction $action)
    {
        return PageResource::make($action->handle($id));
    }
}
