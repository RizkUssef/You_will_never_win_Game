<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsertResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->error_image==null){
            $error_image=null;
        }else{
            $error_image=asset("storage")."/".$this->error_image;
        }
        return [
            "question"=>$this->question,
            "answer"=>$this->answer,
            "error_text"=>$this->error_text,
            "error_image"=>$error_image,
        ];
    }
}
