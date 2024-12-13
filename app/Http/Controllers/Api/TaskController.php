<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('assigned_to_user_id')) {
            $query->where('assigned_to_user_id', $request->assigned_to_user_id);
        }

        // Paginate the tasks (10 per page, change as needed)
        $tasks = $query->paginate(10);

        // Return paginated tasks as a collection of TaskResource
        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $task = Task::create($request->all());
        Helper::sendSuccessRes('Task Store Succesfully', new TaskResource($task));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Try to find the task by its ID, or fail with a 404 error
            $task = Task::findOrFail($id);

            // Return the task data using TaskResource
            Helper::sendSuccessRes('Get Task Successfull', new TaskResource($task));
        } catch (ModelNotFoundException $e) {
            // Return a custom error response if the task is not found
            Helper::sendErr('Task Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        
        try {
            $task = Task::findOrFail($id);
            $this->authorize('update', $task);
            // Update the task with the validated data
            $task->update($request->validated());

            Helper::sendSuccessRes('Task Update Successfull', new TaskResource($task));
        } catch (ModelNotFoundException $e) {
            // Return a custom error response if the task is not found
            Helper::sendErr('Task Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            // Find the task by its ID or fail with a 404 error
            $task = Task::findOrFail($id);
            $this->authorize('delete', $task);
            // Delete the task
            $task->delete();

            Helper::sendSuccessRes('Task Deleted Succesfull');
        } catch (ModelNotFoundException $e) {
            // Return a custom error response if the task is not found
            Helper::sendErr('Task Not Found');
        }
    }
}
