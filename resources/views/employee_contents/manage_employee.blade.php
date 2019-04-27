<div class="modal inmodal fade" id="addCompany" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px"></h4>
               
            </div>
            <form method="POST" action="/company">
                {{ csrf_field() }}
                <div class="modal-body">
                   <div class="row">
                       <div class="col-lg-12">
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>