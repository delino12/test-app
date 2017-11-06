@extends('layouts.app')

@section('content')
    <div class="container" style="color:#000;">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p>Create a Post</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                @if(session('post-status'))
                                  <p class="text-success">{{ session('post-status') }}</p>  
                                @endif
                                <span style="display: none;" id="post_status"></span>
                                <form method="post" action="" onsubmit="return sendPost()" id="post-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" cols="10" placeholder="type a message.." id="body" required=""></textarea>
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
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Timeline
                    </div>
                    <div class="panel-body">
                        <div class="posts-info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    Echo.channel('newest-post')
    .listen('NewestPost', function(e){
        console.log(e);
        var container = $(".posts-info");
        var markup = `<p style="color: red"><i class="fa fa-user"></i> `+ e.username +`</p>
                <p>`+ e.body +`</p>
                <p class="small">`+e.time+`</p>
                <hr />`;
        container.prepend(markup);
    });
</script>
@endpush