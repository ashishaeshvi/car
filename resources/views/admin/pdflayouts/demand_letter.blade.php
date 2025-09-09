<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Demand Letter (Table Format)</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 8px;
      color: #333;
    }

    input,
    p,
    td {
      font-size: 10px;
    }

    input {
      padding: 20px !important;
    }

    table {
      border-collapse: separate;
      border-spacing: 0 1.3em;

    }

    div {
      display: block;
      page-break-inside: avoid;
    }
  </style>
</head>

<body>
  <div style="max-width: 768px; margin: auto;">
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <td colspan="2" style="text-align: center; font-weight: bold; font-size: 12px; padding-bottom: 12px;">
          <div style="border-bottom: 2px solid #000;">Demand Letter</div>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center; padding-bottom: 12px;">
          (To be printed on letter head of the Foreign Employer. Employers in individual category shall be required to
          print it on plain paper)
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">To,</td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">{{ $candidate->passportDetail->fe_name }}</td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">CRNo./TradeLicense/ Personal {{ $candidate->passportDetail->fe_no
          }}</td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">
          Address: PO BOX {{ $candidate->passportDetail->pobox }}, PC {{ $candidate->passportDetail->pin_code }}, {{
          $candidate->passportDetail->country->capital }}<br />
          {{ $candidate->passportDetail->country->name }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">
          Contact No.: {{ $candidate->passportDetail->country->phonecode }}-{{ $candidate->passportDetail->fe_phone_no
          }}<br />
          Email ID: work.emigrate@gmail.com
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">
          FE ID (as per eMigrate system): {{ $candidate?->emigrate_fe_id ?? 'N/A' }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-bottom: 4px;">
          Dear Sir / Madam,<br />
          The Recruiting Agent M/s. {{ $candidate->passportDetail->raDocument->agency_name }} in eMigrate system, as
          chosen by you for the purpose of recruitment of Indian workers / personnel as per the following details-
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <table
            style="width: 100%; border: 1px solid black; font-size: 9px; border-collapse: collapse; margin-bottom: 12px;">
            <thead>
              <tr>
                <th
                  style="border: 1px solid black; padding: 6px 4px; text-align: center; background: rgb(239, 239, 255);">
                  Sr. No.</th>
                <th
                  style="border: 1px solid black; padding: 6px 4px; text-align: center; background: rgb(239, 239, 255);">
                  Job Role</th>
                <th
                  style="border: 1px solid black; padding: 6px 4px; text-align: center; background: rgb(239, 239, 255);">
                  No. of Personnel required</th>
                <th
                  style="border: 1px solid black; padding: 6px 4px; text-align: center; background: rgb(239, 239, 255);">
                  Salary Offered</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid black; padding: 6px 4px; text-align: center;">1</td>
                <td style="border: 1px solid black; padding: 6px 4px; text-align: center;">{{
                  $candidate->passportDetail->job }}</td>
                <td style="border: 1px solid black; padding: 6px 4px; text-align: center;">{{
                  $candidate->passportDetail->vacancy }}</td>
                <td style="border: 1px solid black; padding: 6px 4px; text-align: center;">{{
                  $candidate->passportDetail->salary }}</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="font-weight: bold;">Terms and conditions of demand letter:</td>
      </tr>
      <tr>
        <td colspan="2">
          a. Transport facility will be provided to the worker / employee from residence to the workplace.<br />
          b. Paid Leaves (annual / medical etc) will be provided to worker / employee as per the Employment
          Contract.<br />
          c. Free Food or Food Allowance will be provided to the worker / employee.<br />
          d. Free Accommodation or Accommodation Allowance will be provided to the worker / employee.<br />
          e. Overtime allowance will be provided to the worker / employee as per the Employment Contract.<br />
          f. Visa will be provided to the worker / employee at cost of Employer.<br />
          g. Weekly off will be provided to the worker / employee.<br />
          h. To and fro air ticket will be provided for joining and going back after completion of contract.<br />
          i. Adequate Life Insurance will be provided to the worker / employee during the Employment at the cost of
          Employer.<br />
          j. Adequate medical facility will be provided to the worker / employee at the cost of Employer.<br />
          k. In case of death of the Worker / Employee, the employer shall transport the mortal remains to India and
          complete necessary formalities.
        </td>
      </tr>

      <tr>
        <td colspan="2" style="padding-top: 8px;">1. By submitting demand in eMigrate system of Ministry of External
          Affairs, Chanakya Puri, New Delhi, India, you agree that you have a valid labour quota to import workers from
          India as per the details given in demand application.</td>
      </tr>
      <tr>
        <td colspan="2">2. By submitting demand in eMigrate system, you agree that there shall be no misuse of the
          aforesaid demand letter. The FE and RA shall be responsible to ensure the same as per Indian Laws.</td>
      </tr>
      <tr>
        <td colspan="2">3. By submitting demand in eMigrate system, you also certify that the same set of demand shall
          not be given to any other Indian Recruiting Agent by way of online or any other means for recruitment.</td>
      </tr>
      <tr>
        <td colspan="2">4. This demand letter shall not be sent to anyone either through email or post or by any other
          means except to Govt. Authorities or to the Authorized Signatory of Recruiting Agency (RA), you have chosen
          for the recruitment. This letter cannot be further shared with anyone by the selected RA except uploading it
          on eMigrate system wherever required.</td>
      </tr>
      <tr>
        <td colspan="2">5. FE is required to sign the demand letter and send it to RA so the RA shall sign the same and
          upload it on eMigrate at the time of acknowledgement of the demand.</td>
      </tr>
      <tr>
        <td colspan="2">6. Designated RA shall be required to verify the copy of approval of the local govt. uploaded by
          the FE in this application for recruiting the Indian Worker. Demand submitted by FE shall be approved in the
          eMigrate system after RA acknowledges the same after due verification.</td>
      </tr>
      <tr>
        <td colspan="2">7. In case FE's submission of demand is disproportionate to the valid quota available to him for
          recruiting Indian Workers or violating any of the above terms and conditions, eMigrate login account of such
          FE shall be blocked without any prior notice and further recruitment shall be suspended.</td>
      </tr>
    </table>

    <div style=" text-align: right; width: 100%;">
      <div style="display: flex; justify-content: space-between; align-items: end; width: 100%;">
        @if ($candidate->passportDetail->individual_or_company == 'individual')
        <img src="{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}"
          style="width:160px; height:auto;max-height:120px; object-fit: contain;">
        @else
        <img src="{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}"
          style="width:160px; height:auto;max-height:120px; object-fit: contain;">
        <img src="{{ public_path('storage/'.$candidate->passportDetail->feStamp->attachment) }}"
          style="width:160px; height:auto;max-height:120px; object-fit: contain;">
        @endif
      </div>

      <div style="padding-top: -20px; text-align: right;">
        Signature of Authorised Signatory of FE <br />
        (along with the stamp of the organization and date & place)
      </div>
    </div>

    <div style="margin-top:20px;  text-align: right; width: 100%;">
      <div style="display: flex; justify-content: space-between; align-items: end; width: 100%;">
        <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_sign) }}"
          style="width:160px;height:auto;max-height:120px; object-fit: contain; margin-right:20px;">
        <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_stamp) }}"
          style="width:160px;height:auto;max-height:120px; object-fit: contain;">
      </div>

      <div style="padding-top: -20px; text-align: right;">
        Signature of Authorised Signatory of RA <br />
        (along with the stamp of RA and date & place)
      </div>
    </div>


  </div>
</body>

</html>