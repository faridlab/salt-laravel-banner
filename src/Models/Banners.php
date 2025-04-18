<?php

namespace SaltBanner\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltLaravel\Models\Resources;
use SaltFile\Traits\Fileable;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;

class Banners extends Resources {
    use Uuids;
    use ObservableModel;
    use Fileable;
    protected $fileableFields = ['video', 'banner', 'mobile'];
    protected $fileableCascade = true;
    protected $fileableDirs = [
        'video' => 'banners/video',
        'banner' => 'banners/image',
        'mobile' => 'banners/mobile',
    ];

    protected $filters = [
        'default',
        'search',
        'fields',
        'relationship',
        'withtrashed',
        'orderby',
        // Fields table provinces
        'id',
        'title',
        'description',
        'status',
        'type',
        'videourl',
        'order'
    ];

    protected $rules = array(
        "title" => 'required|string',
        "description" => 'required|string',
        "status" => 'nullable|string',
        "type" => 'nullable|string',
        "videourl" => 'nullable|string',
        "order" => 'required|integer',
    );

    protected $auths = array (
        // 'index',
        'store',
        // 'show',
        'update',
        'patch',
        'destroy',
        'trash',
        'trashed',
        'restore',
        'delete',
        'import',
        'export',
        'report'
    );

    protected $structures = array();

    protected $forms = array();
    protected $searchable = array( 'title', 'description', 'status', 'type','videourl','order', 'link');
    protected $fillable = array( 'title', 'description', 'status', 'type','videourl','order', 'link');

    public function save(array $options = [])
    {
        $this->updated_at = now();
        return parent::save($options);
    }

    public function banner() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'banners')
                    ->where('directory', 'banners/image');
    }

    public function mobile() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'banners')
                    ->where('directory', 'banners/mobile');
    }

    public function video() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'banners')
                    ->where('directory', 'banners/video');
    }
}
