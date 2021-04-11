<?php

namespace App\Models;

use App\Models\brands;
use App\Models\Category;
use App\Models\ProductSizeStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;


  /**
   * Get the category that owns the Product
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function category()
  {
      return $this->belongsTo(Category::class);
  }
    /**
   * Get the Brand that owns the Product
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function brand()
  {
      return $this->belongsTo(brands::class);
  }
  /**
   * Get all of the product_size_stock for the Product
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function product_size_stock()
  {
      return $this->hasMany(ProductSizeStock::class);
  }
}
