<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodosResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {
        $todos = TodosResource::collection(Todo::all());
        return response()->json(['message' => 'test', 'data' => $todos, 'status' => 200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return TodosResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreTodoRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();

        $todos = Todo::create($attributes);

        return new TodosResource($todos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return TodosResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return new TodosResource($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param  \App\Models\Todo  $todo
     * @return TodosResource|\Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();

        $todo->update($attributes);

        return new TodosResource($todo);

    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return 'success';
    }

    public function toggleComplete(Todo $todo) {
        $todo->toggleComplete();
        return true;
    }
}
