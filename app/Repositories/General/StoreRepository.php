<?php

namespace App\Repositories\General;

use App\Models\Store;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class StoreRepository extends BaseRepository
{
    /**
     * @param Store $model
     */
    public function __construct(Store $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Store
    {
        $store = parent::store($data);
        return $store;
    }

    

}
