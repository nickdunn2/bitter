@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form id="addPost" action="">
                <input id="newPost" type="text" placeholder="What's on your mind?">
                <input type="submit" value="Post">
            </form>

            <div id="posts">
                <script type="text/template" id="postTemplate">
                    <span><%= post_content %></span>
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
