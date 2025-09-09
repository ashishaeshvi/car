<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Unlimited Period Contract</title>

  <style>
    body {
      font-family: sans-serif;
      color: #333;
    }

    h1 {
      font-size: 20px;
      text-align: center;
      margin-bottom: 30px;
    }

    input,
    p,
    td {
      font-size: 11px;
    }

    table {
      border-collapse: separate;
      border-spacing: 0rem 0rem;
      line-height: 15px;
      text-align: justify;
    }

    div {
      display: block;
    }
  </style>
</head>

<body>
  <div style="padding: 10px 15px;">
    <!-- Contract Header -->
    <table style="width: 100%; border-collapse: collapse;">
      <tr style="border:1px solid black;">
        <td width="50%" style=" padding: 3px 0px; font-weight:bold; text-align: center;border-right: 1px solid black;">
          Unlimited Period Contract of Employment
        </td>
        <td width="50%" style=" padding: 3px 0px;direction: rtl; font-weight:bold;text-align: center;">
          عقد عمل غير محدد المدة
        </td>
      </tr>

      {{-- ==================1============================ --}}
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="text-align: center;font-weight:bold;">This Contract is Made in Doha on <span
              style="text-align:end">Between:</span></div>
        </td>
        <td width="50%" style="padding: 3px 0px 3px 0px; direction: rtl; text-align: right;">
          <div style="text-align: center;font-weight:bold; ">
            رقم عقد عمل غير محدد المدة وتاريخه في الدوحة بين:
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                M/S: Company Name
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->passportDetail->individual_or_company == 'company' ?
                $candidate->passportDetail->fe_name
                : '' }}

              </td>
            </tr>
          </table>

        </td>
        <td width="50%" style="text-align: right; padding: 0px 0px 0px 15px;direction: rtl;">

          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">السادة / شركة /</td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>


      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                Represented by Mr. Sponsor Name:
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->passportDetail->individual_or_company == 'company'
                ? $candidate->passportDetail->sponsor_name
                : $candidate->passportDetail->fe_name }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="text-align: right; padding: 0px 0px 0px 15px; direction: rtl;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">ويمثلها السيد /</td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <span style="white-space: nowrap;">Capacity: Employer</span>
        </td>
        <td width="50%" style="text-align: right; padding: 0px 0px 0px 15px;direction: rtl;">
          <span style="white-space: nowrap;">بصفته : صاحب العمل</span>
        </td>
      </tr>


      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                Address: Doha P.O. Box:
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->passportDetail->pobox }}
              </td>
              <td width="auto" style="white-space: nowrap;">
                Tel:
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->passportDetail->country->phonecode
                }}-{{$candidate->passportDetail->fe_phone_no }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="text-align: right; padding: 0px 0px 0px 15px; direction: rtl;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                عنوانه : الدوحة - ص.ب
              </td>
              <td width="50%" style="border-bottom:1px dotted #000;"></td>


              <td width="auto" style="white-space: nowrap;">
                تليفون
              </td>
              <td width="50%" style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      {{-- ==========================2======================= --}}
      <tr>
        <td width="50%"
          style="border-right: 1px solid black; padding: 6px 0px 10px 0px;font-weight:bold;text-align: center; ">
          First Party - AND -
        </td>
        <td width="50%" style="padding: 6px 0px 10px 0px; direction: rtl; text-align: center;font-weight:bold;">الطرف
          الأول - و - </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                MR. Name:
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->first_name_eng }} {{ $candidate->last_name_eng }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                السيد
              </td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- HOLDER OF PASSPORT -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                HOLDER OF PASSPORT:
              </td>
              <td style="border-bottom:1px dotted #000;">
                &nbsp;&nbsp; {{ $candidate->passport_no }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                حامل جواز سفر رقم :
              </td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- WORK PERMIT / Visa No -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                WORK PERMIT : Visa No
              </td>
              <td style="border-bottom:1px dotted #000; padding: 2px 0;">
                &nbsp;&nbsp; {{ $candidate->visa_no }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                ترخيص عمل (البطاقة الشخصية)
              </td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- LIVING IN INDIA -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                LIVING IN INDIA:
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                والقيم بعنوان التلي : الدوحة
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- ST. NAME -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                ST. NAME:
              </td>
              <td style="border-bottom: 1px dotted #000; padding: 2px 0;">
                &nbsp;&nbsp; {{ $candidate->passport_issue_state }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                اسم الشارع :
              </td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>


      <!-- BUILDING NO -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                BUILDING NO:
              </td>

            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                رقم السكن :
              </td>

            </tr>
          </table>
        </td>
      </tr>


      <!-- AREA NAME -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                AREA NAME:
              </td>
              <td style="border-bottom: 1px dotted #000; padding: 3px 0;">
                &nbsp;&nbsp; {{ $candidate->current_city }}
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                اسم المنطقة :
              </td>
              <td style="border-bottom:1px dotted #000;"></td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Electricity no -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0;">
          <span style="white-space: nowrap;">Electricity no:</span>
        </td>
        <td width="50%" style="padding: 3px 0 3px 15px; direction: rtl; text-align: right;">
          <span style="white-space: nowrap;">رقم الكهرباء :</span>
        </td>
      </tr>
      <!-- D. O. S -->
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                D.O.S :
              </td>
              <td>
                00/00/0000
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                تاريخ المباشرة :
              </td>
              <td>../../....</td>
            </tr>
          </table>
        </td>
      </tr>

      {{-- ============================3======================= --}}
      <tr>
        <td width="50%"
          style="border-right: 1px solid black; padding: 6px 0px 10px 0px;text-align: center; font-weight:bold; text-decoration: underline">
          Second Party
        </td>
        <td width="50%"
          style="padding: 0px 0px 0px 15px; direction: rtl; text-align: center; font-weight:bold; text-decoration: underline">
          طرف ثاني
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">The two parties agreed on the following:</div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">حيث اتفق الطرفان على مايلي :</div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            1. The second party agrees to work for the first party in the occupation of {{
            $candidate->passportDetail->job }} in state of Qatar.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            1- يوافق الطرف الثاني على أن يعمل لدى الطرف الأول بمهنة .................... في دولة قطر.
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">2- A Contract Duration:</span> <br /> A- This Contract is unlimited in and
            shall be deemed valid with effect from the date of the Second Party
            service joining the Second Party shall be under probationary period of six Months. Starting from date second
            party joining service. The
            First Party has right to terminate the contract by giving the second party three days prior notice. The
            first party shall bear repatriation expenses of the Second party, in case return expense will be charged to
            the second party.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            <span style="font-weight: bold">2- مدة العقد:</span> <br />أ- أن هذا العقد غير محدد المدة ويبدأ من تاريخ
            مباشرة الطرف الثاني للعمل ويعتبر مدة أشهر السنة
            الأولى فترة الاختبار، ويجوز للطرف الأول خلالها إنهاء العقد بإخطار الطرف الثاني بذلك قبل ثلاثة أيام من تاريخ
            الانتهاء. ويتحمل الطرف الأول تكاليف إعادته إلى بلده. ويعفى الطرف الأول من تحمل نفقات عودة الطرف الثاني إلى
            بلاده في حالة تقديم الطرف الثاني لاستقالته أثناء فترة الاختبار.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            B- Upon the successful completion of probation period, parties are entitled to without explaining reasons
            provided that one moth notice, one month notice pay is provided by the party wishes to terminate the
            contract.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">ب- بعد انتهاء فترة الاختبار بنجاح، يحق لأي من الطرفين إنهاء هذا العقد في أي وقت
            وبدون إبداء أية أسباب، ويجب إعطاء مهلة للطرف الآخر لا تقل عن شهر واحد من تاريخ الإنهاء.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> 3. HOURS OF WORK :</span> <br /> Eigtht (8) hours daily for (6) days a
            week. The Second Party shall be entitled to a paid
            leave rest of one day weekly on Friday.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            <span style="font-weight: bold"> 3- ساعات العمل: </span> <br />
            (8) ساعات يومياً خلال (6) أيام عمل أسبوعياً. ويحصل الطرف الثاني على راحة أسبوعية مدفوعة الأجر في يوم الجمعة
            من كل أسبوع.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> 4- Salary: </span> <br /> The salary of the second party shall be QR
            (....{{ $candidate->passportDetail->salary}})-per
            month with free food and accommodation.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            <span style="font-weight: bold">4- الراتب:</span><br />
            يتقاضى الطرف الثاني راتباً أساسياً قدره (٠٠٠٠٠٠٠٠٠) ريال قطري شهرياً بالإضافة لنفقات الطعام و السكن مجاناً.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> 5- END OF SERVICE PREMIUM: </span> <br /> The second party shall be
            entitled (21) days for each work year.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            <span style="font-weight: bold">5- مكافأة نهاية الخدمة:</span><br />
            يستحق الطرف الثاني مكافأة نهاية الخدمة مدة لا تقل عن (٢١) يوماً عن كلّ سنة عمل.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> 6- Leave: </span><br />
            A- The second party shall be entitled (21) Day paid Leave every year.<br />
            B- The second party shall receive full pay during the official holidays as the Qatari labour law which is
            valid in state of Qatar <br />
            C- The Second party is entitled for sick leave with pay after three months of continuous service with the
            First party in accordance with the Qatri Labour Law.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:4px">
            <span style="font-weight: bold"> 6- الإجازات:</span>
            <br />أ- يستحق الطرف الثاني إجازة مدفوعة الأجر قدرها (٢١) يوماً في السنة مدفوعة الأجر.
            <br />ب- يحصل الطرف الثاني على أجر كامل في الإجازات الرسمية حسب قانون العمل المعمول به بدولة قطر.
            <br />ج- يستحق الطرف الثاني إجازة مرضية مدفوعة الأجر بعد مضى ثلاثة أشهر متصلة في عمله لدى الطرف الأول، وتحسب
            الإجازة المرضية وفقاً لأحكام قانون العمل.
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> 7- Travel Expenses:</span> <br />
            a) The First Party shall undertake to pay the travel ticket of the
            second party from the city of (INDIA) to the place of the work in
            the state of Qatar as well as the costs of the return passage. The
            First Party shall also bear the round-trip travel costs of the
            second party one time every two years when departing on leave. These
            expenses shall not cover costs of acquiring the passports or payment
            against any guarantees.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold"> نفقات السفر : </span> <br /> أ) يلتزم الطرف الأول بدفع تذكرة سفر الطرف
            الثاني من مدينة (الهند) إلى مكان العمل في دولة قطر، بالإضافة إلى تكاليف العودة. كما يتحمل الطرف الأول أيضاً
            تكاليف السفر ذهاباً وإياباً للطرف الثاني مرة واحدة كل سنتين عند مغادرته في إجازة. ولا تشمل هذه النفقات
            تكاليف استخراج جوازات السفر أو أي مدفوعات مقابل أية ضمانات.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            b) The First Party shall be exempted from return travel expenses
            should the Second Party terminate the contract for violating
            provisions of the article (61) of the Qatar Labor Law.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            ب) يُعفى الطرف الأول من نفقات العودة إذا أنهى الطرف الثاني العقد لمخالفته لأحكام المادة (61) من قانون العمل
            القطري.
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">8- Accommodation:</span> <br /> a) The first party undertakes to provide a
            free and appropriate
            bachelor accommodation for the use of the second party, to be
            equipped with beds &amp; suitable bathrooms.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">8- السكن :</span> <br /> أ) يلتزم الطرف الأول بتوفير سكن مناسب ومجاني للأعزب
            لاستخدام الطرف الثاني، مزودًا بأسِرّة وحمامات مناسبة.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            b) The first party undertakes to supply the second party with cold
            fresh drinking water.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            ب) يلتزم الطرف الأول بتزويد الطرف الثاني بماء شرب بارد وطازج.
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">9- TRANPORTATION:</span> <br /> The first party shall provide the second
            party with free
            transportation from accommodation to the workplace and back.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">9- النقل :</span> <br /> يوفر الطرف الأول للطرف الثاني وسيلة انتقال مجانية
            من السكن إلى مكان العمل وبالعكس
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">10. MEDICAL CARE:</span> <br /> The first party shall provide the second
            party with the required
            medical treatment in accordance with the rules and regulations in
            force in the State of Qatar.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">10- الرعاية الطبية :</span> <br />
            يوفر الطرف الأول للطرف الثاني العلاج الطبي اللازم، حسب الأنظمة واللوائح المعمول بها في دولة قطر.
          </div>
        </td>
      </tr>

      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">11. GENERAL PROVISION:</span> <br />
            a) The second party hereby agreed that
            he has seen all the internal
            regulations set forth by the First Party, that he undertakes to execute and abide him by
            them.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            <span style="font-weight: bold">11- أحكام عامة :</span> <br />
            أ) يقر الطرف الثاني بأنه قد اطّلع على جميع اللوائح الداخلية الصادرة عن الطرف الأول، ويتعهد بتنفيذها
            والالتزام بها.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            b) The second party undertakes to execute his duties in accordance
            with average and means of daily performance for the same career.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            ب) يتعهد الطرف الثاني بأداء واجباته وفقاً لمستوى ومتوسط الأداء اليومي المعتاد لنفس المهنة.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            c) The second party shall undertakes to refrain from interfering in involve himselfin any
            political or religious affairs, to refrain taking wine or drugs and
            to respect the local customs and traditions.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            ج) يلتزم الطرف الثاني بالامتناع عن التدخل في أي شؤون سياسية أو دينية، والامتناع عن تناول الخمور أو المخدرات،
            واحترام العادات والتقاليد المحلية.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            d) The provisions of this contract agreement are governed by the Qatari Labor
            Law No. (14) of the year 2004 and its executive decisions, and as such they constitute the basis to resort
            to in the event of any dispute arising between the two parties and all
            matters not provided for in this contract shall be subject to thr Qatri labor law.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            د) تخضع أحكام هذا العقد لقانون العمل القطري رقم (14) لسنة 2004 وقراراته التنفيذية، وتشكل هذه الأحكام الأساس
            للرجوع إليها في حال نشوء أي نزاع بين الطرفين، وكل ما لم يرد في هذا العقد يخضع لقانون العمل القطري.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="text-decoration: underline; margin-bottom:14px">
            <span style="font-weight: bold;"> Repatriation of Mortal Remains and Settlement of
              Dues</span>
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="text-decoration: underline; margin-bottom:14px">
            <span style="font-weight: bold; text-align:centre">إعادة جثمان المتوفى وتسوية مستحقاته.</span>
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            A) In case of death of the worker, the company/employer shall dispatch
            the mortal remains of the deceased emigrant to his/her native place at
            its/his own expenses and shall settle all dues of the worker(s), in
            coordination with the Indian Embassy.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            أ) في حالة وفاة العامل، يلتزم صاحب العمل أو الشركة بإرسال جثمان العامل المتوفى إلى موطنه الأصلي على نفقته
            الخاصة، وتسوية جميع مستحقات العامل بالتنسيق مع السفارة الهندية.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            B) The worker will be given insurance cover during the duration of the contract.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            ب) يُمنح العامل تغطية تأمينية طوال مدة العقد.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="margin-bottom:14px">
            12- This contract is made and issued in three original copies. One copy
            shall be kept by the employer and one copy shall be given to the
            worker, the third copy shall be filed at the Ministry of Labour.
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-bottom:14px">
            12- تم إعداد هذا العقد وإصداره في ثلاث نسخ أصلية، يحتفظ صاحب العمل بنسخة، ويُسلَّم للعامل نسخة، وتُودَع
            النسخة الثالثة في وزارة العمل.
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style="border-right: 1px solid black; padding: 3px 15px 3px 0px;">
          <div style="text-decoration: underline; margin-bottom:16px">
            <span style="font-weight: bold; text-align: center"> In witness thereof, both parties have set their hands
              and signatures. </span>
          </div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="text-decoration: underline; margin-bottom:14px">
            <span style="font-weight: bold; text-align: center">
              يشهد الطرفان بتوقيع أيديهما على هذا العقد.
            </span>
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style=" padding: 3px 15px 3px 0px;">

          <table style="width: 100%; border-collapse: collapse; margin-top: 24px;">
            <tr>
              <td width="auto" style="white-space: nowrap;">
                <img src="{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}"
                  style="width:160px; height:100px; object-fit: contain;">
              </td>
              <td>
                <img src="{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}"
                  style="width:160px; height:100px; object-fit: contain;">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                First Party: (Employer)
              </td>
            </tr>
          </table>

        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="margin-top:24px;font-weight:700">
            الطرف الأول (صاحب العمل)
          </div>
        </td>
      </tr>
      <tr>
        <td width="50%" style=" padding: 3px 15px 3px 0px;">
          <img src="{{ public_path('storage/' . $candidate->passportDetail->candidate_sign) }}"
            style="width:160px; height:100px; object-fit: contain;">
          <div style="margin-top:40px;font-weight:700">Second Party: (Employee)</div>
        </td>
        <td width="50%" style="padding: 0px 0px 0px 15px; direction: rtl; text-align: right;">
          <div style="padding-top:140px;font-weight:700">
            الطرف الثاني (العامل)
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="text-align:center;">
          <table style="width: 100%; border-collapse: collapse; ">
            <tr>
              <td colspan="2" style="text-align: center"> Signature on Indian recruitment agency (if Applicable) </td>
            </tr>
            <tr>
              <td style="text-align: right;">
                <img src="{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_sign) }}"
                  style="width:160px; height:100px; object-fit: contain;margin-right:20px;">
              </td>
              <td>
                <img src="{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_stamp) }}"
                  style="width:160px; height:100px; object-fit: contain;">
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center">Authorised Signatory</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>