<?php

namespace App\Http\Controllers;

use App\Models\Statuses;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statuses.index', ['statuses' => Statuses::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.create');
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
            'name' => 'required',
        ]);

        $status = new Statuses();
        $status->fill($request->all());
        $status->save();
        return redirect()->route('statuses.index')->with('message', $request->name . ' status Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statuses  $statuses
     * @return \Illuminate\Http\Response
     */
    public function show(Statuses $statuses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statuses  $statuses
     * @return \Illuminate\Http\Response
     */
    public function edit(Statuses $status)
    {
        return view('statuses.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statuses  $statuses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statuses $status)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $status->fill($request->all());
        $status->save();
        return redirect()->route('statuses.index')->with('message', $request->name . ' status Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statuses  $statuses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statuses $status)
    {
        if (count($status->tasks)) {
            return back()->withErrors(['error' => ['Can\'t delete status with tasks assigned, please unassign tasks first']]);
        }
        $status->delete();
        return redirect()->route('statuses.index')->with('message', $status->name . ' status Deleted!');
    }
}
