@extends('layouts.backend')

@section('content')
    <div class="main-inner">
        <!-- *** Page title *** -->
        <div class="page-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner">
                        Edit New Use
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit New Use</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-create" id="form-create">
            <div class="row">
                <div class="col-12">
                    <div class="card-table">
                        <div class="card">
                            <div class="card-body">
                                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                                <div class="mt-4 row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold">Username:</label>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="font-weight-bold">Email:</label>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="Password" class="font-weight-bold">Password:</label>
                                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="Role" class="font-weight-bold">Role:</label>
                                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple')) !!}
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
