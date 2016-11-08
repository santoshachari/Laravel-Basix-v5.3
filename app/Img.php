<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Img extends Model
{

    use Sluggable;

    protected $fillable = [
        'file_name', 'name', 'slug','imageAble_id','imageAble_type'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function imageAble()
    {
        return $this->morphTo();
    }

    /**
     * Get the url of the image.
     * @return string
     */
    public function url()
    {
        return config('company.folders.images_original') . $this->file;
    }

    public static function create(array $attributes = [])
    {

        //Check if file is supplied
        if (array_key_exists('file', $attributes)) {

            $file = $attributes['file'];
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $old_file_name = $file->getClientOriginalName();

            $attributes['file_name'] = $file_name;
            $attributes['name'] = $old_file_name;
        } elseif (array_key_exists('raw_file_path', $attributes)) {
            $attributes['file'] = $attributes['raw_file_path'];
        }


        if (array_key_exists('file', $attributes)) {

            $file = $attributes['file'];
            $file_name = $attributes['file_name'];
            unset($attributes['file']);
            unset($attributes['raw_file_path']);

            $img = parent::create($attributes);
            //Save and resize as required
            $img->saveOriginal($file, $file_name);

        }
        return $img;

    }

    /**
     * Overwriting the default destroy function
     * to delete the files as well.
     * @param array|int $ids
     * @return int
     */
    public static function destroy($ids)
    {
        // We'll initialize a count here so we will return the total number of deletes
        // for the operation. The developers can then check this number as a boolean
        // type value or get this total count of records deleted for logging, etc.
        $count = 0;

        $ids = is_array($ids) ? $ids : func_get_args();

        $instance = new static;

        // We will actually pull the models from the database table and call delete on
        // each of them individually so that their events get fired properly with a
        // correct set of attributes in case the developers wants to check these.
        $key = $instance->getKeyName();

        foreach ($instance->whereIn($key, $ids)->get() as $model) {

            $model->deleteOriginal($model->file_name);
            $model->deleteProductSize($model->file_name);
            $model->deleteThumbnailSize($model->file_name);
            $model->deleteIconSize($model->file_name);

            if ($model->delete()) {
                $count++;
            }
        }

        return $count;
    }

    /*
     * Store files in Storage for avoiding Git
     */
    public function saveOriginal($file, $file_name)
    {


        Storage::put(config('imagecache.storage_folder') . $file_name, Image::make($file)->stream());
    }


    /**
     * @param string $size possible choices product,icon,thumbnail,original
     * @return string
     */
    public function getUrl($size = 'product'){
        return '/img/'.$size.'/'.$this->id;
    }
}
