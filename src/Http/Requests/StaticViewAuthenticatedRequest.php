<?php

namespace Daison\BusRouterSg\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaticViewAuthenticatedRequest extends FormRequest
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
        return [
            'blade' => sprintf('in:%s', implode(',', \Daison\BusRouterSg\Http\Controllers\StaticViewAuthenticated::ALLOWED_BLADES)),
        ];
    }
}