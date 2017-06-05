<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Transformers\TodoTransformer;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Validator;

class TodoController extends ApiBaseController
{
    //
    public $request;

    function __construct(Request $request)
    {
//        $this->middleware('cors');
        $this->request = $request;
    }

    public function index()
    {
        $todos = Todo::all();
        return $this->response->collection($todos, new TodoTransformer());
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
           'title' => 'required|unique:todos',
            'active' => 'boolean'
        ]);

        if($validator->fails()){
            throw new ValidationHttpException($validator->errors()->all());
        }
//        $todos = Todo::all();
//        return response()->json(['data' => $todos]);

        $todo = Todo::create($this->request->only('title', 'active'));
        return $this->response->item($todo, new TodoTransformer());
    }

    public function show($id)
    {
        $d_id = encrypt_decrypt('decrypt', $id);
        $todo = Todo::find($d_id);
        if(!$todo)
            throw new ResourceNotFoundException('Todo not found');
        return $this->response->item($todo, new TodoTransformer());
    }

    public function update($id)
    {
        $d_id = encrypt_decrypt('decrypt', $id);

        $validator = Validator::make($this->request->all(), [
            'title' => 'required|unique:todos,title,'.$d_id,
            'active' => 'boolean'
        ]);

        if($validator->fails()){
            throw new ValidationHttpException($validator->errors()->all());
        }

        $todo = Todo::find($d_id);
        if(!$todo)
            throw new ResourceNotFoundException('Todo not found');
        $todo->update($this->request->only('title', 'active'));
        return $this->response->item($todo, new TodoTransformer());
    }

    public function delete($id)
    {
        $d_id = encrypt_decrypt('decrypt', $id);
        $todo = Todo::findOrFail($d_id);
        $todo->delete();
        return $this->response->item($todo, new TodoTransformer());
    }

    public function search()
    {

    }
}
