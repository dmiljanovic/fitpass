<?php

namespace Modules\Event\Http\Requests;

use App\Traits\RequestQueryParams;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PurchaseEventRequest extends FormRequest
{
    use RequestQueryParams;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id'  => 'required|exists:events,id',
            'email'     => 'required|email'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'    => $validator->errors()
        ]));
    }
}
