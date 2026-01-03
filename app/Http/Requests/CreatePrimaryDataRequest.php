<?php

namespace App\Http\Requests;

use App\Models\PrimaryData;
use Illuminate\Foundation\Http\FormRequest;

class CreatePrimaryDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return PrimaryData::$rules;
    }
    /*public function rules(): array
    {
        return [
            'Nam'             => 'required|string|max:255',
            'NamEn'           => 'nullable|string|max:255',
            'DateOfBirth'     => 'required|date',
            'Sex'             => 'required|in:0,1', // assuming 0 = male, 1 = female
            'Nationality'     => 'required|integer|exists:nationalities,id',
            'MaritalStatus'   => 'required|integer',
            'FamilyCount'     => 'required|integer|min:0',
            'mob'             => 'required|string|max:20',
            'Tel1'            => 'nullable|string|max:20',
            'Tel2'            => 'nullable|string|max:20',
            'Email'           => 'nullable|email|max:255',
            'WifeName'        => 'nullable|string|max:255',
            'WifeAddress'     => 'nullable|string|max:255',
            'WifeCareer'      => 'nullable|string|max:255',
            'WifeNationality' => 'nullable|integer',
            'Region'          => 'required|integer|exists:regions,id',
            'HouseType'       => 'required|integer',
            'CareerAddress'   => 'nullable|string|max:255',
            'Career'          => 'required|string|max:255',
            'InSchool'        => 'nullable|boolean',
            'FileNo'          => 'nullable|string|max:255',
            'IDNo'            => 'required|string|unique:primary_datas,IDNo',
            'IDExpiry'        => 'nullable|date',
            'IBAN'            => 'nullable|string|max:50',
            'Permission_No'   => 'nullable|integer',
            'Permission_Date' => 'nullable|date',
            'Renew_Date'      => 'nullable|date',
            'Section'         => 'nullable|integer',
            'HeadRemarks'     => 'nullable|string|max:255',
            'Approved'        => 'nullable|boolean',
            'Revised'         => 'nullable|boolean',
        ];
    }*/

}
