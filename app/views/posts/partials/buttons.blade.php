{{--form buttons--}}
<div class="button-panel" id="post-buttons">
    <small>Admin Panel</small><br />
    <div class="btn-group">
        <button class="btn btn-success" id="form-submit"><span class="glyphicon glyphicon-ok"></span> Save</button>
        <a href="{{action('PostController@index')}}" class="btn btn-warning disabled" id="form-cancel"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
        @if($delete == true)
            <a href="{{url('news/'.$slug.'/delete')}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        @endif
    </div>
</div>