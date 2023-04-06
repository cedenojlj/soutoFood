<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Customer
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $pin
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Customer extends Model
{
    use HasFactory;


    static $rules = [
		'name' => 'required',
		'email' => 'required',
		'pin' => 'required',
    ];

    protected $perPage = 25;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
            'email',
            'email2',
            'emailRep',
            'pin'
          ];



}
