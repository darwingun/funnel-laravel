<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class MapPreset extends Model
{
    use HasUuid;

    protected $with = [ 'categories'];
    protected $hidden = ['uuid'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'map_preset_categories');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessHours() {
        return $this->hasMany(MapPresetBusinessHours::class);
    }

    /**
     * Get all of the posts for the country.
     */
    public function businesses()
    {
        $businessesToReturn = collect([]);
        foreach ($this->categories as $category) {
            $category->businesses->each(function ($b) use (&$businessesToReturn) {
                $businessesToReturn->push($b);
            });
        }
        return $businessesToReturn;
    }

}
