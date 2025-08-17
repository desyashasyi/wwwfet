<?php

namespace App\Models\FetNet;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'fetnet_students';

    public function children(){
        return $this->hasMany(Student::class, 'parent_id','id' );
    }
}
