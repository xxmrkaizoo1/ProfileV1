<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const ICON_OPTIONS = [
        'palette' => 'Palette',
        'pen-tool' => 'Pen tool',
        'shapes' => 'Shapes',
        'code' => 'Code',
        'megaphone' => 'Megaphone',
        'camera' => 'Camera',
    ];

    protected $fillable = [
        'title',
        'description',
        'icon',
        'cta_label',
        'cta_url',
        'sort_order',
    ];
}
