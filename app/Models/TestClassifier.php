<?php

namespace App\Models;

use App\Models\Variable;
use App\Models\Classifier;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestClassifier extends Model
{
    protected $table = 'test_classifier';
    public $timestamps = false;

    protected $appends = [
        'variables_name',
        'classifier_name',
        'course_name',
        'campus_name',
        'success_percent',
        'failure_percent',
        'success_evaded_percent',
        'failure_evaded_percent',
        'success_not_evaded_percent',
        'failure_not_evaded_percent'];

    protected $fillable = [
        'period_calculation',
        'period',
        'success',
        'failure',
        'success_evaded',
        'success_evaded',
        'failure_evaded',
        'failure_not_evaded',
        'start',
        'end',
        'time_seconds',
        'type',
        'result',
        'classifier_id',
        'course_id',];

    public $TEST_BASE = 0;
    public $TEST_ALL = 1;

    public function getTest_Base(){
        return $this->TEST_BASE;
    }
    //public static final int TEST_SINGLE = 2;
    //public static final int TEST_PATTERN = 3;

    //public static final int TEST_PERIOD_BASE = 4;
    //public static final int TEST_PERIOD_ALL = 5;
    //public static final int TEST_PERIOD_SINGLE = 6;
    //public static final int TEST_PERIOD_PATTERN = 7;

    //public static final int RESULT_ERROR = 0;
    //public static final int RESULT_SUCCESS = 1;

    public function variables()
    {
        return $this->belongsToMany(Variable::class, 'test_classifier_variable', 'test_classifier_id', 'variable_id');
    }

    public function classifier()
    {
        return $this->belongsTo(Classifier::class, 'classifier_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getVariablesNameAttribute()
    {
        $test_classifier_variables = DB::table('test_classifier_variable')->where('test_classifier_id', '=', $this->id)->get();

        $names = "";
        foreach ($test_classifier_variables as $test_classifier_variable) {
            $variable = DB::table('variable')->where('id', '=', $test_classifier_variable->variable_id)->get();
            foreach ($variable as $var) {
                if ($names == "") {
                    $names = $var->name;
                } else {
                    $names = $names . ' - ' . $var->name;
                }
            }
        }
        return $names;
    }

    //--------- Success and Failure : GENERAL
    public function getSuccessPercentAttribute()
    {
        return ($this->success / ($this->success + $this->failure)) * 100;
    }

    public function getFailurePercentAttribute()
    {
        return ($this->failure / ($this->success + $this->failure)) * 100;
    }

    //--------- Success and Failure : EVADED
    public function getSuccessEvadedPercentAttribute()
    {
        return ($this->success_evaded / ($this->success_evaded + $this->failure_evaded)) * 100;
    }

    public function getFailureEvadedPercentAttribute()
    {
        return ($this->failure_evaded / ($this->failure_evaded + $this->success_evaded)) * 100;
    }

    //--------- Success and Failure : NOT EVADED
    public function getSuccessNotEvadedPercentAttribute()
    {
        return ($this->success_evaded / ($this->success_evaded + $this->failure_not_evaded)) * 100;
    }

    public function getFailureNotEvadedPercentAttribute()
    {
        return ($this->failure_not_evaded / ($this->failure_not_evaded + $this->success_evaded)) * 100;
    }

    public function getClassifierNameAttribute()
    {
        return Classifier::find($this->classifier_id)->name;
    }

    public function getCourseNameAttribute()
    {
        return Course::find($this->course_id)->name;
    }

    public function getCampusNameAttribute()
    {
        return Course::find($this->course_id)->campus->name;
    }
}
