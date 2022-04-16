<?php

namespace App\Models;

use App\Models\Traits\Timestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Timestamps;

    protected $primaryKey = 'full_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'full_id',
        'name',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'email',
        'contact_number',
        'gender',
        'house_number',
        'street',
        'area',
        'place_of_birth',
        'birth_date',
    ];

    public const GENDERS = [
        'm' => 'Male',
        'f' => 'Female',
    ];

    public const HOUSE_NUMBER_ALIAS = 'Street / Unit / Home #';
    public const AREA_ALIAS = 'Subdivision / Village / Building';

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $latestOrder = self::orderBy('id','DESC')->first();
            
            $model->full_id =  now()->format('y') . '-' . str_pad(($latestOrder->id ?? 0) + 1, 6, "0", STR_PAD_LEFT);

            $model->name = $model->first_name . ' ' . $model->last_name;
        });

        self::updating(function($model){
            $model->name = $model->first_name . ' ' . $model->last_name;
        });
    }

    public function getGenderNameAttribute()
    {
        return self::GENDERS[$this->attributes['gender']];
    }
}
