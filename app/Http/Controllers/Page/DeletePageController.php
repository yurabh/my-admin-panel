<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeletePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page)
    {
        if ($page->image) {

            Storage::disk('s3')->delete($page->image);

            Log::debug('Image was deleted in s3 bucket');
        }
        try {

            $page->delete();

            Log::debug('Page was deleted');

        } catch (Exception $e) {
            return response()->json([
                'message' => "Page not found",
                'error' => $e->getMessage()], 404);
        }

        return response()->json([
            'message' => 'Page deleted successfully'
        ]);
    }
}
