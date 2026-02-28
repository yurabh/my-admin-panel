<?php

namespace App\Actions\Page;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ShowPageAction
{
    public function __construct()
    {
    }

    public function handle($id): Page|JsonResponse
    {
        try {
            return Page::query()->findOrFail($id);
        } catch (\Exception $e) {
            Log::debug('Page not found', ['exception' => $e->getMessage()]);
            return response()->json([
                'message' => "Page with id {$id} not found: " . $e->getMessage()
            ], 404);
        }
    }
}
