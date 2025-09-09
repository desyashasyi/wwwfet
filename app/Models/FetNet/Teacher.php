<?php

namespace App\Models\FetNet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'fetnet_teacher';

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function program(){
        return $this->belongsTo(Program::class, 'program_id','id' );
    }


}
