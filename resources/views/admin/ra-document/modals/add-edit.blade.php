<div class="modal fade" id="addRADocumentModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle">Add {{ $create_title }}</h4>
        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('ra-document.store') }}" id="RADocumentForm" autocomplete="off"
        enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container d-flex justify-content-center">
            <div class="" style="">
              <div class="row">
                <input type="hidden" name="id" id="raEditId" value="">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="agency_name">Agency Name <span class="text-danger ">*</span></label>
                    <input type="text" class="form-control text-uppercase" name="agency_name" id="raAgencyName"
                      placeholder="Agency Name" value="" maxlength="200" autocomplete="off">
                    <span class="agency_name_err text-danger error"></span>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="registration_no">Registration No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-uppercase" name="registration_no" id="registrationNo"
                      placeholder="Registration No" value="" autocomplete="off" minlength="10" maxlength="60">
                    <span class="registration_no_err text-danger error"></span>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="ra_name">RA Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-uppercase" name="ra_name" id="raName"
                      placeholder="RA Name" value="" autocomplete="off" minlength="3" maxlength="60">
                    <span class="ra_name_err text-danger error"></span>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="ra_name_hindi">RA Name Hindi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-uppercase" name="ra_name_hindi" id="raNameHindi"
                      placeholder="RA Name Hindi" value="" autocomplete="off" minlength="3" maxlength="100">
                    <span class="ra_name_hindi_err text-danger error"></span>
                  </div>
                </div>


                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>RA Sign <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" id="ra_sign"
                          data-preview="#RaSignImg" name="ra_sign" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="ra_sign">Upload Sign</label>
                      </div>
                    </div>
                    <span class="ra_sign_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="RaSignImg"></span>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>RA Stamp <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#RaStampImg"
                          id="ra_stamp" name="ra_stamp" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="ra_stamp">Upload Stamp</label>
                      </div>
                      <span class="ra_stamp_err text-danger error"></span>
                    </div>

                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="RaStampImg"></span>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Scan Document <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#scanNotaryImg"
                          id="scan_notary" name="scan_notary[]" accept=".png, .jpg, .jpeg" style="cursor: pointer;"
                          multiple>
                        <label class="custom-file-label" for="scan_notary">Upload Scan Document</label>
                      </div>
                    </div>
                    <span class="scan_notary_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="scanNotaryImg"></span>
                  </div>
                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Affidavit Document <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#affidavitNotaryImg"
                          id="affidavit_notary" name="affidavit_notary[]" accept=".png, .jpg, .jpeg"
                          style="cursor: pointer;" multiple>
                        <label class="custom-file-label" for="affidavit_notary">Upload Affidavit Document</label>
                      </div>
                    </div>
                    <span class="affidavit_notary_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="affidavitNotaryImg"></span>
                  </div>
                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Letterpad Header<span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#LetterpadLogoImg"
                          id="letterpad_logo" name="letterpad_logo" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                        <label class="custom-file-label" for="letterpad_logo">Upload Header</label>
                      </div>
                    </div>
                    <span class="letterpad_logo_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="LetterpadLogoImg"></span>
                  </div>
                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Letterpad Footer <span class="text-danger editmodal">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input preview-image" data-preview="#LetterpadFooterImg"
                          id="letterpad_footer" name="letterpad_footer" accept=".png, .jpg, .jpeg"
                          style="cursor: pointer;">
                        <label class="custom-file-label" for="letterpad_footer">Upload Footer</label>
                      </div>
                    </div>
                    <span class="letterpad_logo_err text-danger error"></span>
                    <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                    <span id="LetterpadFooterImg"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control text-uppercase" name="address" id="raAddress"
                      autocomplete="off"></textarea>
                    <span class="address_err text-danger error"></span>
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
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->