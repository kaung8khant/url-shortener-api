<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Helpers\UrlHelper;
use App\Http\Controllers\Controller;
use App\Models\UrlShort;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    use UrlHelper, ResponseHelper;

    public function index(Request $request)
    {
        $url = UrlShort::where('code', 'like', '%' . $request->filter . '%')->get();

        return ResponseHelper::generateResponse($url, 200);
    }

    public function destroy($id)
    {
        $url = UrlShort::where('id', $id)->first();

        $url->delete();

        return ResponseHelper::generateResponse("Deleted", 200, true);
    }

}
