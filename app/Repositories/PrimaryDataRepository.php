<?php

namespace App\Repositories;

use App\Models\PrimaryData;

class PrimaryDataRepository extends BasePrimaryDataRepository
{
    public function model(): string
    {
        return PrimaryData::class;
    }
}




// namespace App\Repositories;

// use App\Models\PrimaryData;
// use App\Repositories\BaseRepository;

// class PrimaryDataRepository extends BaseRepository
// {
//     protected $fieldSearchable = [
//         'Accomodation',
//         'Approved',
//         'Cancel',
//         'Career',
//         'CareerAddress',
//         'CaseDate',
//         'DateOfBirth',
//         'Email',
//         'FamilyCount',
//         'FileNo',
//         'HeadRemarks',
//         'HouseType',
//         'IBAN',
//         'IDExpiry',
//         'IDNo',
//         'InSchool',
//         'LastUpdate',
//         'MaritalStatus',
//         'mob',
//         'Nam',
//         'NamEn',
//         'Nationality',
//         'Permission_Date',
//         'Permission_No',
//         'Region',
//         'Renew_Date',
//         'Revised',
//         'Section',
//         'Sex',
//         'Tel1',
//         'Tel2',
//         'Trustee',
//         'TrusteeEn',
//         'UserAdd',
//         'UserEdit',
//         'WifeAddress',
//         'WifeCareer',
//         'WifeName',
//         'WifeNationality'
//     ];

//     public function getFieldsSearchable(): array
//     {
//         return $this->fieldSearchable;
//     }

//     public function model(): string
//     {
//         return PrimaryData::class;
//     }
//     public function create(array $data)
//     {
//         return PrimaryData::create($data);
//     }
//     public function delete(int $id)
//     {
//         \Log::info('thi is the destory function so sell tell second' . $id);
//         return PrimaryData::destroy($id);
        
//         /*$primaryData = PrimaryData::find($id);

//         if (!$primaryData) {
//             return response()->json(['error' => 'Primary data not found.'], 404);
//         }

//         $primaryData->delete();

//         return response()->json(['success' => 'Primary data deleted successfully.']);*/
//     }
//     public function update(array $data, $id)
//     {
//         //\Log::info('Raw request data:', $request->all());
//         //$data = $request->all();
//         \Log::info("Update called with id: $id");
//         $primaryData = $this->find($id);

//         if (!$primaryData) {
//             \Log::error("No record found with id: $id");
//             return null;
//         }

//         unset($data['_method'], $data['_token']);

//         \Log::info('Incoming data after cleanup:', $data);

//         $primaryData->fill($data);

//         \Log::info('Model before save:', $primaryData->toArray());

//         \Log::info('Original attributes before save:', $primaryData->getOriginal());
//         \Log::info('Current attributes before save:', $primaryData->getAttributes());

//         $primaryData->save();

//         \Log::info('Attributes after save:', $primaryData->fresh()->getAttributes());

//         if ($primaryData->isDirty()) {
//             \Log::info('Model is dirty — saving changes');
//             $primaryData->save();
//         } else {
//             \Log::warning('Model is NOT dirty — no changes detected');
//         }

//         \Log::info('Saved. Name: ' . $primaryData->Nam);

//         return $primaryData;
//     }





// }
