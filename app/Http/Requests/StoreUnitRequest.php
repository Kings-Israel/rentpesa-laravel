<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
      'property_id' => 'required',
      'unit_number' => 'required',
      'unit_type_id' => 'required',
      'billing_frequency_id' => 'required',
      'floor_number' => 'required',
      'rent' => 'required',
      'deposit' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'property.required' => 'Select the property',
      'unit_number.required' => 'Enter the unit number',
      'unit_type_id.required' => 'Select the unit type',
      'billing_frequency.required' => 'Select the billing frequency',
      'floor_number.required' => 'Enter the floor number',
      'rent.required' => 'Enter the rent amount',
      'deposit.required' => 'Enter the deposit to be paid',
    ];
  }
}
