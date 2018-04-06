<?php

namespace App\Repositories;

use App\Models\Detail;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DetailRepository extends AbstractRepository
{
    public function __construct(Detail $model)
    {
        $this->model = $model;
    }


}
