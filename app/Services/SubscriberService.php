<?php

namespace App\Services;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SubscriberService
{
    /**
     * @throws ValidationException
     */
    public function store($data)
    {
        $validator = Validator::make($data, [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'email' => ['required', 'string', 'email'],
            Rule::unique('subscribers')->where(function ($query) use ($data) {
                return $query
                    ->where('user_id', $data['user_id'])
                    ->where('website_id', $data['website_id']);
            }),
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        Subscriber::query()->create([
            'user_id' => $data['user_id'],
            'website_id' => $data['website_id'],
            'email' => $data['email'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User was successfully subscribed',
        ]);
    }
}
