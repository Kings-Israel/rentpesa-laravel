<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'name' => $this->name,
          'date_added' => $this->created_at->format('d M Y'),
          'agreement_startdate' => Carbon::parse($this->agreement_start_date)->format('d M Y'),
          'agreement_enddate' => Carbon::parse($this->agreement_end_date)->format('d M Y')
        ];
    }
}
