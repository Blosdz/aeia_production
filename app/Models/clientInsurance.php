<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class clientInsurance extends Model
{
    use HasFactory;

    public $table="clientInsurance";

    public $fillable=[
        'status',
        'user_id',
        'profile_id',
        'insurance_id',
    ];

    protected $casts=[
        'status'=>'boolean',
        'user_id'=>'integer',
        'profile_id'=>'integer',
        'insurance_id'=>'integer',
    ];
    public function referred_user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function referred_profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id','id');
    }
    public function insurance(){
        return $this->belongsTo(Insurance::class,'insurance_id');
    }

}
