<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    const STATUS = [
        1 => [ 'badge' => '未着手', 'class' => 'badge-danger' ],
        2 => [ 'badge' => '着手中', 'class' => 'badge-info' ],
        3 => [ 'badge' => '完了', 'class' => 'badge-success' ],
    ];

    const IMPORTANT = [
        1 => [ 'badge' => '低', 'class' => 'badge-pill badge-info' ],
        2 => [ 'badge' => '高', 'class' => 'badge-pill badge-danger' ],
    ];

    const URGENT = [
        1 => [ 'badge' => '低', 'class' => 'badge-pill badge-info' ],
        2 => [ 'badge' => '高', 'class' => 'badge-pill badge-danger' ],
    ];

    public function getStatusBadgeAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['badge'];
    }

    public function getImportantBadgeAttribute()
    {
        $important = $this->attributes['important'];

        if (!isset(self::IMPORTANT[$important])) {
            return '';
        }

        return self::IMPORTANT[$important]['badge'];
    }

    public function getUrgentBadgeAttribute()
    {
        $urgent = $this->attributes['urgent'];

        if (!isset(self::URGENT[$urgent])) {
            return '';
        }

        return self::URGENT[$urgent]['badge'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    public function getImportantClassAttribute()
    {
        $important = $this->attributes['important'];

        if (!isset(self::IMPORTANT[$important])) {
            return '';
        }

        return self::IMPORTANT[$important]['class'];
    }

    public function getUrgentClassAttribute()
    {
        $urgent = $this->attributes['urgent'];

        if (!isset(self::URGENT[$urgent])) {
            return '';
        }

        return self::URGENT[$urgent]['class'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
}
