<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignUnitRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('landlord')) {
      return true;
    }

    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'user_id' => 'required',
      'unit_id' => 'required',
      'lease_start_date' => 'required',
      'lease_end_date' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'user_id.required' => 'Select a tenant',
      'unit_id.required' => 'Select a unit',
      'lease_start_date.required' => 'Select start date of lease',
      'lease_end_date.required' => 'Select end date of lease',
    ];
  }
}
