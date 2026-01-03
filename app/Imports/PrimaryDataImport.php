<?php

namespace App\Imports;

use App\Models\PrimaryData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PrimaryDataImport implements ToModel, WithHeadingRow
{
    // Override the heading row formatter to preserve keys as-is
    public function headingRow(): int
    {
        return 1;  // assuming first row has headers
    }

    public function headingRowFormatter(string $heading): string
    {
        return $heading;  // preserve original casing and spacing
    }

    public function model(array $row)
    {
        return new PrimaryData([
            'ID'             => $row['id'],           // exact key from Excel header
            'Section'        => $row['section'],
            'FileNo'         => $row['fileno'],
            'Nam'            => $row['nam'],
            'NamEn'          => $row['namen'],
            'Trustee'        => $row['trustee'],
            'TrusteeEn'      => $row['trusteeen'],
            'Sex'            => $row['sex'],
            'Nationality'    => $row['nationality'],
            'Career'         => $row['career'],
            'CareerAddress'  => $row['careeraddress'],
            'FamilyCount'    => $row['familycount'],
            'InSchool'       => $row['inschool'],
            'IDNo'           => $row['idno'],
            'MaritalStatus'  => $row['maritalstatus'],
            'WifeName'       => $row['wifename'],
            'WifeAddress'    => $row['wifeaddress'],
            'WifeCareer'     => $row['wifecareer'],
            'WifeNationality'=> $row['wifenationality'],
            'HouseType'      => $row['housetype'],
            'mob'            => $row['mob'],
            'Tel1'           => $row['tel1'],
            'Tel2'           => $row['tel2'],
            'Email'          => $row['email'],
            'Region'         => $row['region'],
            'CaseDate'       => $this->transformDate($row['casedate']),
            'Approved'       => $row['approved'],
            'UserAdd' => \App\Models\User::where('id', $row['useradd'])->exists() ? $row['useradd'] : 1,
            'UserAdd' => \App\Models\User::where('id', $row['useradd'])->exists() ? $row['useradd'] : 1,
            'LastUpdate'     => $this->transformDate($row['lastupdate']),
            'Cancel'         => $row['cancel'],
            'Permission_No'  => $row['permission_no'],
            'Permission_Date'=> $this->transformDate($row['permission_date']),
            'Renew_Date'     => $this->transformDate($row['renew_date']?? '1000-01-01'),
            'Accomodation'   => $row['accomodation'],
            'DateOfBirth'    => $this->transformDate($row['dateofbirth']),
            'Revised'        => $row['revised'],
            'IBAN'           => $row['iban'],
            'IDExpiry'       => $this->transformDate($row['idexpiry']),
            'HeadRemarks'    => $row['headremarks'],
        ]);
    }

    private function transformDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return $value;
    }
}
