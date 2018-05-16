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
        'neuter_percent',
        'success_evaded_percent',
        'failure_evaded_percent',
        'success_not_evaded_percent',
        'failure_not_evaded_percent',
        'probabilitys'];

    protected $fillable = [
        'period_calculation',
        'period',
        'success',
        'failure',
        'neuter',
        'success_evaded',
        'success_not_evaded',
        'neuter_evaded',
        'neuter_not_evaded',
        'failure_evaded',
        'failure_not_evaded',
        'start',
        'end',
        'time_seconds',
        'type',
        'result',
        'classifier_id',
        'course_id',];

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
        if($this->success != 0){
            return number_format((($this->success / ($this->success + $this->failure + $this->neuter )) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    public function getFailurePercentAttribute()
    {
        if($this->failure != 0){
            return number_format((($this->failure / ($this->success + $this->failure + $this->neuter )) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    public function getNeuterPercentAttribute()
    {
        if($this->failure != 0){
            return number_format((($this->neuter / ($this->success + $this->failure + $this->neuter )) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    //--------- Success and Failure : EVADED
    public function getSuccessEvadedPercentAttribute()
    {
        if($this->success_evaded != 0){
            return number_format((($this->success_evaded / ($this->success_evaded + $this->failure_evaded)) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    public function getFailureEvadedPercentAttribute()
    {
        if($this->failure_evaded != 0){
            return number_format((($this->failure_evaded / ($this->failure_evaded + $this->success_evaded)) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    //--------- Success and Failure : NOT EVADED
    public function getSuccessNotEvadedPercentAttribute()
    {
        if($this->success_evaded != 0){
            return number_format((($this->success_evaded / ($this->success_evaded + $this->failure_not_evaded)) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
    }

    public function getFailureNotEvadedPercentAttribute()
    {
        if($this->failure_not_evaded != 0){
            return number_format((($this->failure_not_evaded / ($this->failure_not_evaded + $this->success_evaded)) * 100), 2, '.', ',');;
        } else{
            return 0;
        }
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
        return Course::find($this->course_id)->campus;
    }

    public function getProbabilitysAttribute()
    {
        return DB::table('probability')
            ->where('test_classifier_id', '=', $this->id)
            ->get();
    }
}
