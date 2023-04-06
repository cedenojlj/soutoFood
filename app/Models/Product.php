<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 *
 * @property $id
 * @property $itemnumber
 * @property $name
 * @property $description
 * @property $upc
 * @property $pallet
 * @property $price
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    use HasFactory;


    static $rules = [
		'itemnumber' => 'required',
		'name' => 'required',
		'description' => 'required',
		'upc' => 'required',
		'pallet' => 'required',
		'price' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 25;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['itemnumber','name','description','upc','pallet','price','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    public function ordersdetails(): HasMany
    {
        return $this->hasMany(Ordersdetail::class);
    }

}
