<?php

namespace App\Models\FetNet;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ActivityTeacher extends Pivot
{
    //
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'fetnet_activity_teachers';
}
