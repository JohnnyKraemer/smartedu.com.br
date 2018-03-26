<?php

namespace App\Repositories;

use App\Models\Campus;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CampusRepository extends AbstractRepository
{
    public function __construct(Campus $model)
    {
        $this->model = $model;
    }


}
