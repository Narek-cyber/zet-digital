<?php

namespace App\Services;

use App\Events\EmailProcessed;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SubscriberService
{
    /**
     * @throws ValidationException
     */
    public function store($data)
    {
        $validator = Validator::make($data, [
            'user_id' => ['required', 'exists:users,id'],
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers,email'],
            Rule::unique('subscribers')->where(function ($query) use ($data) {
                return $query
                    ->where('user_id', $data['user_id'])
                    ->where('website_id', $data['website_id']);
            }),
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $website = Website::query()->find($data['website_id']);

        Subscriber::query()->create([
            'user_id' => $data['user_id'],
            'website_id' => $data['website_id'],
            'email' => $data['email'],
        ]);

        event(new EmailProcessed($data['email'], $website->{'url'}, $website->{'name'}));

        return response()->json([
            'status' => true,
            'message' => 'User was successfully subscribed',
        ]);
    }
}
