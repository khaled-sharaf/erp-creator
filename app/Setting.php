<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'slug', 'name', 'value', 'type', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeGetSettings($query, $key = null) {
        if ($key != null) {
            $settings = $query->where('name', $key)->first()->value;
        } else {
            $settings = $query->where('name', '!=', 'data_tabel_settings_view_columns')->get()->pluck('value', 'name')->toArray();
        }
        return $settings;
    }
}
