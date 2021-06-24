<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'badge-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'badge-info' ],
        3 => [ 'label' => '完了', 'class' => 'badge-success' ],
    ];

    const IMPORTANT = [
        1 => [ 'label' => '低' ],
        2 => [ 'label' => '高' ],
    ];

    const URGENT = [
        1 => [ 'label' => '低' ],
        2 => [ 'label' => '高' ],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getImportantLabelAttribute()
    {
        $important = $this->attributes['important'];

        if (!isset(self::IMPORTANT[$important])) {
            return '';
        }

        return self::IMPORTANT[$important]['label'];
    }

    public function getUrgentLabelAttribute()
    {
        $urgent = $this->attributes['urgent'];

        if (!isset(self::URGENT[$urgent])) {
            return '';
        }

        return self::URGENT[$urgent]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }
}
