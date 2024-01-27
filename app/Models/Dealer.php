<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dealers';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'dealer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dealer_name',
        'address',
        'phone',
        'user_id',
        'VIN',
        'manufacturer_id',
        'area',
    ];

    /**
     * Define a relationship with the Inventory model.
     * Dealer has many Inventory items using 'dealer_id' as the foreign key.
     */
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'dealer_id');
    }
}
