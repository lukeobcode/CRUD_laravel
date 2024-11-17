<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Job $job) {
        $jobs = Job::with('employer')->latest()->paginate(3);    // implement eager loading   paginate = display in pages

        return view("jobs.index", [
            'jobs' => $jobs
        ]);
    }

    public function create() {
        return view('jobs.create');

    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);
    }

    public function store() {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 2
        ]);
        return redirect('/jobs');
    }

    public function edit(Job $job) {
        //$job = Job::find($job);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job) {
        // authorize (On hold...)
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        //$job = Job::findOrFail($job);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job) {
        //$job = Job::findOrFail($id);
        $job->delete();

        return redirect('/jobs');
    }

}
