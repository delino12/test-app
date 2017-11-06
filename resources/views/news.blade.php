@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <form method="post" action="#" onsubmit="return postNews()">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea class="form-control" rows="2" cols="10" placeholder="type your message" id="msg" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
