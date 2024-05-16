<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait HasCreaterAndUpdater
{
    protected static function bootHasCreaterAndUpdater() {
        static::creating(function($modal) {
            $modal->created_by = Auth::id();
            $modal->updated_by = Auth::id();
        });

        static::updating(function($modal) {
            $modal->updated_by = Auth::id();
        });
    }
}