


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <style>
        @font-face {
            font-family: 'Amiri';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/Amiri-Regular.ttf') }}") format('truetype');
        }

        body {
            font-family: 'Amiri', DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
        }

        .center {
            text-align: center;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
        }

        .file-number {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }
    </style>
</head>
<body>

    <div class="center">
        <!-- <h2>مؤسسة رأس الخيمة للأعمال الخيرية</h2> -->
        <img src="{{ public_path('images/rak-logo-ar-en.png') }}" alt="Logo" style="width: 300px; height: 50px; ">
        <h3>طلب مساعدة</h3>
        <!-- <h2>Ras AlKhaimah Charity Association</h2> -->
    </div>


    <table>
        <tr>
            <td><strong>رقم الملف:</strong> {{ $support->caseid->FileNo ?? '' }}</td>
            <td><strong>تاريخ الطلب:</strong> {{ \Carbon\Carbon::parse($support->Application_Date)->format('Y-m-d') ?? '' }}</td>
            <td><strong>فئة:</strong> {{ $support->caseid->Section == 1 ? 'مواطن' : 'وافد' }}</td>
        </tr>
        <tr>
            <td><strong>رقم الهوية:</strong> {{ $support->caseid->IDNo ?? '' }}</td>
            <td><strong>المستفيد:</strong> {{ $support->caseid->Nam ?? '' }}</td>
            <td><strong>الجنسية:</strong> {{ $support->caseid->nationality->Nationality ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>المتحرك:</strong> {{ $support->caseid->mob ?? '' }}</td>
            <td><strong>المنطقة:</strong> {{ $support->caseid->region->Region ?? '' }}</td>
            <td><strong>عدد الأفراد:</strong> {{ $support->caseid->FamilyCount ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>المساعدة المطلوبة:</strong> {{ $support->supportrequiredarch->SupportType ?? 'ddd' }}</td>
            <td><strong>رقم التصريح:</strong> {{ $support->caseid->Permission_No ?? '' }}</td>
            <td></td>
        </tr>
    </table>

    <div style="border-bottom: 3px solid black; margin-top: 3px;"></div>
    <div><h3 class="center">قرار لجنة المساعدات</h3></div>
    <div style="border-bottom: 3px solid black; margin-bottom: 10px;"></div>

    <table>
        <tr>
            <td><strong>تاريخ القرار:</strong> {{ \Carbon\Carbon::parse($support->Dat)->format('Y-m-d') ?? '' }}</td>
            <td><strong>الإجراء:</strong> {{ $support->supporttype->SupportType ?? '' }}</td>
            <td><strong>المبلغ:</strong> {{ number_format($support->SupportAmount??0) }} درهم</td>
            <td><strong>المدة:</strong> {{ $support->NeedAmount ?? '' }}</td>
        </tr>
    </table>
    
    <!-- @php
        $total_income = $support->SalaryArch + $support->WifeSalaryArch + $support->IncomeArch + $support->ChildrenInArch + $support->OtherSalaryArch;
    @endphp -->


    @php
        $section = $support->caseid->Section;
        $familyCount = $support->caseid->FamilyCount;

        // Standard of Living Mapping
        $livingScale = 0;

        if ($section == 0) {
            $scaleMap = [1 => 1800, 2 => 3000, 3 => 3600, 4 => 4200, 5 => 4800, 6 => 5400, 7 => 6000, 8 => 6600, 9 => 7200];
            $livingScale = $scaleMap[$familyCount] ?? 7800;
        } elseif ($section == 1) {
            $scaleMap = [1 => 4400, 2 => 7000, 3 => 8300, 4 => 9600, 5 => 10900, 6 => 12200, 7 => 13500, 8 => 14800, 9 => 16100, 10 => 17400, 11 => 18700];
            $livingScale = $scaleMap[$familyCount] ?? 20000;
        }

        // Income & Obligation totals
        $totalIncome = $support->SalaryArch + $support->WifeSalaryArch + $support->IncomeArch + $support->ChildrenInArch + $support->OtherSalaryArch;
        $totalObligation = $support->RentArch + $support->LoanArch + $support->ChildrenOutArch + $support->BankArch + $support->FeesArch;

        if ($section == 1) {
            $totalIncome += $support->OfflineSalaryArch + $support->SocialSalaryArch;
            $totalObligation += $support->ServantArch + $support->DriverArch + $support->CourtArch + $support->EleWaterArch + $support->HouseArch + $support->FurnatureArch + $support->CarArch;
        }

        // Deficit or Surplus
        $surplusDeficit = $totalIncome - $totalObligation - $livingScale;
    @endphp
    <h4>دخل الحالة</h4>
    <table>
        <tr>
            <th>الراتب</th>
            <th>راتب الزوج/ة</th>
            <th>دخل تجاري</th>
            <th>نفقة الأبناء</th>
            <th>دخل آخر</th>
            @if($section == 1)
                <th> الراتب التقاعدي</th>
                <th>مساعدة الشؤون  </th>
            @endif
            <th style="background-color: #dcedc8;">إجمالي الدخل</th>
        </tr>
        <tr>
            <td>{{ $support->SalaryArch }}</td>
            <td>{{ $support->WifeSalaryArch }}</td>
            <td>{{ $support->IncomeArch }}</td>
            <td>{{ $support->ChildrenInArch }}</td>
            <td>{{ $support->OtherSalaryArch }}</td>
            @if($section == 1)
                <td>{{ $support->OfflineSalaryArch }}</td>
                <td>{{ $support->SocialSalaryArch }}</td>
            @endif
            <td style="background-color: #dcedc8;">{{ $totalIncome }}</td>
        </tr>
    </table>


    <!-- @php
        $total_expenses = $support->RentArch + $support->LoanArch + $support->ChildrenOutArch + $support->BankArch + $support->FeesArch;
    @endphp -->
    <h4>الالتزامات</h4>
    <table>
        <tr>
            <th>الإيجار</th>
            <th>رسوم دراسية</th>
            <th>ديون بنكية</th>
            <th>نفقة الأبناء</th>
            <th>التزامات أخرى</th>
            @if($section == 1)
                <th>خادمة</th>
                <th>سائق</th>
                <th>محكمة</th>
                <th>كهرباء وماء</th>
                <th>منزل</th>
                <th>أثاث</th>
                <th>سيارة</th>
            @endif
            <th style="background-color: #ffecb3;">إجمالي الالتزامات</th>
        </tr>
        <tr>
            <td>{{ $support->RentArch }}</td>
            <td>{{ $support->FeesArch }}</td>
            <td>{{ $support->BankArch }}</td>
            <td>{{ $support->ChildrenOutArch }}</td>
            <td>{{ $support->LoanArch }}</td>
            @if($section == 1)
                <td>{{ $support->ServantArch }}</td>
                <td>{{ $support->DriverArch }}</td>
                <td>{{ $support->CourtArch }}</td>
                <td>{{ $support->EleWaterArch }}</td>
                <td>{{ $support->HouseArch }}</td>
                <td>{{ $support->FurnatureArch }}</td>
                <td>{{ $support->CarArch }}</td>
            @endif
            <td style="background-color: #ffecb3;">{{ $totalObligation }}</td>
        </tr>
    </table>

    <h4>نتيجة الدراسة</h4>
    <table>
        <tr>
            <th>مجموع الدخل</th>
            <th>مجموع الالتزامات</th>
            <th>مقياس حد المعيشة</th>
            <th>نسبة العجز أو الفائض</th>
        </tr>
        <tr>
            <td style="background-color: #e0f7fa;">{{ $totalIncome }}</td>
            <td style="background-color: #ffe0b2;">{{ $totalObligation }}</td>
            <td>{{ $livingScale }}</td>
            <td style="background-color: {{ $surplusDeficit < 0 ? '#ffcccc' : '#ccffcc' }};">
                {{ $surplusDeficit }}
            </td>
        </tr>
    </table>



    
    
    
    
    <h4>ملخص عن الحالة:</h4>
    <p>{{ $support->CaseDescription ?? '' }}</p>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; margin-top: 20px;">
        <div style="text-align: right;">الوصي إن وجد: {{ $support->caseid->trustee ?? '' }}</div>
        <div style="text-align: left;">الباحث: {{ $support->searcherarch->name ?? '' }}</div>
    </div>











    
    <h4>جدول مقياس حد المعيشة</h4>
    <table>
        <tr>
            <th>عدد الأفراد</th>
            @foreach(range(1, 12) as $count)
                <th>{{ $count }}</th>
            @endforeach
        </tr>
        <tr>
            <th>الحد الأدنى للمعيشة</th>
            @foreach(range(1, 12) as $count)
                @php
                    if($section == 0) {
                        $value = $scaleMap[$count] ?? 7800;
                    } else {
                        $value = $scaleMap[$count] ?? 20000;
                    }
                @endphp
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    </table>




</body>
</html>
