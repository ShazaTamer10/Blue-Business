<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;
    protected $fillable = ['portfolio_item_id', 'image'];

    public function portfolioItem()
    {
        return $this->belongsTo(PortfolioItem::class);
    }
}
