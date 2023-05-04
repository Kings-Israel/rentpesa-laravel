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
    $rules = [
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

    if (auth()->user()->hasRole('admin')) {
      $rules = array_merge($rules, [
        'plUserType' =>'required',
        'plPropertyLandlord' => 'required_without_all:plPropertyFirstName,plPropertyFirstName,plPropertyEmail,plPropertyContact,password',
        'plPropertyFirstName' =>'required_without:plPropertyLandlord',
        'plPropertyLastName' =>'required_without:plPropertyLandlord',
        'plPropertyEmail' =>'required_without:plPropertyLandlord',
        'plPropertyContact' =>'required_without:plPropertyLandlord',
        'password' =>'required_without:plPropertyLandlord|confirmed',
      ]);
    }

    return $rules;
  }

  public function messages()
  {
    $messages = [
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

    if (auth()->user()->hasRole('admin')) {
      $messages = array_merge($messages, [
        'plUserType.required' => 'Please select the user type',
        'plPropertyFirstName.required_without' => 'Please enter the first name',
        'plPropertyLastName.required_without' => 'Please enter the last name',
        'plPropertyEmail.required_without' => 'Please enter the email',
        'plPropertyEmail.unique' => 'Email Already Exists',
        'plPropertyContact.required_without' => 'Please enter the contact',
        'password.required_without' => 'Please enter the password',
      ]);
    }

    return $messages;
  }
}
