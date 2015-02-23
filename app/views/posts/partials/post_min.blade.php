<div class="row">
    <div class="row">
        <h1><a href="{{url('news/'.$slug)}}">{{{$title}}}</a></h1>
    </div>
    <div class="row">
        @include('partials.timestamps', array('author' => $post->user->username, 'created_at' => $post->created_at, 'updated_at' => $post->updated_at))
    </div>
    <div class="row">
        <small class="text-muted">{{{$body}}}</small>
    </div>
    <div class="row">
        <a href="{{url('news/'.$slug)}}" class="btn btn-default btn-sm">Read More</a>
    </div>
    <hr>
</div>