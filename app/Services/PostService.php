<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Website;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PostService
{
    /**
     * @throws ValidationException
     */
    public function store($data)
    {
        $validator = Validator::make($data, [
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'title' => ['required', 'string', 'max: 128'],
            'description' => ['required', 'string'],
            'email_sent' => ['boolean', 'string'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $post = Post::query()->create([
            'website_id' => $data['website_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return response()->json([
            'status' => true,
            'post' => $post,
        ], Response::HTTP_CREATED);
    }
}
