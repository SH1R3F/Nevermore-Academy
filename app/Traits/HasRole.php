<?php

namespace App\Traits;

trait HasRole
{

    public function hasRole($name): Bool
    {
        return $this->role?->name === $name;
    }

    public function hasPermission($slug): Bool
    {
        if (!$this->role) return false;

        return $this->role->permissions->contains('slug', '=', $slug);
    }
}
