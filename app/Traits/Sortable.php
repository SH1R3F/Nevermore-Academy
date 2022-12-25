<?php

namespace App\Traits;

trait Sortable
{
    public function scopeSort($query, $request)
    {
        $col  = $request->sortBy;
        $type = $request->sortType;

        if (!$col) return $query->orderBy('id', 'ASC');

        if ($col === 'role') $col = 'role_id';

        return $query->orderBy($col, $type);
    }
}
