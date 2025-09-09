<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit User Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="editUserForm" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        <input type="hidden" name="id" id="userId">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label>User Type</label><span class="text-danger">*</span>
                <select class="form-control" name="role_id" id="roleId">
                  <option value="">Select User Type</option>
                  @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                  @endforeach
                </select>
                <span class="role_id_err text-danger error"></span>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="name" id="userName" placeholder="Name"
                  value="{{{ old('name') }}}" autocomplete="off" required>
                <span class="name_err text-danger error"></span>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Email Id</label><span class="text-danger">*</span>
                <input type="email" class="form-control" name="email" id="userEmail" placeholder="Email Id"
                  value="{{{ old('email') }}}" autocomplete="off" required>
                <span class="email_err text-danger error"></span>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Mobile Number</label><span class="required"></span>
                <input type="text" class="form-control" name="mobile" id="userMobile" maxlength="10"
                  placeholder="Mobile Number" value="{{{ old('mobile') }}}" autocomplete="off">
                <span class="mobile_err text-danger error"></span>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label for="enablePasswordEdit">
                  <input type="checkbox" id="enablePasswordEdit" onchange="toggleShowPassword('Edit')"> Set Password
                </label>
                <label for="passwordEdit">Password <span class="required">*</span></label>
                <div style="position: relative;">
                  <input type="password" class="form-control pr-5" id="passwordEdit" name="password" maxlength="15"
                    placeholder="Password" disabled>
                  <span onclick="togglePassword('Edit')" id="toggleIconEdit" class="eye-icon">👁️</span>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Address</label><span class="required"></span>
                <textarea class="form-control" name="address" id="userAddress" placeholder="Address"
                  autocomplete="off">{{{ old('address') }}}</textarea>
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label>Upload ID Proof</label><br />
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input preview-image" data-preview="#editIdProofImg"
                      id="edit_id_proof" name="id_proof" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                    <label class="custom-file-label" for="edit_id_proof">Upload File</label>
                  </div>
                </div>
                <span class="id_proof_err text-danger error"></span>
                <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                <span id="editIdProofImg"></span>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <label>Upload Profile Image</label><br />
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input preview-image" data-preview="#editProfileImgPreview"
                      id="edit_profile_image" name="profile_image" accept=".png, .jpg, .jpeg" style="cursor: pointer;">
                    <label class="custom-file-label" for="edit_profile_image">Upload File</label>
                  </div>
                </div>
                <span class="profile_image_err text-danger error"></span>
                <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                <span id="editProfileImgPreview"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->