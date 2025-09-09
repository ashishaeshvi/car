<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Request Letter</title>
   <style>
      body {
         font-family: sans-serif;
         font-size: 16px;
         color: #333;
      }

      p {
         margin: 0px !important;
         padding: 0px !important;
      }

      input,
      p,
      td,
      span,
      div {
         font-size: 14px;
         line-height: 24px;
      }

      input {
         padding: 4px;
      }

      table {
         border-collapse: separate;
         border-spacing: 0 0.1mm;
         width: 100%;
      }

      tr td {
         vertical-align: top;
      }

      ol {
         margin-left: 1.5rem;
         padding-left: 0;
      }

      ol li {
         margin-bottom: 0.5rem;
      }

      .italic-center {
         text-align: center;
         font-style: italic;
      }

      .bold {
         font-weight: bold;
      }

      .page-break {
         page-break-before: always;
         /* or 'after' / 'inside' */
         break-before: page;
         /* Modern alternative */
      }
   </style>
</head>

<body>
   <div style="max-width: 767px; margin: auto">
      <table>
         <!-- Annexure B -->
         <tr>
            <td colspan="2" style="text-align: center; font-weight: 600; margin-bottom: 4px;">
               <strong>Annexure B</strong>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="text-align: center; font-weight: 600; margin-bottom: 4px;">
               <strong>Request letter for Registration as Foreign Employer (FE)/Foreign Recruiting Agent (FRA) to Indian
                  Mission</strong>
            </td>
         </tr>
         <tr>
            <td colspan="2" class="italic-center" style="margin-bottom: 24px;">
               (For companies/ LLCs/ partnership/ proprietorship/ govt. agencies desiring to employ Indian Manpower.
               To be printed on the letter head of the organization and filled by Authorized signatory himself/herself
               in his/ her own handwriting in English Language and uploaded along with other mandatory document at the
               time of submitting the online application.)
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="40px">1. I,</td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->sponsor_name }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Name of the Employer)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="100px">National of</td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->country->name }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Name of the country, to which Employer belongs)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="170px">Authorized signatory of</td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->fe_name }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Complete Name of The Organization, email Id, telephone No.)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="380px">having Company Registration No./ Trade License No.</td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->fe_no }}
                     </td>
                  </tr>

               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="200px">having registered office at </td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ 'PO BOX ' . $candidate->passportDetail->pobox . ', PC ' .
                        $candidate->passportDetail->pin_code . ', ' .
                        $candidate->passportDetail->country->capital . ', ' . $candidate->passportDetail->country->name
                        }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Complete Address of the Employer & email)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="270px">and having Personal Identification No </td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->sponsor_id }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Passport Number/ National Identification No./ Civil Id no. of Authorized signatory)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td width="80px">issued by </td>
                     <td style="border-bottom:1px dotted #000;text-align:center;">
                        {{ $candidate->passportDetail->country->name }}
                     </td>
                  </tr>
                  <tr>
                     <td class="italic-center" colspan="2">
                        (Passport Number/ National Identification No./ Civil Id no.)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <p>
                  hereby apply for registration of above said organization as Foreign Employer (FE) in the<br />
                  eMigrate System of Govt. of India, through Indian Mission in
               </p>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="text-align: right; font-style: italic;">(Contd.)</td>
         </tr>
         <tr>
            <td style="vertical-align: bottom">Date</td>
            <td style="text-align: right;">
               <img src="{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}"
                  style="width:160px; height:100px; object-fit: contain;margin-right:20px;">
               <p> Signature of the Authorized signatory </p>
            </td>
         </tr>
      </table>
      <div class="page-break"></div>
      <table>

         <tr>
            <td colspan="2">
               <table style="width: 100%; border-collapse: collapse;">
                  <tr>
                     <td colspan="2" style="text-align: center;border-bottom:1px dotted #000; ">
                        {{ $candidate->passportDetail->country->capital . ', ' .
                        $candidate->passportDetail->country->name }}
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" class="italic-center" style="padding-top:10px; ">
                        (Name of the city and country where Indian Embassy/ Consulate is located)
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               2. I certify that the information provided in this Request Letter and in online application form is
               correct.
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               3. I undertake that I shall abide by the rules and regulations as required from time to time by the
               eMigrate System or the Govt. of India.
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               4. I undertake that in case of any Indian worker employed by our organization, desires to go back to his/
               her country before completion of employment contract for any reason, I shall give the 'No objection
               Certificate' or any other document as required, to the Indian Mission officials or to the government of
               my country, to facilitate the exit of the worker.
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               6. I undertake that I shall not withhold/ confiscate the passport, visa or the work permit belonging to
               Indian worker, under any circumstances.
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               7. I undertake that I shall not falsely implicate Indian worker and/ or shall not register any false case
               with any govt. agency or the police against the Indian worker.
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-bottom: 8px;">
               8. I undertake that once FE registration application submitted by me is approved, I shall not apply for
               the registration of the same organization again under any circumstances.
            </td>
         </tr>

      </table>

      <!-- Date + Signature + Organization -->
      <div style="width: 100%; overflow: hidden; position: relative;">

         <!-- Left side (Date) -->
         <div style="float: left; width: 50%;padding-top:50px">
            <span style="display: inline-block; width: 50px;">Date</span>
            <span
               style="display: inline-block; border-bottom: 1px dotted #000; min-width: 150px; vertical-align: bottom;">
               {{ date('d-m-Y') }}
            </span>
         </div>

         <!-- Right side (Signature + Org Name) -->
         <div style="float: right; width: 50%; text-align: right;">
            <div style="width: 100%;">
               <div style="float: right; width:160px ;height:80px;background-image: url('{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: right top;
                    background-size: contain;">

               </div>

            </div>
            <div>
               <p style="padding-top:-40px">Signature of the Authorized signatory</p>
            </div>


         </div>


      </div>


      <div style="width: 100%;">
         <div style="float: left;width:50%;">
            <div style="padding-top:15px;">
               <span style="display: inline-block; width: 50px;">Place</span>
               <span style="display: inline-block; border-bottom: 1px dotted #000; min-width: 200px;">
                  {{ $candidate->passportDetail->country->capital . ', ' . $candidate->passportDetail->country->name }}
               </span>
            </div>
            <div style="font-style: italic; margin-top: 4px;">(Name of the City and Country)</div>
         </div>
         <div style="float: right;width:50%;text-align: right;padding-top:-40px">
            <div style="padding-top:0px">
               <p style="text-align:right;padding-top:40px">Name of the Organization</p>
            </div>
            <div style="width: 100%;padding-top:-30px">
               <div style="float:right;width:160px ;height:100px;background-image: url('{{ public_path('storage/'.$candidate->passportDetail->feStamp->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: right top;
                    background-size: contain;">
               </div>
            </div>


            <div>


               <div>
                  <div style="padding-top: -30px;">
                     <div style="margin-top: 2px;">Official Seal/ stamp</div>
                  </div>
                  <div>Contact Nos. Authorized Signatory</div>
                  <div style=" text-align: right;">
                     <div>
                        <span style="display: inline-block; width: 60px;">(Mobile)</span>
                        <span
                           style="display: inline-block; border-bottom: 1px dotted #000; min-width: 200px; text-align: left;">
                           {{ $candidate->passportDetail->country->phonecode }}-{{
                           $candidate->passportDetail->fe_phone_no }}
                        </span>
                     </div>

                     <div style="">
                        <span style="display: inline-block; width: 60px;">Landline No</span>
                        <span style="display: inline-block; border-bottom: 1px dotted #000; min-width: 200px;"></span>
                     </div>

                     <div style="font-style: italic;">
                        (One contact no. either mobile or Landline no. is Mandatory)
                     </div>
                     <div>(Contd.)</div>
                  </div>
               </div>
            </div>
         </div>
      </div>







      <!-- Bottom Signature (if needed again) -->
      <div style="width: 100%; overflow: hidden;">
         <div style="float: left; width: 50%; vertical-align: bottom;padding-top:40px">
            <span style="display: inline-block; width: 50px;">Date</span>
            <span
               style="display: inline-block; border-bottom: 1px dotted #000; min-width: 150px; vertical-align: bottom;">
               {{ date('d-m-Y') }}
            </span>
         </div>
         <div style="float: right; width: 50%; text-align: right;">
            <div style="width:100% ">
               <div style="float: right; width:160px ;height:80px;background-image: url('{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: right top;
                    background-size: contain;">

               </div>
            </div>
            <div>
               <p style="padding-top: -40px">Signature of the Authorized signatory</p>
            </div>
         </div>
      </div>



      <div class="page-break"></div>
      <div style="width: 100%; overflow: hidden; margin-bottom: 16px;">
         <div style="float: left;width: 50%;">
            <strong>Important Instructions: -</strong>
         </div>
         <div style="float: right;width: 50%; text-align: right;">
            <strong style="text-decoration: underline">Annexure</strong>
         </div>
      </div>

      <div style="padding-bottom: 8px; text-indent: -20px; padding-left: 20px;">
         1. This Request letter is required to be downloaded by the Employer from eMigrate website and filled-in
         completely with required information and signature etc. before start applying online for FE Registration
         on eMigrate.
      </div>

      <div style="padding-bottom: 8px; text-indent: -20px; padding-left: 20px;">
         2. The completely filled in Request Letter is required to be uploaded by the Employer along with the
         other supporting document, at the time of online application.
      </div>

      <div style="padding-bottom: 8px; text-indent: -20px; padding-left: 20px;">
         3. Authorized Signatory is required to mention the date and sign all three pages of this Request letter
         as indicated.
      </div>

      <div style="padding-bottom: 8px; text-indent: -20px; padding-left: 20px;">
         4. This Request Letter must be filled-in completely and in English Language only. In case the form is not
         filled completely or filled-in any language other than English, the Indian Mission officer, processing
         the FE registration application shall summarily reject the application for FE Registration.
      </div>

      <div style="padding-bottom: 8px; text-indent: -20px; padding-left: 20px;">
         5. The content of this Request Letter shall not be altered or modified under any circumstance.
         Application for FE Registration, with altered/ modified Request letter shall be rejected summarily by the
         Indian Mission.
      </div>

      <div style="font-weight: 700; margin-top: 16px; margin-bottom: 16px;">
         List of Documents uploaded on eMigrate System along with FE Registration Application, are as under
         (Please tick box as applicable)
      </div>

      <!-- Document list -->
      <div style="margin-bottom: 8px; overflow: hidden;">
         <div style="float: left; width: 95%;">1. Copy of Company Registration Certificate/ Trade License.</div>
         <div style="float: right; width: 5%; text-align: right;">
            <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;">
         </div>
      </div>

      <div style="margin-bottom: 8px; overflow: hidden;">
         <div style="float: left; width: 95%;">2. Request Letter for FE Registration duly signed by the
            Authorized Signatory of the organization.</div>
         <div style="float: right; width: 5%; text-align: right;">
            <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;">
         </div>
      </div>

      <div style="margin-bottom: 8px; overflow: hidden;">
         <div style="float: left; width: 95%;">3. Copy of Passport / Personal Identification Number / Civil Id
            issued by Govt. Authority in the name of Authorized Signatory.</div>
         <div style="float: right; width: 5%; text-align: right;">
            <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;">
         </div>
      </div>

      <div style="margin-bottom: 8px; overflow: hidden;">
         <div style="float: left; width: 95%;">
            4. Copy of Address proof on Organization Letterhead.<br />
            <span style="padding-left: 16px; font-style: italic;">(Required only in case of Govt.
               Agency not having Registration Certificate)</span>
         </div>
         <div style="float: right; width: 5%; text-align: right;">
            <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;">
         </div>
      </div>

      <hr style="border: 1px solid black; margin-top: 24px; margin-bottom: 8px;" />

      <!-- Date + Signature -->
      <div style="width: 100%; overflow: hidden;">
         <div style="float: left; width: 50%;padding-top:50px;">
            <span style="display: inline-block; width: 50px;">Date</span>
            <span
               style="display: inline-block; border-bottom: 1px dotted #000; min-width: 150px; vertical-align: bottom;">
               {{ date('d-m-Y') }}
            </span>
         </div>
         <div style="float: right; text-align: right; width: 50%;">

            <div style="width:100% ">
               <div style="float: right; width:160px ;height:80px;background-image: url('{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: right top;
                    background-size: contain;">

               </div>
            </div>
            <div>
               <p style="padding-top: -40px;">Signature of the Authorized signatory</p>
            </div>
         </div>
      </div>

   </div>
</body>

</html>