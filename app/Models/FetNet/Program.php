<?php

namespace App\Models\FetNet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'institution_program';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id','id' );
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function cluster(){
        return $this->hasOne(Cluster::class, 'program_id','id' );
    }
}
