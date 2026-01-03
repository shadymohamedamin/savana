<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

abstract class BasePrimaryDataRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'Accomodation', 'Approved', 'Cancel', 'Career', 'CareerAddress',
        'CaseDate', 'DateOfBirth', 'Email', 'FamilyCount', 'FileNo',
        'HeadRemarks', 'HouseType', 'IBAN', 'IDExpiry', 'IDNo', 'InSchool',
        'LastUpdate', 'MaritalStatus', 'mob', 'Nam', 'NamEn', 'Nationality',
        'Permission_Date', 'Permission_No', 'Region', 'Renew_Date',
        'Revised', 'Section', 'Sex', 'Tel1', 'Tel2', 'Trustee', 'TrusteeEn',
        'UserAdd', 'UserEdit', 'WifeAddress', 'WifeCareer', 'WifeName', 'WifeNationality'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function create(array $data)
    {
        return $this->model()::create($data);
    }

    public function delete(int $id)
    {
        return $this->model()::destroy($id);
    }

    public function update(array $data, $id)
    {
        $model = $this->find($id);

        if (!$model) {
            return null;
        }

        unset($data['_method'], $data['_token']);

        $model->fill($data);
        $model->save();

        return $model;
    }

    public function createOrUpdateByIDNo(array $data)
    {
        if (!isset($data['IDNo'])) {
            throw new \InvalidArgumentException('IDNo is required for createOrUpdateByIDNo');
        }

        // Check for existing record by IDNo
        $existing = $this->model()::where('IDNo', $data['IDNo'])->first();

        if ($existing) {
            // 🔁 Update the existing record
            $existing->fill($data);
            $existing->save();
            return $existing;
        } else {
            // ➕ Create new record
            return $this->model()::create($data);
        }
    }
}
