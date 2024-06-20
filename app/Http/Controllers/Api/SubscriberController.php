<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SubscriberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    public function store(SubscriberService $subscribeService, Request $request)
    {
        try {
            $data = $request->all();
            /** @var TYPE_NAME $subscribeService */
            return $subscribeService->store($data);
        } catch (ValidationException $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . "->" . $e->getMessage());
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
