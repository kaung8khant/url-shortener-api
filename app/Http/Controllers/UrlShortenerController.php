<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Helpers\UrlHelper;
use App\Models\UrlShort;
use App\Rules\Blacklist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    use UrlHelper, ResponseHelper;

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), ([
            'link' => ['required', 'url', new Blacklist],
            'expired_at' => 'nullable|date',
        ]));

        if ($validator->fails()) {
            return $this->generateResponse($validator->errors()->first(), 422, true);
        }

        if (!UrlHelper::verifyUrlExists($request->link)) {
            return ResponseHelper::generateResponse("Invalid Url", 404, true);
        }

        $input['link'] = $request->link;
        $input['expired_at'] = $request->expired_at;
        $input['code'] = UrlHelper::generateUniqueSlug();

        $data = UrlShort::create($input);

        return ResponseHelper::generateResponse($data, 201);
    }

    public function shortenLink($code)
    {
        $url = UrlShort::withTrashed()->where('code', $code)->first();
        $url->hit = (int) $url->hit + 1;

        if ($url->deleted_at) {
            return ResponseHelper::generateResponse("Link deleted", 410, true);
        }
        if ($url->expired_at < Carbon::now()) {
            return ResponseHelper::generateResponse("Link expired", 410, true);
        }
        $url->save();
        return ResponseHelper::generateResponse($url, 201);
    }

}
