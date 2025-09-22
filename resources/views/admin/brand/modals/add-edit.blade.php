<div class="modal fade" id="brandModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle">Add {{ $create_title }}</h4>
        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('brand.store') }}" id="brandForm" autocomplete="off"
        enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container d-flex justify-content-center">
            <div class="w-100" style="max-width: 400px;">
              <div class="row">
                <input type="hidden" name="id" id="editId" value="">
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control"
                       name="name" id="Name" placeholder="Name"
                      value="" autocomplete="off" required>
                    <span class="name_err text-danger error"></span>
                  </div>
                </div>
                <div class="col-12" >
                  <div class="form-group">
                    <label>Image </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input  preview-image" data-preview="#showImg"
                          id="image" name="brandImg" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="image">Upload Brand</label>
                      </div>
                    </div>
                    <span class="image_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 1MB</small>
                    <span id="showImg"></span>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default custom-close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.modal -->