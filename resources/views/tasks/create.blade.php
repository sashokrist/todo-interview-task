@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'tasks.store', 'method' => 'POST']) !!}
                        {{ Form::label('title', 'Task title', ['class' => 'control-label']) }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Task title']) }}
                        {{ Form::date('datetime', \Carbon\Carbon::now()), ['class' => 'form-control'] }}
                        <button type="submit" class="btn btn-success form-control">Create Task</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
