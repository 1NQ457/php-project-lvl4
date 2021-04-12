<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_status.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_status.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:task_statuses',
        ]);

        TaskStatus::create($request->all());
        flash(__('interface.task_statuses.created'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('task_statuses')->ignore($taskStatus)
            ]
        ]);

        $taskStatus->fill($request->all());
        $taskStatus->save();
        flash(__('interface.task_statuses.updated'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('interface.task_statuses.exists'))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();
        flash(__('interface.task_statuses.destroyed'))->success();
        return redirect()->route('task_statuses.index');
    }
}
