<?php

namespace App\Http\Controllers;

use App\Models\Job;
//use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        // Fetch jobs with the employer relationship and paginate results
        $jobs = Job::with('employer')->latest()->paginate(3);

        // Pass the jobs data to the view
        return view('jobs.index', compact('jobs')); // 'jobs' should be passed correctly to the view
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
