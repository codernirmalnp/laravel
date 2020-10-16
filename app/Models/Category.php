<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=[
        'name','slug','description','parent_id','menu','image'
    ];
    protected $casts=[
        'parent_id'=>'integer',
        'featured'=>'boolean',
        'menu'=>'boolean'

    ];

//many category have one parent
public function parent()
{
    return $this->belongsTo(Category::class, 'parent_id');
}

//one parent have many children
public function children()
{
    return $this->hasMany(Category::class, 'parent_id');
}


public function setNameAttribute($value) {
    $this->attributes['name'] = $value;

    if (static::whereSlug($slug = Str::slug($value))->exists()) {

        $slug = $this->incrementSlug($slug);
    }

    $this->attributes['slug'] = $slug;
}

public function incrementSlug($slug) {

    $original = $slug;

    $count = 1;

    while (static::whereSlug($slug)->exists()) {

        $slug = "{$original}-" . $count++;
    }

    return $slug;

}


}
