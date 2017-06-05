<?php
/**
 * Created by PhpStorm.
 * User: davinci
 * Date: 5/12/17
 * Time: 1:06 PM
 */

namespace App\Transformers;


use App\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    public function transform(Todo $todo)
    {
        return [
            'id' => encrypt_decrypt('encrypt',$todo->id),
            'title' => $todo->title,
            'active' => (boolean)$todo->active
        ];
    }
}