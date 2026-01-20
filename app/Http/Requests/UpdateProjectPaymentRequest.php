<?php

namespace App\Http\Requests;

use App\Models\ProjectPayment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectPaymentRequest extends FormRequest
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
        $rules = ProjectPayment::$rules;
        
        return $rules;
    }
}
