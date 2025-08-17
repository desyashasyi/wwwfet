<?php

namespace App\Models\FetNet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'fetnet_cluster';
    public function program(){
        return $this->hasMany(Program::class, 'program_id','id' );
    }
    public function base(){
        return $this->belongsTo(ClusterBase::class, 'cluster_base_id','id' );
    }
}
