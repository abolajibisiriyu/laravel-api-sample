<?php
/**
 * Created by PhpStorm.
 * User: davinci
 * Date: 5/11/17
 * Time: 5:55 PM
 */

namespace App\Transformers;


use App\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Image $image){
        return [
            'title' => $image->title,
            'description' => $image->description,
            'thumbnail' => $image->thumbnail,
            'imageUrl' => $image->imageUrl
        ];
    }

}