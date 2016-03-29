@extends('layouts.app')

@section('content')
<div id="main" class="container">

</div>

<!-- JavaScripts or Templates -->

<script id="mainTemplate" type="text/template">
    <div class="row">
        <div class="three columns"></div>
        <div class="six columns">
            <div class="row">
                <div class="twelve columns" id="add-post"></div>
            </div>
            <div class="row">
                <div class="twelve columns" id="all-posts"></div>
            </div>
        </div>
        <div class="three columns"></div>
    </div>
</script>

<script id="addPostTemplate" type="text/template">
    <form action="">
        <input id="new-post" placeholder="What's on your mind?">
        <input type="submit" value="Post">
    </form>
</script>

<script id="postTemplate" type="text/template">
    <span><%= post_content %></span>
</script>

@endsection


<!--

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

-->