<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseRepository extends AbstractRepository
{
    public function __construct(Course $model)
    {
        $this->model = $model;
    }


}
