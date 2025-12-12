<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    use SoftDeletes;

    // Поля которые можно массово назначать
    protected $fillable = [
        'brand',
        'model',
        'year',
        'mileage',
        'color',
        'body_type',
        'detailed_description',
        'image'
    ];

    // Приведение типов
    protected $casts = [
        'year' => 'integer',
        'mileage' => 'integer'
    ];

    // Аксессор: полное название автомобиля
    public function getFullNameAttribute()
    {
        return $this->brand . ' ' . $this->model . ' (' . $this->year . ')';
    }

    // URL изображения
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            // Если изображения нет - возвращаем путь к дефолтной картинке
            return asset('images/no-image.jpg'); //  файл no-image.jpg  в public/images/
        }
        
        return Storage::url($this->image);
    }

    // Аксессор: форматированный пробег (85 000 км)
    public function getFormattedMileageAttribute()
    {
        return number_format($this->mileage, 0, ',', ' ') . ' км';
    }

    // Мутатор: приводим год к integer
    public function setYearAttribute($value)
    {
        $this->attributes['year'] = (int) $value;
    }

    // Мутатор: приводим пробег к integer
    public function setMileageAttribute($value)
    {
        $this->attributes['mileage'] = (int) $value;
    }

    // Мутатор: очищаем HTML теги для безопасности
    public function setDetailedDescriptionAttribute($value)
    {
        // Разрешаем только безопасные теги для popover
        $allowedTags = '<span><strong><em><br><p><div><i>';
        $this->attributes['detailed_description'] = strip_tags($value, $allowedTags);
    }
}