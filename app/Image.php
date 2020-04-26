<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the owning imageable model.
     *
     * @return mixed
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
