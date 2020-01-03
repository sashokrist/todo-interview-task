<?php

namespace App\Http\Controllers;

use App\Mail\UpdateMail;
use App\Mail\WelcomeMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->name;
        $id = auth()->user()->id;

        $tasks = Task::where('user_id', $id)->paginate(5);
        $trashed = Task::onlyTrashed()->get();
       // dd($trashed);
        return view('tasks.index', compact(['tasks', 'user', 'trashed']));
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
       // return $request;
        $this->validate($request, [
           'title' => 'required|string|max:255|min:5',
           'datetime' => 'required|date'
        ]);

        $task = new Task;

        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->datetime = $request->datetime;

        $task->save();

        Mail::to(auth()->user()->email)->send(new WelcomeMail(auth()->user()->name));

        Session::flash('success', 'Task was created and email was sent to the user');
        return redirect()->route('tasks.index');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255|min:5',
            'datetime' => 'required|date'
        ]);

        $task = Task::find($id);

        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->datetime = $request->datetime;

        $task->save();

        Mail::to(auth()->user()->email)->send(new UpdateMail(auth()->user()->name));

        Session::flash('success', 'Task was update');
        return redirect()->route('tasks.index');
    }


    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        Session::flash('success', 'Task was deleted');
        return redirect()->route('tasks.index');

    }

    public function restore($id)
    {
       // dd($id);
        Task::withTrashed()->find($id)->restore();
        Session::flash('success', 'Task was restored');
        return redirect()->route('tasks.index');
    }
}
