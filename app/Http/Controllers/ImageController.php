<?php

namespace App\Http\Controllers;

use App\Transformers\ImageTransformer;
use Illuminate\Http\Request;

use App\Image;

class ImageController extends ApiBaseController
{
    //

    public $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $images = Image::all();
        return $this->response->collection($images, new ImageTransformer());
    }
}
