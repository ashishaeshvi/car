<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Agreement Oman</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 16px;
            color: #333;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;

        }

        tr {
            margin: 20px;
            padding: 20px;
        }

        div,
        input,
        p,
        td,
        strong {
            font-size: 11px;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 0px;
            line-height: 14px;
            text-align: justify;
            width: 100%;
        }

        div {
            display: block;
        }
    </style>
</head>

<body>
    <div style="padding: 10px 15px">
        <table>
            <!-- Title Row -->
            <tr>
                <td
                    style="vertical-align: top; padding: 3px 20px 3px 0px; width: 60%; font-weight: bold;text-align:center; text-decoration:underline;padding-bottom:5px;">
                    SERVICE AGREEMENT (For Employment in a Company)
                </td>
                <td
                    style="vertical-align: top; padding: 3px 0px; width: 40%; font-weight: bold; text-align:center; direction: rtl;text-decoration:underline;padding-bottom:5px;">
                    عقد العمل (للتوظيف في شركة)
                </td>
            </tr>

            <!-- Date Row -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                This agreement was made on day
                            </td>
                            <td style="border-bottom:1px dotted bottom"></td>
                            <td width="auto">dated</td>
                            <td style="border-bottom:1px dotted bottom"></td>
                            <td width="auto">between</td>
                        </tr>

                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                تم إبرام هذا العقد في يوم
                            </td>
                            <td style="border-bottom:1px dotted bottom"></td>
                            <td width="auto">بين</td>
                            <td style="border-bottom:1px dotted bottom"></td>
                            <td width="auto">بتاريخ</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <!-- Employer Details Row -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">Name of employer:</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px;"
                                contenteditable="true">
                                {{ $candidate->passportDetail->fe_name }}
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                اسم صاحب العمل:
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Line 2 - Address -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    2) Address: <span
                        style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px; display: inline-block;"
                        contenteditable="true">{{ 'PO BOX ' . $candidate->passportDetail->pobox . ', PC ' .
                        $candidate->passportDetail->pin_code }}</span>
                    Sultanate
                    of {{ $candidate->passportDetail->country->name }} Tel. No. <span
                        style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px; display: inline-block;"
                        contenteditable="true">{{ $candidate->passportDetail->country->phonecode }}-{{
                        $candidate->passportDetail->fe_phone_no }}</span>
                    C.R No. <span
                        style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px; display: inline-block;"
                        contenteditable="true">{{ $candidate->passportDetail->fe_no }}</span>
                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    2) العنوان: ص.ب ........................................
                    سلطنة عمان
                    هاتف رقم ................................
                    سجل تجاري رقم
                </td>
            </tr>

            <!-- Line 3 - Party Designation -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    Hereinafter is called the <span style="font-weight: bold; text-decoration: underline">FIRST
                        PARTY</span>
                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    ويشار إليه فيما بعد <span style="font-weight: bold; text-decoration: underline"> بالطرف الأول
                    </span></td>
            </tr>


            <!-- Employee Details Row -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">Name of employee:</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px;"
                                contenteditable="true">
                                {{ $candidate->first_name_eng }} {{ $candidate->last_name_eng }}
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                اسم الموظف:
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Line 4 - Date of Birth -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">Date of birth</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 20px;"
                                contenteditable="true">
                                {{ $candidate->dob }}
                            </td>
                            <td style="white-space: nowrap; width: auto;">Nationality: Indian</td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                تاريخ الميلاد
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                            <td style="white-space: nowrap; width: auto;">
                                الجنسية: هندي
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Line 5 - Passport Details -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">Passport No.</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px;"
                                contenteditable="true">
                                {{ $candidate->passport_no }}
                            </td>
                            <td style="white-space: nowrap; width: auto;">Qualification:</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 60px;"
                                contenteditable="true">
                                8TH PASS
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                رقم جواز السفر
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                            <td style="white-space: nowrap; width: auto;">
                                ، المؤهل:
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Line 6 - Address -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">Permanent address in India:</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 120px;"
                                contenteditable="true">
                                {{ $candidate->current_city }}, {{ $candidate->passport_issue_state }}
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                العنوان الدائم في الهند:
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Line 7 - Party Designation -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    Hereinafter is called the <span style="font-weight: bold; text-decoration: underline">SECOND
                        PARTY</span>
                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">
                    ويشار إليه فيما بعد <span style="font-weight: bold; text-decoration: underline">بالطرف الثاني</span>
                </td>
            </tr>

            <!-- Agreement Terms Header -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">The both parties agreed on the following
                    conditions:
                </td>
                <td style="vertical-align: top; padding: 3px 0px; text-align: right; direction: rtl;">اتفق الطرفان على
                    الشروط
                    التالية:</td>
            </tr>

            <!-- Terms 1 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">The second party shall work for the First
                                Party as</td>
                            <td style="border-bottom: 1px dotted black; padding: 0 2px; min-width: 120px;"
                                contenteditable="true">
                                {{ $candidate->passportDetail->job }}
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">
                    <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                            <td style="white-space: nowrap; width: auto;">
                                1. يعمل الطرف الثاني لدى الطرف الأول في وظيفة
                            </td>
                            <td style="border-bottom: 1px dotted #000; width: 100%;"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Terms 2 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">2. The Second Party shall be entitled to
                    get
                    R.O........... per month as basic salary and the allowances
                    R.O....{{ $candidate->passportDetail->salary }}.......</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">2. يستحق الطرف
                    الثاني
                    راتباً أساسياً وقدره R.O .......... شهرياً بالإضافة إلى البدلات وقدرها R.O .</td>
            </tr>

            <!-- Terms 3 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">3. The First party is responsible to
                    provide the
                    Second Party with free single/family accommodation and free medical facilities.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">3. يلتزم الطرف
                    الأول بتوفير
                    سكن مجاني (مفرد أو عائلي حسب الحالة) للطرف الثاني وتوفير التسهيلات الطبية مجاناً.</td>
            </tr>

            <!-- Terms 4 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">4. The Second Party shall work for not
                    exceeding
                    9
                    actual hours per day or maximum 48 actual hours per week.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">4. يعمل الطرف
                    الثاني لمدة
                    لا تتجاوز 9 ساعات عمل فعلية يومياً أو 48 ساعة عمل فعلية في الأسبوع كحد أقصى.</td>
            </tr>

            <!-- Terms 5 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">5. If the Second party is asked to work
                    more
                    than the
                    working hours, the employer shall give him/her extra pay equivalent to his/her wages for the extra
                    period plus
                    25 percent or give a permission to be absent for the number of hours he/she worked on condition the
                    2<sup>nd</sup> party agrees to this arrangement.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">5. إذا طُلب من
                    الطرف الثاني
                    العمل أكثر من ساعات العمل المحددة، يدفع له صاحب العمل أجرًا إضافيًا يعادل أجره عن الفترة الإضافية
                    بالإضافة إلى
                    25%، أو يمنحه إذناً بالغياب عن عدد الساعات التي عملها بشرط موافقة الطرف الثاني على هذا الترتيب.</td>
            </tr>

            <!-- Terms 6 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">6. The Second party is entitled to 15 days
                    paid
                    leave
                    for the first year increased to 30 days for each successive year. He is also entitled to get medical
                    leave not more than 10 weeks in one year.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">6. يستحق الطرف
                    الثاني إجازة
                    مدفوعة الأجر لمدة 15 يومًا في السنة الأولى، وتزداد إلى 30 يومًا عن كل سنة تالية. كما يستحق إجازة
                    مرضية لا تزيد
                    عن 10 أسابيع في السنة.</td>
            </tr>

            <!-- Terms 7 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">7. The Second Party is entitled to get the
                    gratuity of
                    15 days wages each year for the first three years increased to 30 days wages for each successive
                    year
                    taking the
                    final basic salary as the base for the calculation.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">7. يستحق الطرف
                    الثاني
                    مكافأة نهاية خدمة مقدارها 15 يومًا عن كل سنة للأعوام الثلاثة الأولى، وتزداد إلى 30 يومًا عن كل سنة
                    تالية، مع
                    احتساب الراتب الأساسي النهائي كأساس للحساب.</td>
            </tr>

            <!-- Terms 8 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">8. The second party shall be entitled free
                    air
                    passage
                    in case of completion of One/Two years of service including the date of joining.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">8. يستحق الطرف
                    الثاني تذكرة
                    طيران مجانية عند إكمال سنة أو سنتين من الخدمة، بما في ذلك تاريخ الانضمام.</td>
            </tr>

            <!-- Terms 9 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">9. This agreement shall remain in force for
                    the
                    period
                    of 12/24 months from the date of joining. If agreement continues after expiry, it would be
                    considered
                    renewed
                    for unspecified period of time with same conditions.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">9. يظل هذا العقد
                    ساري
                    المفعول لمدة 12/24 شهراً من تاريخ الانضمام. إذا استمر العقد بعد انتهاء المدة يعتبر متجدداً لفترة غير
                    محددة بنفس
                    الشروط</td>
            </tr>

            <!-- Terms 10 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">10. This agreement can be terminated by
                    either
                    party
                    by giving one-month notice in writing or by paying the other the equivalent amount of the wages of
                    notice
                    period.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">10. يمكن إنهاء
                    هذا العقد من
                    قبل أي من الطرفين بإشعار كتابي لمدة شهر، أو بدفع مبلغ يعادل أجر شهر الإشعار للطرف الآخر.</td>
            </tr>

            <!-- Terms 11 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">11. In the event of death of the Employee,
                    the
                    Employee's dead body will be sent back to his/her country at the expense of the Employer.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">11. في حالة وفاة
                    الموظف،
                    يتم إعادة جثمانه إلى بلده على نفقة صاحب العمل.</td>
            </tr>

            <!-- Terms 12 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">12. The other terms which are not listed in
                    this
                    agreement shall be governed by Omani Labour Law.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">12. تخضع الشروط
                    الأخرى غير
                    المذكورة في هذا العقد لأحكام قانون العمل العماني.</td>
            </tr>

            <!-- Terms 13 -->
            <tr>
                <td style="vertical-align: top; padding: 3px 20px 3px 0px;">13. This agreement was issued in two
                    copies, one
                    for
                    each party.</td>
                <td style="vertical-align: top; padding: 3px 0px;  text-align: right; direction: rtl;">13. تم إصدار هذا
                    العقد
                    بنسختين، نسخة لكل طرف.</td>
            </tr>

        </table>
        <div style="width: 100%;position: relative;">
            <!-- English Section (floated left) -->
            <div style="float: left; padding: 4px 0px; width: 50%;">
                <div style="width: 100%;text-align:left;">

                    <div style="float:left; width:160px ;height:80px;background-image: url('{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size: contain;">

                    </div>



                    @if ($candidate->passportDetail->individual_or_company != 'individual')
                    <div style="float: right;width:160px ;height:80px;background-image: url('{{ public_path('storage/' . $candidate->passportDetail->feStamp->attachment) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size: contain;">

                    </div>
                    @endif
                </div>
                <div>
                    <div style="text-align:left;ext-align:left;padding-top:-40px;">
                        <strong>SIGNATURE OF FIRST PARTY:</strong>
                    </div>
                </div>
            </div>

            <!-- Arabic Section (floated right) -->
            <div style="float: right; padding: 4px 0px; text-align: right;width:40%;padding-top:60px;">
                <strong>توقيع الطرف الأول:</strong>
            </div>

        </div>
        <div>
            <div style="float: left; width: 50%;">
                <div style="width:160px ;height:80px;background-image: url('{{ public_path('storage/' . $candidate->passportDetail->candidate_sign) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size:contain;">
                </div>
                <div>
                    <div style="padding-top: -40px;">
                        <strong>SIGNATURE OF SECOND PARTY:</strong>
                    </div>
                </div>
            </div>
            <div style="float:right;width:40%; padding-top:60px; direction: rtl;"><strong>توقيع الطرف الثاني:</strong>
            </div>

        </div>





    </div>
    <div style="margin-top: 20px;padding:0px 15px">
        <div style=" width: 50%;">
            <div style="width: 100%;">
                <div style="float:left;width:160px ;height:80px;background-image: url('{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_sign) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size:contain;">

                </div>
                <div style="float:right;width:160px ;height:80px;background-image: url('{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_stamp) }}');
                    background-repeat: no-repeat;
                    background-position: left top;
                    background-size:contain;">


                </div>
            </div>
            <div>
                <div style="padding-top: -40px;">
                    <strong style="white-space: nowrap">Signature and Stamp of Recruiting Agency Name:</strong> <br />
                    <strong style="width:100%;padding-top:-20px;white-space:nowrap">Authorised Signatory</strong>
                </div>
            </div>
        </div>
        {{-- <div style="float: right; width: 50%;">Authorised Signatory</div> --}}
    </div>

</body>

</html>