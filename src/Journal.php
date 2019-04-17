<?php

namespace Robconvery\LaravelJournal;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $guarded = [];
    protected $dates = [
        'created_at'
    ];

    /**
     * @return array
     */
    public function getEntryAsArrayAttribute(): array
    {
        return explode("\n", $this->entry);
    }
}
