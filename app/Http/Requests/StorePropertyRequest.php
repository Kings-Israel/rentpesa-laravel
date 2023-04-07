<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'plName' => 'required',
            'plPropertyType' => 'required',
            'plPropertyCounty' => 'required',
            'plPropertySubcounty' => 'required',
            'plPropertyStreet' => 'required',
            'plAgreementStartDate' => 'required',
            'plAgreementEndDate' => 'required',
            'plCoverImage' => 'required',
            'plRentPaymentDay' => 'required',
            'plLatePaymentCharge' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'plName.required' => 'Please enter the property name',
            'plPropertyType.required' => 'Please select the property type',
            'plPropertyCounty.required' => 'Please select the county',
            'plPropertySubcounty.required' => 'Please select the sub county',
            'plPropertyStreet.required' => 'Please enter the street/road',
            'plAgreementStartDate.required' => 'Please enter the agreement start date',
            'plAgreementEndDate.required' => 'Please enter the agreement end date',
            'plRentPaymentDay.required' => 'Please enter the rent payment day',
            'plLatePaymentCharge.required' => 'Please enter the late rent payment charge',
        ];
    }
}
