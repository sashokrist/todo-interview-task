@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Task</div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="Post">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="title">Task Title</label>
                                <input type="text" name="title" value="{{ $task->title }}" class="form-control" id="title"  placeholder="Task title">
                            </div>
                            <div class="form-group">
                                <label for="datetime">Password</label>
                                <input type="date" name="datetime" value="$task->datetime" class="form-control" id="datetime" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
