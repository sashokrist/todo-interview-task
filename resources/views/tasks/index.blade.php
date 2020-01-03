@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Index page</div>

                    <div class="card-body">
                        <div class="col-md-6">
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
                        </div>
                        @if($tasks->count() == 0)
                            <p>No tasks added.</p>
                            @endif
                        @foreach($tasks as $task)
                           <h2>{{ $task->title }}</h2> <br>
                           Datetime: {{ $task->datetime }}<br>
                        Published by: <p>{{ $user }}</p>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <hr>
                            @endforeach
                        {{ $tasks->links() }}
                        <div class="col-md-6">
                            <h3>Trashed</h3>
                            @foreach($trashed as $item)
                            {{ $item->title }}<br>
                            {{ $item->datetime }}<br>
                                <form action="{{ route('tasks/restore', $item->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Restore</button>
                                </form>
                                <hr>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
