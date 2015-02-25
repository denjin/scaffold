<div class="well well-sm">
        <h1><a href="{{url('news/'.$slug)}}">{{{$title}}}</a></h1>
        @include('partials.timestamps', array('author' => $post->user->username, 'created_at' => $post->created_at, 'updated_at' => $post->updated_at))
        <small class="text-muted">{{{$body}}}</small><br />
        <a href="{{url('news/'.$slug)}}" class="btn btn-default btn-sm">Read More</a>
</div>