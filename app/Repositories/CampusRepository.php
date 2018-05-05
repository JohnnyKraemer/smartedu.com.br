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

    public function get(array $column, array $criteria = null, array $groupby = null, $orderBy = null)
    {
        try {
            $sql = "SELECT ";

            if ($column != null) {
                $i = 1;
                foreach ($column as $c) {
                    $sql = $sql . $c;

                    if ($i != count($column)) {
                        $sql = $sql . ", ";
                    }
                    $i = $i + 1;
                }
            }

            $sql = $sql . "
                    FROM campus
                    WHERE 1 ";

            if ($criteria != null) {
                foreach ($criteria as $c) {
                    $sql = $sql . "\nAND " . $c[0] . " " . $c[1] . " " . $c[2] . "";
                }
            }
            //dd($sql);

            if ($groupby != null) {
                $sql = $sql . "\n GROUP BY ";
                $i = 1;
                foreach ($groupby as $c) {
                    $sql = $sql . $c;

                    if ($i != count($groupby)) {
                        $sql = $sql . ", ";
                    }
                    $i = $i + 1;
                }
            }

            if ($orderBy != null) {
                $sql = $sql . "\n ORDER BY " . $orderBy;
            }
            return DB::select($sql);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
