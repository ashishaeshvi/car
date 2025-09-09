<div class="modal fade" id="FeDocumentModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle">Add {{ $create_title }}</h4>
        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('fe-document.store') }}" id="FeDocumentForm" autocomplete="off"
        enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container d-flex justify-content-center">
            <div class="w-100" style="max-width: 400px;">
              <div class="row">
                <input type="hidden" name="id" id="feEditId" value="">
                <input type="hidden" name="type" id="feType" value="">
                <div class="col-12">
                  <div class="form-group">
                    <label for="fe_name"><span id="feTitle"></span><span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-uppercase"
                      oninput="this.value = this.value.toUpperCase();" name="name" id="FeName" placeholder="Fe Name"
                      value="" autocomplete="off" required>
                    <span class="name_err text-danger error"></span>
                  </div>
                </div>
                <div class="col-12" id="signDiv">
                  <div class="form-group">
                    <label>Fe Sign <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input  preview-image" data-preview="#FeSignImg"
                          id="fe_sign" name="fe_sign" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="fe_sign">Upload Sign</label>
                      </div>
                    </div>
                    <span class="fe_sign_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="FeSignImg"></span>
                  </div>
                </div>
                <div class="col-12" id="stampDiv">
                  <div class="form-group">
                    <label>Fe Stamp <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input  preview-image" data-preview="#FeStampImg"
                          id="fe_stamp" name="fe_stamp" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="fe_stamp">Upload Stamp</label>
                      </div>
                    </div>
                    <span class="fe_stamp_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="FeStampImg"></span>
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