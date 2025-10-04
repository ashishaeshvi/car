 <div class="cts-model cts-type-2">
     <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4>Login to CarkeMaalik</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="login-signup" id="otp-section">
                         <form method="POST" action="{{ route('frontend.send.otp') }}" id="addUserForm" autocomplete="off">
                             @csrf
                             <div class="form-group">
                                 <input type="text" name="contact_number" id="contact_number" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric" maxlength="10" class="form-control" placeholder="Contact Number" required>
                             </div>
                             <div class="login-cta mt-3">
                                 <button type="submit" class="btn btn-default btn-block">Get OTP</button>
                             </div>
                         </form>
                     </div>

                     <div  id="verify-section" style="display:none;">
                         <form method="POST" action="{{ route('frontend.verify.otp') }}" id="verifyOtpForm" autocomplete="off">
                             @csrf
                             <div class="form-group mt-3 d-flex justify-content-center gap-2">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                 <input type="text" maxlength="1" class="otp-input form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                             </div>
                             <!-- Hidden input to store full OTP -->
                             <input type="hidden" name="otp_code" id="otp_code">
                             <input type="hidden" name="contact_number" id="contactNumber" class="form-control" placeholder="Contact Number" required>
                             <div class="login-cta mt-3 d-flex justify-content-between">
                                 <button type="submit" class="btn btn-success" id="verifyOtpBtn">Verify OTP</button>
                                 <button type="button" class="btn btn-link" id="resendOtpBtn">Resend OTP</button>
                             </div>
                         </form>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </div>
 <style>
     .otp-input {
         width: 50px;
         font-size: 20px;
         text-align: center;
         margin: 0 5px;
     }
 </style>
 @section('scripts')

 @endsection