<?php

namespace Daison\BusRouterSg\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaticViewRequest extends FormRequest
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
        $blades = \Daison\BusRouterSg\Http\Controllers\StaticView::ALLOWED_BLADES;

        return [
            'blade' => sprintf('in:%s', implode(',', $blades)),
        ];
    }
}
