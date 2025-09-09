<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Employment Agreement</title>

	<style>
		body {
			/* font-family: 'dejavusans', sans-serif; */
			font-family: sans-serif;
			color: #333;
		}

		h1 {
			font-size: 18px;
			text-align: center;
			margin-bottom: 20px;

		}

		p {
			margin: 0px !important;
			padding: 0px !important;
		}

		input,
		p,
		td {
			font-size: 15px;
		}

		table {
			border-collapse: separate;
			border-spacing: 0.2em;
			line-height: 17px;
			text-align: justify;
		}
	</style>
</head>

<body>
	<!-- This Agreement PDF is For Saudi, UAE, Kuwait, Bahrin -->
	<table role="presentation"
		style="width: 100%; max-width: 767px; margin: 0 auto; border-collapse: separate; table-layout: fixed;">
		<tr>
			<td style="padding: 0;  border: none;text-align: center;">
				<h1 style="text-align: center">EMPLOYMENT AGREEMENT</h1>
			</td>
			<td style="padding: 0; border: none;direction:rtl;text-align: center;">
				<h1 style="text-align: center">عقد عمل</h1>
			</td>
		</tr>

		<!-- First Section: Employer details and initial terms -->
		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 20px 3px 0;  border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td>
							Full Name & Address of employer
						</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->passportDetail->fe_name }}
						</td>
					</tr>
				</table>
			</td>

			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="100%">
							الاسم الكامل وعنوان الجهة المستخدمة
						</td>
					</tr>
					<tr>
						<td width="100%" style="border-bottom: 1px dotted #000; padding-bottom:22px;">

						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table width="100%" cellpadding="4" cellspacing="0" style="border-collapse: collapse;">
					<tr>
						<td style="white-space: nowrap" width="auto">Telephone No.</td>
						<td width="100%" style="border-bottom: 1px dotted #000; padding: 2px 0px; ">
							{{ $candidate->passportDetail->country->phonecode }}-{{
							$candidate->passportDetail->fe_phone_no }}
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td style="white-space: nowrap" width="auto">
							رقم الهاتف
						</td>
						<td width="100%" style="border-bottom: 1px dotted #000; padding-bottom:22px;">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="20%">
							Visa No.
						</td>
						<td width="80%" style="border-bottom: 1px dotted #000; padding: 2px 0px; ">
							{{ $candidate->visa_no }}
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="22%">
							رقم التأشيرة
						</td>
						<td width="68%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="30%">
							Date of Issue
						</td>
						<td width="37%" style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->visa_issue_date }}
						</td>
						<td width="30%">
							referred to as
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="25%">
							تاريخ الاصدار
						</td>
						<td width="65%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="100%">FIRST PARTY in this agreement / and Mr.</td>
					</tr>
					<tr>
						<td width="100%" style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->first_name_eng }} {{ $candidate->last_name_eng }}
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="100%">
							المشار كطرف أول في هذا العقد هو السيد
						</td>
					</tr>
					<tr>
						<td width="100%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td>
							an Indian National, holder of Passport No.
						</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->passport_no }}
						</td>
					</tr>
				</table>

				</p>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="100%">
							هندي الجنسية حامل جواز سفر رقم
						</td>
					</tr>
					<tr>
						<td width="100%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="23%">
							Issued at
						</td>
						<td width="30%" style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->passport_issue_place }}
						</td>
						<td width="17%">
							&nbsp;Dated
						</td>
						<td width="30%" style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->passport_issue_date }}
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td width="20%">
							صادر من
						</td>
						<td width="30%" style="border-bottom: 1px dotted #000; padding-bottom:22px;">

						</td>
						<td width="15%">
							بتاريخ
						</td>
						<td width="35%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td style="white-space: nowrap" width="auto">
							and resident of
						</td>
						<td width="100%" style="border-bottom: 1px dotted #000; padding: 2px 0px;">
							{{ $candidate->current_city }}, {{ $candidate->passport_issue_state }}
						</td>
					</tr>
				</table>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<table style="width: 100%; border-collapse: collapse;">
					<tr>
						<td style="white-space: nowrap" width="auto">
							السكان في
						</td>
						<td width="100%" style="border-bottom: 1px dotted #000; padding-bottom:22px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px;">
				<div style="margin: 0 0 4px 0">
					referred to as SECOND PARTY have agreed as follows:
				</div>
			</td>
			<td
				style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;padding-right:20px; direction: rtl; text-align: right;padding-left:20px;">
				<div style="margin: 0 0 4px 0">
					يسمى كطرف ثاني يوافق على ما يلي :
				</div>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0; border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					1. As of the effective date of this agreement, the Second Party shall work for the First Party in
					accordance with the terms of this agreement and of ......... any supplements thereto, as <span
						style="border-bottom: 2px dotted #000">{{ $candidate->passportDetail->job }} </span> at the
					Head Office or branches of ............ or in any organization associated or in cooperation with it.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					١) اعتباراً من تاريخ هذا العقد يوافق الطرف الثاني على العمل لدى الطرف الأول وفق شروط هذا العقد وأية
					ملاحق أخرى بوظيفة ............ في المكتب الرئيسي أو أي فرع في .........أو أية مؤسسة تابعة لنا
					بالمملكة العربية السعودية.
				</p>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0; border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					2. This agreement shall become effective as of the date on which the Second Party arrives in Saudi
					Arabia, stated at the bottom of the last page hereof and shall be in force for a period of <span
						style="border-bottom:1px dotted #000"> 2 Years </span> Gregorian/Hijrah years renewable for
					another period of ............... years under the same terms and conditions unless either party
					expresses his desire in writing not to renew this agreement at least 30 days in advance of the date
					of completion of the contract.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					٢) يسري هذا العقد اعتبار من تاريخ وصول الطرف الثاني إلى المملكة العربية السعودية وفق ما هو موضح في
					ذيل هذا العقد وسيكون صالحاً لمدة ........... سنة شمسية/هجريه وقابلاً للتجديد لمدة لاحقة أخرى بنفس
					البنود والشروط إذا لم يبدي أحد الطرفين رغبة خطية في عدم تجديد هذا العقد مقدماً قبل ٣٠ يوماً من نهاية
					العقد.
				</p>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					3. The First Party shall pay to the Second Party, during the latter’s performance of his duties, a
					monthly salary of SR <span style="border-bottom:1px dotted #000">{{
						$candidate->passportDetail->salary }} </span> only.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					٣) يدفع الطرف الأول للطرف الثاني خلال قيامه بكامل واجباته راتباً شهرياً وقدره ......... ريال سعودي
					فقط.
				</p>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					4. The First Party will provide free suitable accommodation with furnishings to the Second Party.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					٤) يعطي الطرف الأول السكن المجاني المناسب مع المفروشات للطرف الثاني.
				</p>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					5. The First Party will provide to the Second Party free food (three meals daily).
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					٥) يعطي الطرف الأول الطعام مجاناً ثلاث وجبات كل يوم للطرف الثاني.
				</p>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top; padding: 3px 0;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0;">
					6. The Second Party shall be entitled to an annual vacation of ........ days after each twelve
					months of continuous service under this Agreement. Salary for vacation shall be paid in advance.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0;">
					٦) يحق للطرف الثاني إجازة سنوية مدتها ......... يوماً بعد كل اثني عشر شهراً من الخدمة المستمرة بموجب
					هذا العقد وتدفع أجور هذه الإجازة مقدماً.
				</p>
			</td>
		</tr>

	</table>

	{{-- <div style="page-break-after: always;"></div> --}}

	<!-- Page 2 will Start From Here -->

	<table role="presentation"
		style="width: 100%; max-width: 767px; margin: 0 auto; border-collapse: separate; table-layout: fixed;">
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none;width: 50%;">
				<p style="margin: 0 0 4px 0">
					7. Free medical treatment shall be provided by First Party as per Saudi Labour Law.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;width: 50%;">
				<p style="margin: 0 0 4px 0">
					٧). يوفر الطرف الأول المعالجة الطبية مجاناً للطرف الثاني حسب نظام العمل والعمال السعودي.
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					8. The First Party shall bear the cost of transportation of the Second Party from ........... to
					........ by air (economy class) for the latter's incoming trip before the effective date of this
					Agreement and his return after its termination accompained by and ......
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					٨). يتحمل الطرف الأول تكاليف انتقال الطرف الثاني من ___ إلى ___ بالدرجة السياحية للقدوم قبل نفاذ
					العقد والعودة بعد انتهاءه بصحبة ___ و
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					9. The First Party shall bear all fees pertaining to residence, passport entry and exit visas as
					well as
					cost
					of transportation of the Second Party on a round trip at economy class airfare accompainied by
					.......... and ......... between ........ and where the Second Party shall spend his
					vacation once after each of one/two years of uninterrepted service.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					٩) يتحمل الطرف الأول رسوم الإقامة والجواز والإجازة السنوية مرة كل سنة أو سنتين مع
					.................
					و
					.................
					بين
					..................
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					10. The Second Party shall bear all kinds of taxes for which he is liable under the provision of the
					laws and regulations in force in the Kingdom of Saudi Arabia.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					١٠) يتحمل الطرف الثاني كافة أنواع الضرائب التي يكون ملزماً بها بموجب النصوص القانونية المعمول بها في
					المملكة العربية السعودية
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					11. The employment of the Second Party, under the present agreement, in respect of all matters
					relating to working hours, weekly rest, sick leave, cases of absence, injuries, disability, and
					death, and as regard termination of services and compensation due to the Second Party in the form of
					an end-of-service award, as well as in all matters for which this agreement does not contain a
					specific provision, shall be governed by provisions of the Labour and Workman's law in force in the
					Kingdom of Saudi Arabia, which provisions shall constitute the only terms of reference which either
					party can invoke.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					١١) يختص استخدام الطرف الثاني بموجب هذا العقد بخصوص كافة الأمور المتعلقة بساعات العمل والراحة
					الأسبوعية والإجازة المرضية وحالات الغياب والإصابات والعجز والوفاة وفيما يتعلق بإنهاء الخدمات وما
					يستحق الطرف الثاني من تعويض في مكافأة نهاية الخدمة، وفي جميع الأمور التي لم يرد فيها نص خاص في هذا
					العقد لأحكام قانون العمل والعمال ساري المفعول بالمملكة العربية السعودية وتشكل هذه الأحكام المرجع
					الوحيد لكل من الطرفين.
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					12. The Second Party must observe all rules, regulations and instructions issued by the First Party,
					and must so conduct himself as to avoid anything that would detract from his reputation or the
					reputation of the First Party. The Second Party must also abide by all general and local laws and
					regulations in force within the territorial boundaries of the Kingdom of Saudi Arabia.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					١٢) يجب على الطرف الثاني أن يلتزم بجميع الأنظمة والتعليمات التي يصدرها الطرف الأول ويسلك طريقاً
					يتجنب عما ينقص من سمعته أو سمعة الطرف الأول وعلى الطرف الثاني أن يلتزم بجميع الأنظمة العامة والمحلية
					النافذة والمعمول بها ضمن أراضي المملكة العربية السعودية.
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					13. The Second Party shall have no right to directly or indirectly perform any job or service, or
					engage in any commercial activity except as assigned to him by the First Party, as long as this
					Agreement is in effect.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0 0 4px 0">
					١٣) كما ولا يحق للطرف الثاني أن يعمل بصورة مباشرة أو غير مباشرة في أي وظيفة أو خدمة أو عمل تجاري
					طيلة مدة نفاذ هذا العقد سوى ما يكلفه به الطرف الأول.
				</p>
			</td>
		</tr>

	</table>

	<div style="page-break-after: always;"></div>
	<!-- Page No 3 will start from here -->

	<table role="presentation"
		style="width: 100%; max-width: 767px; margin: 0 auto; border-collapse: separate; table-layout: fixed;">
		<tr>
			<td style="vertical-align: top; padding: 3px 0px;  border: none;padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					14. The Second Party agrees to depart from the Kingdom of Saudi Arabia immediately upon termination
					of this agreement by either party in accordance with its terms except if he remains in the Kingdom
					with the agreement of the First Party and the authorities concerned.
				</p>
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none; direction: rtl; text-align: right;padding-left:20px;">
				<p style="margin: 0">
					١٤). يوافق الطرف الثاني على مغادرة المملكة العربية السعودية فور إنهاء هذا العقد من قبل أحد الطرفين،
					إلا في حالة موافقة الطرف الأول والسلطات المختصة
				</p>
			</td>
		</tr>
		<tr>
			<td style="width: 50%;padding: 3px 0px; border: none; line-height: 1.2; color: #1f2937; font-weight: 400;">
				15. This agreement may be terminated in any of the following cases:
			</td>
			<td style="width: 50%;vertical-align: top; direction: rtl; text-align: right;padding-left:20px;">
				١٥) يجوز إنهاء هذا العقد في إحدى الحالات الآتية:
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding-right:20px;">(a) At any time by a 30 days written notice from
				either of the two parties or immediately upon serving such notice and after making to the other party a
				payment of wages in lieu of the notice period of 30 days.</td>
			<td style="vertical-align: top; direction: rtl; text-align: right;padding-left:20px;">(أ) في أي وقت بتقديم
				إنذار قبل ثلاثين
				يوماً من قبل أي من الطرفين أو فور تقديم الإنذار للطرف الآخر ودفع المستحقات متى ما كانت مدة الإنذار
				ثلاثين يوماً.</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding-right:20px;">(b) By the First Party, without need for any notice or
				cash payment in lieu thereof or award of compensation by reasons of any infractions committed by the
				Second Party, determined by the Labour and Workman Law in Article 83 thereof.</td>
			<td style="vertical-align: top; direction: rtl; text-align: right;padding-left:20px;">(ب) من قبل الطرف الأول
				بدون الحاجة إلى
				الإنذار أو الدفع النقدي بدلاً عنه، أو التعويض بسبب أية مخالفات من قبل الطرف الثاني حسب ما هو مذكور في
				قانون العمل والعمال في مادة (٨٣) (٨٣) من قانون العمل.</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding-right:20px;">(c) By the First Party, in the course of the first
				three months which shall be considered a probation period under the provisions of the law, in which case
				the First Party will bear the cost of transportation of the Second Party.</td>
			<td style="vertical-align: top; direction: rtl; text-align: right;padding-left:20px;">(ج) من قبل الطرف الأول
				خلال الأشهر
				الثلاثة الأولى والتي تُعتبر فترة تجربة، وفي هذه الحالة يتحمل الطرف الأول تكاليف سفر الطرف الثاني.</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none;  ">
				16. In case of death of Second Party in Saudi Arabia while employed with the First Party in terms of
				this contract, it would be the responsibility of the First Party to dispatch the dead body and personal
				belongings to his next of kin in the country of his origin.
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none;   direction: rtl; text-align: right;padding-left:20px;">
				١٦) في حالة وفاة الطرف الثاني بالمملكة العربية السعودية أثناء توظيفه لدى الطرف الأول، يكون الطرف الأول
				مسؤولاً عن ترحيل الجثمان والممتلكات الشخصية إلى أقرب الأقربين في بلاده الأصلية.
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;">
				17. Both parties acknowledge that this Agreement cancels and supersedes all agreements prior to the date
				thereof, if any, and after the execution of this agreement neither party shall claim to have any right,
				privilege, or benefit other than those mentioned herein. Exception is however made in respect of the
				Second Party's right to an end-of-service award and unutilised annual vacations up to the date of
				execution
				of this Agreement.
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;padding-left:20px;">
				١٧) يقر الطرفان أن هذا العقد يلغي ويحل محل جميع الاتفاقيات السابقة - إن وجدت - ولا يحق لأي من الطرفين
				بعد توقيع هذا العقد المطالبة بأي حق أو امتياز سوى ما ورد فيه، ويُستثنى من ذلك حق الطرف الثاني في مكافأة
				نهاية الخدمة والإجازات السنوية غير المستخدمة حتى تاريخ تنفيذ هذا العقد.
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;">
				18. The First Party acknowledges that it shall be fully responsible for payment of death compensation,
				including blood money, on behalf of the Second Party should the latter be held guilty of causing the
				death of a third party and is required to pay any compensation, including blood money, to the next of
				kin of the deceased.
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;padding-left:20px;">
				١٨) يقر الطرف الأول بأنه سيكون مسؤولاً عن دفع تعويض الوفاة بما في ذلك الدية، نيابة عن الطرف الثاني إذا
				ثبتت مسؤوليته عن وفاة طرف ثالث ويجب عليه دفع التعويض لذوي المتوفى.
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;">
				19. This agreement has been drawn up in triplicate, one copy for each party and the third copy to be
				kept in the Second Party’s file with the First Party, all copies having been signed by the two parties
				in acknowledgement of their agreement to the contracts thereof in the presence of the witnesses for its
				execution.
			</td>
			<td
				style="vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;padding-left:20px;">
				١٩) حرر هذا العقد من ثلاث نسخ، وسلمت نسخة لكل طرف واحتفظت النسخة الثالثة في ملف الطرف الثاني لدى الطرف
				الأول بعد توقيع الطرفين بالموافقة على ما جاء فيها بحضور شهود تنفيذ العقد.
			</td>
		</tr>
	</table>

	{{-- <div style="page-break-after: always;"></div> --}}
	<!-- Page 4 will start from here -->
	<table role="presentation"
		style="width: 100%; max-width: 767px; margin: 0 auto; border-collapse: separate; table-layout: fixed;">
		<tr>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;width: 50%;">
				<p style="margin: 0 0 4px 0">
					20. This employment contract will be the only valid contract and any subsequent contract entered
					into
					between the employer and employee in substitution of this contract will have no validity vis-a-vis
					this agreement.
				</p>
			</td>
			<td style="width: 50%; vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;width: 50%;"
				lang="ar">
				<p style="margin: 0 0 4px 0">
					٢٠) سيعتبر هذا العقد ساري المفعول وإن أي عقد لاحقاً ما بين صاحب العمل والعامل فإن هذا لا يعتبر
					صالحاً فيما يتعلق بهذا العقد.
				</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					21. A representative of the Indian Embassy in Saudi Arabia can visit camp sites of Indian workers to
					inspect living and working conditions and their welfare.
				</p>
			</td>
			<td style="vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;padding-left:20px;"
				lang="ar">
				<p style="margin: 0 0 4px 0">
					٢١) إن مندوباً من السفارة الهندية بالمملكة العربية السعودية له حق زيارة مخيم العمال الهنود لمعرفة
					أحوالهم المعيشية والوظيفية ورفاهيتهم. </p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; padding: 3px 0px; border: none; padding-right:20px;">
				<p style="margin: 0 0 4px 0">
					22. Either party can terminate this agreement any time before its expiry by giving 30 days notice to
					the other party.<br>
					The effective date of this Agreement is ..........<br>
					Corresponding to ....................
				</p>
			</td>
			<td style="vertical-align: top; padding: 3px 0px; border: none;  direction: rtl; text-align: right;padding-left:20px;"
				lang="ar">
				<p style="margin: 0 0 4px 0">
					٢٢) للطرفين حق إنهاء هذا العقد في أي وقت قبل انتهائه بإعطاء إنذار مسبق ثلاثين يوماً من أي طرف إلى
					الطرف الآخر.<br>
					تاريخ نفاذ هذا العقد هو ..........<br>
					الموافق ....................
				</p>
			</td>
		</tr>





	</table>


	<!-- Signature Section -->
	<div style="width: 100%; position: relative; margin-top:20px;">

		<!-- Left Section (1st Party) -->
		<div style="float: left; width: 50%; text-align: center;">

			<!-- Signature -->
			<div style="width:100%;">
				<div style="float:left;width:160px">
					<div style=" width:160px; height:100px; 
            background-image: url('{{ public_path('storage/' . $candidate->passportDetail->feSign->attachment) }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;">
					</div>
					<p style="margin: 0;">Signature of First Party</p>
				</div>

				<!-- Stamp (if not individual) -->
				@if ($candidate->passportDetail->individual_or_company != 'individual')
				<div style="float:right; width:160px; height:100px; 
            background-image: url('{{ public_path('storage/' . $candidate->passportDetail->feStamp->attachment) }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;">
				</div>
				@endif
			</div>


		</div>

		<!-- Right Section (Agency Signatory) -->
		<div style="float: right; width: 50%; text-align: center;">
			<div style="width:100%;">
				<div style="float:left; display:inline-block; margin-right:20px; width:160px; height:100px; 
            background-image: url('{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_sign) }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;">
				</div>

				<div style="float:right;display:inline-block; width:160px; height:100px; 
            background-image: url('{{ public_path('storage/' . $candidate->passportDetail->raDocument->ra_stamp) }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;">
				</div>
			</div>

			<div style="margin-top:0px;">
				<p>Authorized Signatory</p>
				<p>Signature of Indian Recruitment Agency</p>
			</div>
		</div>

		<div style="clear:both;"></div>
		<div style="width: 100%; margin-top:20px;text-align: center;">

			<!-- Candidate Signature -->
			<div style="width:160px; height:100px; margin: 0 auto;
        background-image: url('{{ public_path('storage/' . $candidate->passportDetail->candidate_sign) }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;">
			</div>

			<p style="margin: 0;">Signature of Second Party</p>
		</div>

	</div>




</body>

</html>