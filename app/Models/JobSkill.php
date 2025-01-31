<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSkill extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'job_skills';

    protected $fillable = [
        'job_id',
        'skill_id',
        'created_by',
        'updated_by'
    ];

    public function skill(){
        return $this->belongsTo(Skill::class,'skill_id','id');
    }
}
