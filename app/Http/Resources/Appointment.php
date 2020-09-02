<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Appointment extends JsonResource
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
            $turn_around_time = sprintf("%02d %s %02d %s %02d %s", floor($t / 3600), "Hrs", ($t / 60) % 60, "Min", $t % 60, "Sec");
        } else {
            $turn_around_time = null;
        }
        return [
            "id" => $this->id,
            "date_received" => $this->date_received,
            "name" => $this->name,
            "position" => $this->position,
            "date_of_effectivity" => $this->date_of_effectivity,
            "needs_revision" => $this->needs_revision,
            "remarks" => $this->remarks,
            "is_complete" => $this->is_complete,
            "date_completed" => $this->date_completed,
            "turn_around_time" => $turn_around_time
        ];
    }
}
