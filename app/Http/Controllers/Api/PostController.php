<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @param PostService $postService
     * @param Request $request
     * @return JsonResponse|null
     */
    public function store(PostService $postService, Request $request, $id)
    {
        try {
            $data = $request->all();
            $data['website_id'] = $id;
            /** @var TYPE_NAME $postService */
            return $postService->store($data);
        } catch (ValidationException $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . "->" . $e->getMessage());
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
