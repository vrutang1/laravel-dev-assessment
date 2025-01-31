<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'job';

    protected $fillable = [
        'title',
        'description',
        'experience',
        'salary',
        'location',
        'extra_info',
        'company_name',
        'logo',
        'created_by',
        'updated_by',
    ];

    public function jobSkills()
    {
        return $this->hasMany(JobSkill::class ,'job_id','id');
    }
}
