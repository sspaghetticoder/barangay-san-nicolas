<?php

namespace App\Models;

use App\Models\Traits\Timestamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = trim($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = trim($value);
    }

    // public function setMiddleNameAttribute($value)
    // {
    //     $this->attributes['middle_name'] = trim($value);
    // }

    protected function middleName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? 'N/A' : $value,
            set: fn ($value) => trim($value),
        );
    }

    protected function suffix(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? 'N/A' : $value,
            set: fn ($value) => trim($value),
        );
    }

    // public function setSuffixAttribute($value)
    // {
    //     $this->attributes['suffix'] = ;
    // }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim($value);
    }

    public function setContactNumberAttribute($value)
    {
        $this->attributes['contact_number'] = trim($value);
    }

    public function setHouseNumberAttribute($value)
    {
        $this->attributes['house_number'] = trim($value);
    }

    public function setStreetAttribute($value)
    {
        $this->attributes['street'] = trim($value);
    }

    public function setAreaAttribute($value)
    {
        $this->attributes['area'] = trim($value);
    }

    public function getGenderNameAttribute()
    {
        return self::GENDERS[$this->attributes['gender']];
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->attributes['first_name']) . ' ' . ucfirst($this->attributes['middle_name'])[0] . '. ' . ucfirst($this->attributes['last_name'])
            . ' ' . ucfirst($this->attributes['suffix']);
    }

    public function getPrefixedLastNameAttribute()
    {
        return ($this->gender_name === self::GENDERS['m'] ? 'Mr.' : 'Ms.') . ' ' . $this->attributes['last_name'];
    }

    public function getPronounAttribute()
    {
        return ($this->gender_name === self::GENDERS['m'] ? 'He' : 'She');
    }

    public function getAdjectiveAttribute()
    {
        return ($this->gender_name === self::GENDERS['m'] ? 'his' : 'her');
    }

    public function getCompleteAddressAttribute()
    {
        return $this->attributes['house_number'] . ' ' . $this->attributes['street'] . ' ' . $this->attributes['area'] . ' ' . config('setting.barangay') . ', ' . config('setting.city');
    }

}
