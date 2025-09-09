<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Power of Attorney (Full TR-TD Structure)</title>

  <style>
    body {
      font-family: sans-serif;
      color: #333;
    }

    h1 {
      font-size: 18px;
      text-align: center;
      margin-bottom: 30px;
    }

    p {
      margin: 0;
      padding: 0;
    }

    tr {
      margin: 15px;
      padding: 10px;
    }

    input,
    p,
    td {
      font-size: 12px;
      line-height: 1.3;
    }

    input {
      padding: 20px !important;
    }

    table {
      border-collapse: separate;
      border-spacing: 0 1em;
    }

    div {
      display: block;
    }

    tr td>span {
      display: inline-block !important;
      font-weight: bold !important;
      font-size: 12px !important;
    }
  </style>

</head>

<body>
  <table style="width: 100%; border-collapse: collapse; max-width: 800px; margin: auto;">

    <tr>
      <td style="text-align: center; text-decoration: underline;">
        <h3>
          POWER OF ATTORNEY
        </h3>
      </td>
    </tr>

    <tr>
      <td style="text-align: center;">
        (To be printed on letter head of the Foreign Employer. Employers in individual category shall be required to
        print it on plain paper)
      </td>
    </tr>

    <tr>
      <td>KNOW ALL MEN BY THESE PRESENTS:</td>
    </tr>

    <tr>
      <td style="padding-top:10px;">


        I, {{ $candidate->passportDetail->individual_or_company == 'individual' ? $candidate->passportDetail->fe_name :
        $candidate->passportDetail->sponsor_name }} of legal age
        <span style="border-bottom:1px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->fe_age }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        & nationality of
        <span style="border-bottom:1px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->country->name }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        with office address at P.O.Box No.
        <span style="border-bottom:1px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->pobox }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        in my capacity as
        <span style="border-bottom:1px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->vacancy }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        of
        <span style="border-bottom:0px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->fe_name }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>

        do hereby appoint, name and constitute: M/S.
        <span style="border-bottom:0px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->raDocument->agency_name }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>

        with office address at
        <span style="border-bottom:0px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->raDocument->address }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>

        represented in this act by
        <span style="border-bottom:0px dotted #000">
          &nbsp;&nbsp;&nbsp;&nbsp; {{ $candidate->passportDetail->raDocument->ra_name }} &nbsp;&nbsp;&nbsp;&nbsp;
        </span>

        as our true and legal representative to act for and in our name and stead to perform the following acts:
      </td>
    </tr>

    <!-- Start Powers -->
    <tr>
      <td style="padding-top: 10px;">1. To recruit and engage Indian nationals on behalf of the employer.</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Shall be revocable on completion of the services and return to India of the
        employees recruited by the employer.</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Can be terminated on giving one month's notice to one party by the other (Subject
        to 2a).</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Power of Attorney shall be valid for the period of two years from the date of issue
        of this document (Subject to 2a).</td>
    </tr>

    <tr>
      <td>2. To act on behalf of the employer in respect of such selection and travel matters pertaining thereto
        including dealing with the Protector of Emigrants, Government of India. This Power of Attorney :</td>
    </tr>
    <tr>
      <td>3. To represent our company before any and all Government and private offices/agencies in India.</td>
    </tr>
    <tr>
      <td>4. To conduct the recruitment-related activities i.e., hiring and placement of Indian workers for overseas
        employment.</td>
    </tr>
    <tr>
      <td>5. To recruit Indian workers as per the employment contract mandated by Ministry of Overseas Indian affairs
        and available at website https://emigrate.gov.in.</td>
    </tr>
    <tr>
      <td>6. To sign, authenticate and deliver all documents necessary to complete any transaction related to such
        recruitment and hiring. Including making the necessary steps to facilitate the departure of the recruited
        workers;</td>
    </tr>
    <tr>
      <td>7. To bring suit, defend and enter into compromises in India, in my name and stead in litigations brought for
        or against us (our company) in all matters involving the employment of Indian contract workers for myself (our
        company).</td>
    </tr>
    <tr>
      <td>8. To assume jointly and severally with the undersigned (our company) any liability that may arise in
        connection with the workers' recruitment and/or implementation of the employment contract and other terms and
        conditions of the appoinment as defined and spelled out in https://emigrate.gov.in.</td>
    </tr>
    <tr>
      <td>9. To allow visiting the workplace and residence of the workers recruited through them for the verification of
        the facilities provided to the workers.</td>
    </tr>
    <!-- End Powers -->

    <tr>
      <td style="padding-top: 10px;">
        This power of attorney shall be operative with immediate effect and shall continue to remain in force until
        revoked as provided in paragraph 2(a) and (c) above.
      </td>
    </tr>
    <tr>
      <td style="padding-top: 10px;">
        HEREBY GRANTING unto my (our) said representative full power andauthority to execute or perform whatsoever
        requisite, or proper to be done in about the premises as fully all intents andpurposes as I might orcould
        lawfully do if personally present, with power of substitution and revocation and hereby ratifying and confirming
        all tht my (our) said legal representative or his substitute shall lawfully do our cause to be done under and by
        virtue of these presents.
      </td>
    </tr>
  </table>


  <!-- Second Row (Signatory Details) -->
  <div style="width: 100%;margin-top:20px;">
    <div style="width:60%; float:left;text-align:right;">
      @if ($candidate->passportDetail->individual_or_company == 'individual')
      <img src="{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}"
        style="width:160px; height:auto; max-height:120px; object-fit: contain;">
      @else
      <img src="{{ public_path('storage/'.$candidate->passportDetail->feSign->attachment) }}"
        style="width:160px; height:auto; max-height:120px; object-fit: contain;">
      <img src="{{ public_path('storage/'.$candidate->passportDetail->feStamp->attachment) }}"
        style="width:160px; height:auto; max-height:120px; object-fit: contain;">
      @endif
    </div>
    <div style="width:40%; float:right; text-align: right; padding-top: 20px;">
      <p>______________________________</p>
      <p>(Signature of Signatory Authority)</p>
      <p>I.D. No. or Passport No.: <strong>{{ $candidate->passportDetail->fe_no }}</strong></p>
      <p>Issued on: __________________________</p>
      <p>at: ________________________________</p>
    </div>
  </div>


  <!-- Third Row (RA Sign / Stamp) -->
  <div style="width: 100%; overflow: hidden;  text-align: right;">
    <div style="display: flex;items-align: end;">
      <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_stamp) }}"
        style="width:160px; height:auto;max-height:120px; object-fit: contain;">
      <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_sign) }}"
        style=" width:160px; height:auto;max-height:120px; object-fit: contain; padding-top:20px;">
    </div>
  </div>
  </div>

</body>

</html>