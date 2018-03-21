<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PositionRepository extends AbstractRepository
{
    public function __construct(Position $model)
    {
        $this->model = $model;
    }
}
