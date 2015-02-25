<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Post</h4>
            </div>
            {{Form::model($post, array('method' => 'DELETE', 'route' => array('news.destroy', $post->id)))}}
            {{Form::hidden('id', $post->id)}}
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong>This cannot be undone!</strong>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>