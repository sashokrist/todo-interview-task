@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Tasks</a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
