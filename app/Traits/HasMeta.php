<?php

namespace App\Traits;

use App\Models\UserMeta;

trait HasMeta
{
    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id');
    }

    /**
     * Fetch meta value by key.
     */
    public function metaValue(string $key, $default = null)
    {
        return optional(
            $this->meta->firstWhere('meta_key', $key)
        )->meta_value ?? $default;
    }

    /**
     * Override __get to allow direct property access.
     */
//     public function __get($key)
// {
//     // Check if key exists in meta
//     $meta = $this->meta()->where('meta_key', $key)->first();
//     if ($meta) {
//         return $meta->meta_value;
//     }

//     // fallback to normal attributes
//     return parent::__get($key);
// }

    /**
     * Save or update meta key-value.
     */
    public function setMeta(string $key, $value)
{
    // Skip null or empty values
    if ($value === null || $value === '') {
        return;
    }

    UserMeta::updateOrCreate(
        ['user_id' => $this->id, 'meta_key' => $key],
        ['meta_value' => $value]
    );
}


   public function setMetaBulk(array $data)
{
    foreach ($data as $key => $value) {
        // Skip null or empty values
        if ($value === null || $value === '') {
            continue;
        }

        $this->setMeta($key, $value);
    }
}
}
