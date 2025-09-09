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

    input,
    p,
    td {
      font-size: 14px;
    }

    input {
      padding: 4px;
    }

    table {
      border-collapse: separate;
      border-spacing: 0 0.5em;
      width: 100%;
      line-height: 25px;
    }

    tr td {
      vertical-align: top;
    }

    ol {
      margin-left: 1.5rem;
      padding-left: 0;
      line-height: 20px;
    }

    ol li {
      margin-bottom: 1rem;
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
  <main style="max-width:720px; margin:40px auto;">
    <table cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" style="text-align:center; font-weight:700;">
          Request letter to Indian Mission for Foreign Employer (FE) Registration
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center; font-style:italic; ">
          (For Individual Employers desiring to employ Indian workers for domestic works. To be filled by the
          Employer...)<br />
          and uploaded online along with the supporting document at the time applying online through eMigrate System.
        </td>
      </tr>
      <tr>
        <td width="5%">1. I,</td>
        <td style="border-bottom:1px dotted #000;text-align:center;">
          {{ $candidate->passportDetail->fe_name }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center; font-style:italic; ">(Name of the Employer)</td>
      </tr>
      <tr>
        <td width="20%" style="text-align:center;font-style:italic;">
          National of
        </td>
        <td width="75%" style="border-bottom:1px dotted #000;text-align:center;">
          {{ $candidate->passportDetail->country->name }}
        </td>
        <td width="5%">
          and
        </td>

      </tr>
      <tr>
        <td colspan="2" style="font-style:italic; text-align:center">(Name of the country)</td>

      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="35%">having residential address at</td>
              <td width="65%" style="border-bottom:1px dotted #000;text-align: center">{{ 'PO BOX ' .
                $candidate->passportDetail->pobox
                . ', PC ' . $candidate->passportDetail->pin_code . ', ' . $candidate->passportDetail->country->capital .
                ' ' .
                $candidate->passportDetail->country->name }}</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-style:italic; text-align:center;">(Complete Address & Email)</td>
      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="20%">and having Personal Identification No</td>
              <td width="50%" style="border-bottom:1px dotted #000;text-align: center">{{
                $candidate->passportDetail->fe_no }}</td>
            </tr>
          </table>
        </td>

      </tr>
      <tr>
        <td colspan="2" style="font-style:italic;text-align:center; ">(Passport Number / National ID / Civil ID)</td>
      </tr>
      <tr>
        <td width="15%">issued by</td>
        <td width="85%" style="border-bottom:1px dotted #000;text-align: center">{{
          $candidate->passportDetail->country->name }}</td>
      </tr>
      <tr>
        <td colspan="2" style="font-style:italic;text-align:center;">(Issuing Authority)</td>
      </tr>
      <tr>
        <td colspan="2">hereby apply for registration of myself as Foreign Employer (FE) in the eMigrate System of Govt.
          of India, through Indian Mission in</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center;border-bottom:1px dotted #000;">
          {{ $candidate->passportDetail->country->capital. ', '. $candidate->passportDetail->country->name }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center; font-style:italic; ">(Name of the city and country where Indian
          Embassy/ Consulate is located)</td>
      </tr>
      <tr>

        <td colspan="2">2. I certify that the information provided in this Request Letter and in online application form
          is correct.
        </td>
      </tr>
      <tr>
        <td colspan="2">3. I undertake that I shall abide by the rules and regulations as required time to time by the
          eMigrate System or the Govt. of India.</td>
      </tr>
      <tr>
        <td colspan="2">4. I undertake that in case of any Indian worker employed by my, desires to go back to his/her
          country before completion of employment contract for any reason, I shall give the ‘No objection Certificate’
          or any other document as required, to the Indian Mission officials and to the government of my country, to
          facilitate the exit of the Indian employee.</td>
      </tr>
      <tr>
        <td colspan="2">5. I undertake that I shall not withhold/confiscate the passport, visa or the work permit
          belonging to the Indian worker, under any circumstances.</td>
      </tr>

      {{-- I undertake that I shall not withhold/confiscate the passport, visa or the work permit belonging to the
      Indian worker, under any circumstances. --}}
      <tr>
        <td colspan="2" style="text-align:right; font-style:italic;">(Contd)</td>
      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td style=" vertical-align: bottom;">Date</td>
              <td style="text-align: right;">
                <img src="{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}"
                  style="width:160px; height:100px; object-fit: contain;">
                <p>Signature of the Authorized Signatory</p>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
    <div class="page-break"></div>
    <table style="border-spacing: 0.2em">
      <tr>
        <td colspan="2">6. I undertake that I shall not falsely implicate any Indian worker and/or shall not register
          any false case with any govt. agency or the police against the Indian worker.</td>
      </tr>
      <tr>
        <td colspan="2">7. I undertake that once FE registration application submitted by me is approved, I shall not
          apply for the registration of the same organization again under any circumstances.</td>
      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="7%" style="vertical-align: bottom;"> Date:</td>
              <td width="43%" style="vertical-align: bottom;">{{ date('d-m-Y') }}</td>
              <td width="50%" style="text-align: right;">
                <img src="{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}"
                  style="width:160px; height:100px; object-fit: contain;">
                <p>Signature of the Employer</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="7%">Place:</td>
              <td width="53%" style="border-bottom:1px dotted #000;text-align:center;">{{
                $candidate->passportDetail->country->capital. ', '. $candidate->passportDetail->country->name }}</td>
              <td width="40%" style="padding-left: 30px">Name of the Employer</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-style:italic;">(Name of the City and Country)</td>
      </tr>
      <tr>
        <td colspan="2">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="50%"></td>
              <td width="50%" colspan="2"><strong>Contact Nos. of Authorized Signatory:</strong></td>
            </tr>
            <tr>
              <td width="50%"></td>
              <td width="10%">(Mobile)</td>
              <td width="40%" style="border-bottom:1px dotted #000;text-align:center;"></td>
            </tr>
            <tr>
              <td width="50%"></td>
              <td width="15%">Landline No</td>
              <td width="35%" style="border-bottom:1px dotted #000;text-align:center;"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-style:italic;">(One contact no. either mobile or landline is mandatory)</td>
      </tr>
      <tr>
        <td colspan="2"><strong>Important Notes:</strong></td>
      </tr>
      <tr>
        <td colspan="2">
          <ol>
            <li>This Request letter is required to be downloaded by the Employer from eMigrate website and filled-in
              completely with required information and signature etc. before start applying online for FE Registration
              on eMigrate.</li>
            <li>The completely filled in Request Letter is required to be uploaded by the Employer along with the other
              supporting document, at the time of online application.</li>
            <li>Employer is required to mention the date and sign both the pages of this Request letter as indicated.
            </li>
            <li>This Request Letter must be filled-in completely and in English Language only. In case the form is not
              filed completely or filled-in any language other than English, the Indian Mission officer, processing the
              FE registration application is directed to summarily reject the application for FE Registration.</li>
            <li>The content of this Request Letter shall not be altered or modified under any circumstance. Application
              for FE Registration, with altered/modified Request Letter shall be rejected summarily by the Indian
              Mission.</li>
          </ol>
        </td>
      </tr>
      <tr>
        <td colspan="2"><strong>List of Documents uploaded on eMigrate System along with FE Registration Application,
            are as under (Please tick box as applicable):</strong></td>
      </tr>
      <tr>
        <td colspan="2">
          <table>
            <tr>
              <td width="95%">Request Letter for FE Registration duly signed by Authorized Signatory/individual
                Employer. </td>
              <td width="5%"> <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;"></td>
            </tr>
            <tr>
              <td width="95%">Copy of Passport / Personal Identification Number / Civil Id issued by Govt. Authority in
                the name of Authorized Signatory. </td>
              <td width="5%"> <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;"></td>
            </tr>
            <tr>
              <td width="95%"> Copy of Address proof.</td>
              <td width="5%"> <img src="{{ public_path('images/checkbox.png') }}" style="width:16px; height:16px;"></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </main>
</body>

</html>