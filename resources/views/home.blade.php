@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        <br />
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <br>

            @foreach($comments as $comment)
                <div class="card">
                    <div class="card-header">{{$comment->author_name}}</div>

                    <div class="card-body">
                        {{$comment->comment_text}}
                    </div>
                </div>
            @endforeach
        </div>


    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('comment.store') }}">
            <div class="form-group">
                @csrf
                <label for="comment">Comment:</label>
                <textarea type="text" class="form-control p-1" name="comment_text" id="comment"></textarea>
                <input type="hidden" class="form-control p-1" name="author_id" id="author_id" value="{{Auth::id()}}"/>
                <input type="hidden" class="form-control p-1" name="author_name" id="author_name" value="{{Auth::user()->name}}"/>
            </div>
            <button type="submit" class="btn btn-primary">Add comment</button>
        </form>
    </div>
</div>
@endsection
