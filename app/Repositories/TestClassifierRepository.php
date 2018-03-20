<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\TestClassifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TestClassifierRepository extends AbstractRepository
{
    public function __construct(TestClassifier $model)
    {
        $this->model = $model;
    }

    public function getLastPeriodCalculation()
    {
        return DB::select('SELECT MAX(test_classifier.period_calculation) AS period_calculation 
                                  FROM test_classifier')[0]->period_calculation;
    }

    public function getAllPeriodCalculationByType($type)
    {
        return DB::select('SELECT test_classifier.period_calculation AS period_calculation 
                                  FROM test_classifier 
                                  WHERE test_classifier.type = :type
                                  AND test_classifier.result = 1
                                  GROUP BY test_classifier.period_calculation;', ['type' => $type]);
    }

    public function getLastPeriodCalculationByType($type)
    {
        return DB::select('SELECT MAX(test_classifier.period_calculation) AS period_calculation 
                                  FROM test_classifier 
                                  WHERE test_classifier.type = :type
                                  AND test_classifier.result = 1;', ['type' => $type])[0]->period_calculation;
    }

    public function getBestXTestClassifiersByTypeAndPeriodCalculatio($type, $period_calculation, $limit = 3)
    {
        return DB::select('SELECT SUM(test_classifier.success) AS success,
                                 SUM(test_classifier.failure) AS failure,
                                 SUM(test_classifier.success_evaded) AS success_evaded,
                                 SUM(test_classifier.failure_evaded) AS failure_evaded,
                                 SUM(test_classifier.success_not_evaded) AS success_not_evaded,
                                 SUM(test_classifier.failure_not_evaded) AS failure_not_evaded
                                 FROM test_classifier
                                 LEFT JOIN classifier
                                 ON test_classifier.classifier_id = classifier.id
                                 WHERE test_classifier.period_calculation = :period_calculation
                                 AND test_classifier.type = :type
                                 AND test_classifier.result = 1
                                 ORDER BY success DESC
                                 LIMIT :limit ', ['type' => $type, 'period_calculation' => $period_calculation, 'limit' => $limit]);
    }

    public function getBestXTestClassifiersGroupByCampusByTypeAndPeriodCalculatio($type, $period_calculation, $limit = 3)
    {
        return DB::select('SELECT campus.name AS campus,
                                 SUM(test_classifier.success) AS success,
                                 SUM(test_classifier.failure) AS failure,
                                 SUM(test_classifier.success_evaded) AS success_evaded,
                                 SUM(test_classifier.failure_evaded) AS failure_evaded,
                                 SUM(test_classifier.success_not_evaded) AS success_not_evaded,
                                 SUM(test_classifier.failure_not_evaded) AS failure_not_evaded
                                 FROM test_classifier
                                 LEFT JOIN classifier
                                 ON test_classifier.classifier_id = classifier.id
                                 LEFT JOIN course
                                 ON test_classifier.course_id = course.id
                                 LEFT JOIN campus
                                 ON course.campus_id = campus.id
                                 WHERE test_classifier.period_calculation = :period_calculation
                                 AND test_classifier.type = :type
                                 AND test_classifier.result = 1
                                 GROUP BY campus.name
                                 ORDER BY success DESC
                                 LIMIT :limit ', ['type' => $type, 'period_calculation' => $period_calculation, 'limit' => $limit]);
    }

    public function getBestXTestClassifiersByTypeAndPeriodCalculationAndCourse($type, $period_calculation, $course, $limit = 3)
    {
        return DB::select('SELECT test_classifier.*
                                FROM test_classifier
                                LEFT JOIN classifier
                                ON test_classifier.classifier_id = classifier.id
                                LEFT JOIN test_classifier_variable
                                ON test_classifier.id = test_classifier_variable.test_classifier_id
                                WHERE test_classifier.period_calculation = :period_calculation
                                AND test_classifier.type = :type  
                                AND test_classifier.course_id = :course
                                ORDER BY test_classifier.success DESC
                                LIMIT :limit ;', ['type' => $type, 'period_calculation' => $period_calculation, 'course' => $course, 'limit' => $limit]);
    }

    public function getSumSucessByClassifierAndVariable($type, $period_calculation, $classifier_id, $course_id)
    {
        return DB::select('SELECT classifier.name AS classifier, variable.name AS variable, tc.success, 
                                         tc.failure, tc.success_evaded, tc.failure_evaded, tc.success_evaded, tc.failure_not_evaded
                                FROM test_classifier tc
                                LEFT JOIN classifier
                                ON tc.classifier_id = classifier.id
                                LEFT JOIN test_classifier_variable
                                ON tc.id = test_classifier_variable.test_classifier_id
                                LEFT JOIN variable
                                ON variable.id = test_classifier_variable.variable_id
                                WHERE tc.period_calculation = :period_calculation
                                AND tc.course_id = :course_id
                                AND classifier.id = :classifier_id
                                AND tc.result = 1
                                AND tc.type = :type
                                ORDER BY success DESC
                                LIMIT 10', ['type' => $type, 'period_calculation' => $period_calculation, 'classifier_id' => $classifier_id, 'course_id' => $course_id]);
    }
}
