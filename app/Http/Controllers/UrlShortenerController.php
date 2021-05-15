<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Helpers\UrlHelper;
use App\Models\UrlShort;
use App\Rules\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    use UrlHelper, ResponseHelper;

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), ([
            'link' => ['required', 'url', new Blacklist],
        ]));

        if ($validator->fails()) {
            return $this->generateResponse($validator->errors()->first(), 422);
        }

        if (!UrlHelper::verifyUrlExists($request->link)) {
            return ResponseHelper::generateResponse("Invalid Url", 404, true);
        }

        $input['link'] = $request->link;
        $input['code'] = UrlHelper::generateUniqueSlug();

        $data = UrlShort::create($input);

        return ResponseHelper::generateResponse($data, 401);
    }

    public function shortenLink($code)
    {
        $url = UrlShort::where('code', $code)->first();
        $url->hit = (int) $url->hit + 1;
        $url->save();
        return ResponseHelper::generateResponse($url, 401);
    }
}
