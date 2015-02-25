<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Contact</h4>
                </div>
                {{--form--}}
                {{Form::open(array('url'=>'contact', 'id'=>'contact-form'))}}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Phone Number:</label>
                        <input type="text" id="phone-number" name="phone-number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="body">Message:</label>
                        <textarea id="body" name="body" class="form-control" rows="6"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Send</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>