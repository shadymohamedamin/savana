<?php

namespace App\Http\Requests;

use App\Models\ProjectSupervision;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectSupervisionRequest extends FormRequest
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
        $rules = ProjectSupervision::$rules;

        $rules['attachment'] = 'nullable|file|max:10240';
        $rules['attachment1'] = 'nullable|file|max:10240';
        $rules['attachment2'] = 'nullable|file|max:10240';
        $rules['attachment3'] = 'nullable|file|max:10240';
        
        return $rules;
    }
}
