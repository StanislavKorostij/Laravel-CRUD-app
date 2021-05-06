<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->statuses_id) && $request->statuses_id !== 0)
            $tasks = \App\Models\Tasks::where('statuses_id', $request->statuses_id)->orderBy('created_at', 'desc')->get();
        else
            $tasks = \App\Models\Tasks::orderBy('created_at', 'desc')->get();
        $statuses = \App\Models\Statuses::orderBy('name')->get();
        return view('tasks.index', ['tasks' => $tasks, 'statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = \App\Models\Statuses::orderBy('name')->get();
        return view('tasks.create', ['statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task_name' => 'required',
            'task_description' => 'required',
        ]);
        if ($request->statuses_id == null) {
            return back()->withErrors(['error' => ['No status is selected']]);
        } else {
            $task = new Tasks();
            $task->fill($request->all());
            $task->save();
            return redirect()->route('tasks.index')->with('message', $request->task_name . ' Task Added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {
        $statuses = \App\Models\Statuses::orderBy('name')->get();
        return view('tasks.edit', ['task' => $task, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $task)
    {
        $this->validate($request, [
            'task_name' => 'required',
            'task_description' => 'required',
        ]);

        $task->fill($request->all());
        $task->save();
        return redirect()->route('tasks.index')->with('message', $request->task_name . ' Task Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message', $task->task_name . ' Task Deleted!');
    }
}
