<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .page {
            position: relative;
            width: 100%;
            height: 297mm;
            display: table;
        }

        .table-overlay {
            width: 80%;
            margin-left: 10%;
            padding-top: 30px;
        }

        table {
            font-family: sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid;
            text-align: left;
            padding: 5px;
        }

        table.b-n td,
        table.b-n th {
            border: none !important;
        }
    </style>
</head>

<body>
    @foreach($candidate->passportDetail->raDocument->affidavit_notary as $key => $image)
    <div class="page" style="
                    background-image: url('{{ public_path('storage/'.$image) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size: cover;">
        @if($loop->index == 1)
        <div class="table-overlay">
            <table>
                <tr>
                    <th>S NO</th>
                    <th>NAME AND FULL ADDRESS</th>
                    <th>PP. NO.</th>
                    <th>CATEGORY</th>
                    <th>SPONSOR NAME</th>
                    <th>VISA NO. AND DATE OF VALIDITY</th>
                    <th>COUNTRY</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        {{ $candidate->first_name_eng }} {{ $candidate->last_name_eng }}<br />
                        {{ $candidate->passport_address }}
                    </td>
                    <td>{{ $candidate->passportDetail->passport_no }}</td>
                    <td>{{ $candidate->passportDetail->job }}</td>
                    <td>{{ $candidate->passportDetail->fe_name }}</td>
                    <td>{{ $candidate->visa_no }}<br />{{ $candidate->visa_expiry_date }}</td>
                    <td>{{ $candidate->passportDetail->country->name }}</td>
                </tr>
            </table>
        </div>
        @endif
    </div>
    @endforeach
    <div class="page" style="position: relative">
        <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->letterpad_logo) }}"
            style="width: 100%; height: auto;" />
        <div style="padding:0px 50px;padding-top:30px;">
            <p style=" text-align: center; margin: 8px 0;">
                <strong style="border-bottom: 2px solid #000; display: inline-block;">DECLARATION</strong>
            </p>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, {{ $candidate->passportDetail->raDocument->ra_name }} (RC
                Holder Name), holder of Registration Certificate No. {{
                $candidate->passportDetail->raDocument->registration_no }}, issued by the Protector General of
                Emigrants, Ministry of External Affairs, Govt. of India, New Delhi, Hereby declare as follows:-
            </p>
            <p>
                1. That the emigrant <span
                    style="font-weight: 700;border-bottom:1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;{{
                    $candidate->first_name_eng }} {{ $candidate->last_name_eng }}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> (Emigrant Name) with Emigrant Passport No <span
                    style="font-weight: 700;border-bottom:1px dotted #000;">&nbsp;&nbsp;{{
                    $candidate->passportDetail->passport_no }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> has been
                recruited by me and I have fully briefed him about his Employment contract, i.e., Name of Foreign
                employer, job/occupation, details for which he has been recruited, country of employment, period of
                contract, place of employment, wages, allowances, and other service conditions.
            </p>
            <p>
                2. That we have not charged them more than Rs 30,000/- service charges, as prescribed by the office of
                PGE, New Delhi for his recruitment.
            </p>
            <p>
                3. That I have also explained the terms and conditions of his Employment contract to the emigrant in his
                mother tongue. A duly signed copy of the declaration, in the mother tongue of the Emigrant is also
                enclosed herewith.
            </p>
            <table class="b-n" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td width="auto" style="white-space: nowrap; vertical-align: bottom;">
                        Signature of the Emigrant
                        
                    </td>
                    <td style="vertical-align: bottom;"> <img src="{{ public_path('storage/'.$candidate->passportDetail->candidate_sign) }}"
                            style="width: 100px; height: auto;" /> </td>
                    <td style="text-align:right; vertical-align: bottom;">
                        <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_sign) }}"
                            style="width: 100px; height: auto;" />
                       
                    </td>
                    <td width="auto" style="text-align:right;  vertical-align: bottom;white-space: nowrap;">
                        
                        Signature of the RA
                    </td>
                </tr>
            </table>

            <section style="font-size: 14px; line-height: 1.6; color: black;padding-top:0px;padding-bottom:10px;">
                <p style="font-weight: 600; text-align: center; margin: 0px  0px 8px  0px;">
                    <strong style="border-bottom: 2px solid #000; display: inline-block;"> घोषणा </strong>
                </p>
                <p>
                    मैं, {{$candidate->passportDetail->raDocument->ra_name_hindi }} (आरसी धारक का नाम), पंजीकरण प्रमाण
                    पत्र संख्या {{
                    $candidate->passportDetail->raDocument->registration_no }} का धारक हूं, जो उत्प्रवासी संरक्षक, विदेश
                    मंत्रालय, भारत सरकार द्वारा जारी किया गया है, एतदद्वारा निम्नलिखित घोषित करें:-
                </p>
                <p>
                    1. उत्प्रवासी संख्या <span style="border-bottom:1px dotted #000;">&nbsp;&nbsp;{{
                        $candidate->name_hindi }}&nbsp;&nbsp;</span> (प्रवासी का
                    नाम) तथा (प्रवासी पासपोर्ट संख्या) <span
                        style="font-weight: 700;border-bottom:1px dotted #000;">&nbsp;&nbsp;{{
                        $candidate->passportDetail->passport_no }} &nbsp;&nbsp;</span> को
                    मेरे द्वारा भर्ती किया गया है और मैंने उसे
                    उसके रोजगार अनुबंध यानि विदेशी नियोक्ता के नाम के बारे में पूरी जानकारी दे दी है। नौकरी/व्यवसाय
                    विवरण जिसके लिए उसे भर्ती किया गया है, रोजगार का देश, अनुबंध की अवधि, रोजगार का स्थान, कार्य, भत्ते
                    और सेवा की अन्य शर्तें।
                </p>
                <p>
                    2. हमने उनसे उनकी भर्ती के लिए पीजीई, नई दिल्ली के कार्यालय द्वारा निर्धारित 30,000/- रुपये से अधिक
                    सेवा शुल्क नहीं लिया है।
                </p>
                <p>
                    3. मैंने प्रवासी को उसके रोजगार अनुबंध के नियम और शर्तें भी उसकी मातृ भाषा में समझा दी है। प्रवासी
                    की मातृ भाषा में इस घोषणा का विधिवत हस्ताक्षर पत्र भी इसके साथ संलग्न है।
                </p>
                <table class="b-n" style="width: 100%; border-collapse: collapse;">
                 
                     <tr>
                    <td width="auto" style="white-space: nowrap; vertical-align: bottom;">
                         प्रवासी के हस्ताक्षर
                        
                    </td>
                    <td style="vertical-align: bottom;">
                          <img src="{{ public_path('storage/'.$candidate->passportDetail->candidate_sign) }}"
                                style="width: 100px; height: auto;" />
                             </td>
                    <td style="text-align:right; vertical-align: bottom;">
                        <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->ra_sign) }}"
                                style="width: 100px; height: auto;" />
                    </td>
                    <td width="auto" style="text-align:right;  vertical-align: bottom;white-space: nowrap;">
                       आरए के हस्ताक्षर
                    </td>
                </tr>
                </table>
               

            </section>
        </div>

        <htmlpagefooter name="lastpagefooter">
            <div class="footer-fixed" style="width: 100%;">
                <img src="{{ public_path('storage/'.$candidate->passportDetail->raDocument->letterpad_footer) }}"
                    style="width: 100%; height: auto;" />
            </div>
        </htmlpagefooter>
        <sethtmlpagefooter name="lastpagefooter" value="on" />
    </div>
</body>

</html>