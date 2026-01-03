<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttachmentRequest extends FormRequest
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
    /*public function rules()
    {
        $rules = Attachment::$rules;
        
        return $rules;
    }*/
    public function rules()
    {
        return [
            'CaseID' => 'required|integer',
            'AttID' => 'required|integer',
            'AttFile' => 'nullable|file|mimes:pdf|max:10240',
            'Remarks' => 'nullable|string',
        ];
    }

}
