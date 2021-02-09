<?php

namespace App\Http\Resources\selects;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "text" => $this->full_name,
            "value" => $this->id,
            "department_id" => $this->department_id,
            "department"=> $this->department
        ];
    }
}
