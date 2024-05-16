<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use App\Traits\HasCreaterAndUpdater;

class File extends Model
{
    use HasFactory, HasCreaterAndUpdater ,NodeTrait, SoftDeletes;

    public function isOwnedBy($userId): bool
    {
        return $this->created_by == $userId;
    }
}
