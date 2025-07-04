<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Dom\Text;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Scope;



class Stock extends Model
{
    protected $table = 'stocks';

    protected $fillable = [
        'barang_id',
        'gudang_id',
        'balance',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id', 'id');
        // return $this->belongsTo(Gudang::class);
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiStock::class, 'stock_id', 'id');
    }
    #public function hasBalance(Builder $query): void
    #{
    #    $query->where('balance','>',0);
    #}
    #[Scope]
    public function hasBalance(Builder $query): void
    {
        $query->where('balance', '>', 0);
    }
    #[Scope]
    public function noBalance(Builder $query): void
    {
        $query->where('balance', 0);
    }
}
