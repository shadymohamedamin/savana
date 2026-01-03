<?php

namespace App\Imports;

use App\Models\Support;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SupportsImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function headingRowFormatter(): string
    {
        return 'none';
    }

    public function model(array $row)
    {
        if (!\App\Models\User::where('id', $row['caseid'])->exists()) {
            \Log::warning("Skipping attachment for missing user ID: " . $row['caseid']);
            return null;
        }
        return new Support([
            'ID' => $row['id'] ?? null,
            'Dat' => $this->transformDate($row['dat'] ?? null),
            'CaseID' => $row['caseid'] ?? null,
            'SupportRequiredArch' => $row['supportrequiredarch'] ?? null,
            'SupportType' => $row['supporttype'] ?? null,
            'NeedAmount' => $row['needamount'] ?? null,
            'SupportAmount' => $row['supportamount'] ?? null,
            'Note' => $row['note'] ?? null,
            'SalaryArch' => $row['salaryarch'] ?? null,
            'IncomeArch' => $row['incomearch'] ?? null,
            'WifeSalaryArch' => $row['wifesalaryarch'] ?? null,
            'OfflineSalaryArch' => $row['offlinesalaryarch'] ?? null,
            'SocialSalaryArch' => $row['socialsalaryarch'] ?? null,
            'OtherSalaryArch' => $row['othersalaryarch'] ?? null,
            'ChildrenInArch' => $row['childreninarch'] ?? null,
            'LoanArch' => $row['loanarch'] ?? null,
            'RentArch' => $row['rentarch'] ?? null,
            'DriverArch' => $row['driverarch'] ?? null,
            'FeesArch' => $row['feesarch'] ?? null,
            'ServantArch' => $row['servantarch'] ?? null,
            'EleWaterArch' => $row['elewaterarch'] ?? null,
            'HouseArch' => $row['housearch'] ?? null,
            'BankArch' => $row['bankarch'] ?? null,
            'FurnatureArch' => $row['furnaturearch'] ?? null,
            'CarArch' => $row['cararch'] ?? null,
            'CourtArch' => $row['courtarch'] ?? null,
            'ChildrenOutArch' => $row['childrenoutarch'] ?? null,
            'SearcherArch' => $row['searcherarch'] ?? null,
            'CaseDescription' => $row['casedescription'] ?? null,
            'Application_Date' => $this->transformDate($row['application_date'] ?? null),
            'AppRemarks' => $row['appremarks'] ?? null,
        ]);
    }

    private function transformDate($value)
    {
        if (!$value) return null;

        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning("Invalid date value: $value");
                return null;
            }
        }

        // Already a string date
        return date('Y-m-d', strtotime($value));
    }
}
