<?php

namespace App\Http\Resources\hrdms;

use Illuminate\Http\Resources\Json\JsonResource;

class HrdmsPlantilla extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    // public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        if ($this->turn_around_time) {
            $t = $this->turn_around_time;
            $turn_around_time = sprintf("%02d%s%02d%s%02d%s", floor($t / 3600), "h:", ($t / 60) % 60, "m:", $t % 60, "s");
        } else {
            $turn_around_time = null;
        }
        return [
            "id" => $this->id,
            "date_received" => $this->date_received,
            "date1" => $this->date1,
            "date2" => $this->date2,
            "description" => $this->description,
            "needs_revision" => $this->needs_revision,
            "remarks" => $this->remarks,
            "is_complete" => $this->is_complete,
            "date_completed" => $this->date_completed,
            "turn_around_time" => $turn_around_time
        ];
    }
}
