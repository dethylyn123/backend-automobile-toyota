<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'models';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'model_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_name',
        'category',
        'user_id',
        'brand_id',
    ];

    // Establish a belongsTo relationship with the Brand model
    // 'Brand::class' specifies the related model class
    // 'brand_id' is the foreign key column in the Vehicle model
    // 'brand_id' is the primary key column in the Brand model
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}
