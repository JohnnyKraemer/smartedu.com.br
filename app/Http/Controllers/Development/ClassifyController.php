<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Models\Classifier;
use App\Models\Course;
use App\Models\Retorno;
use App\Models\Variable;
use App\Models\Campus;
use App\Models\TestClassifier;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use App\Repositories\TestClassifierRepository AS Repository;

class ClassifyController extends Controller
{
    private $way;
    private $name;
    private $repository;
    private $test_classifier;

    public $TEST_BASE = 0;
    public $TEST_ALL = 1;
    public $TEST_SINGLE = 2;
    public $TEST_PATTERN = 3;

    public $TEST_PERIOD_BASE = 4;
    public $TEST_PERIOD_ALL = 5;
    public $TEST_PERIOD_SINGLE = 6;
    public $TEST_PERIOD_PATTERN = 7;

    public $PATTERN_TEST = 8;
    public $PATTERN_RESULT = 9;

    public $RESULT_ERROR = 0;
    public $RESULT_SUCCESS = 1;

    public function __construct(Repository $repository)
    {
        $this->way = array();
        array_push($this->way, 'development.classify.');
        array_push($this->way, 'development/classify');

        $this->name = 'classificar';

        $this->repository = $repository;
        $this->test_classifier = new TestClassifier();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $period_calculation_all = $this->repository->getAllPeriodCalculationByType(3);

            $period_calculation = $this->repository->getLastPeriodCalculationByType($this->PATTERN_RESULT);

            dd($period_calculation);

            //$test = $this->repository->getBestXTestClassifiersByTypeAndPeriodCalculationAndCourse(3, $period_calculation, 2, 10);
            //dd($test);

            $grafic_one = $this->repository->getBestsTestClassifiersByTypeAndPeriodCalculatio(9, $period_calculation);
            $grafic_one = json_encode($grafic_one);

            dd($grafic_one);



            $classifiers = Classifier::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            //dd($classifiers);

            $variables = Variable::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $courses = Course::all();
            $campus = Campus::all();

            $objects = $this->repository->findBy(
                array(
                    array(0 => "type", 1 => "=", 2 => 9),
                    //array(0 => "result", 1 => "=", 2 => 1),
                    array(0 => "period_calculation", 1 => "=", 2 => $period_calculation),
                    //array(0 => "course_id", 1 => "=", 2 => 2)
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            );

            //dd($objects);

            //$objects->load('variables','classifier','course');
            //$objects = json_encode($objects);

            //dd($objects);

            return view($this->way[0] . 'index', compact([
                'objects', $objects,
                'classifiers', $classifiers,
                'variables', $variables,
                'courses', $courses,
                'campus', $campus,
                'grafic_one', $grafic_one,
                'period_calculation_all', $period_calculation_all,
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            dd($e);
            //return redirect('/');
        }
    }

    public function campus(Request $request)
    {
        try {

            $period_calculation_all = $this->repository->getAllPeriodCalculationByType(3);

            $period_calculation = $this->repository->getLastPeriodCalculationByType($this->PATTERN_RESULT);

            $grafic_one = $this->repository->getBestXTestClassifiersGroupByCampusByTypeAndPeriodCalculatio($this->PATTERN_RESULT, $period_calculation);
            $grafic_one = json_encode($grafic_one);

            $classifiers = Classifier::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $variables = Variable::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $courses = Course::all();
            $campus = Campus::all();

            $objects = $this->repository->findBy(
                array(
                    array(0 => "type", 1 => "=", 2 => 9),
                    //array(0 => "result", 1 => "=", 2 => 1),
                    array(0 => "period_calculation", 1 => "=", 2 => $period_calculation),
                    //array(0 => "course_id", 1 => "=", 2 => 2)
                ),
                array(
                    array(0 => "success", 1 => "desc")
                ),
                3
            );
            //$objects->load('variables','classifier','course');

            return view($this->way[0] . 'index', compact([
                'objects', $objects,
                'classifiers', $classifiers,
                'variables', $variables,
                'courses', $courses,
                'campus', $campus,
                'grafic_one', $grafic_one,
                'period_calculation_all', $period_calculation_all,
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }

    function new(Request $request)
    {
        try {
            $classifiers = $request->get('classifiers');
            $variables = $request->get('variables');
            $courses = $request->get('courses');
        } catch (Exception $e) {
            return "Erro ao receber os dados!";
        }
        try {
            $retorno = new Retorno();
            $retorno->classifiers = $classifiers;
            $retorno->variables = $variables;
            $retorno->courses = $courses;

            $way = array();
            array_push($way, $classifiers);
            array_push($way, $variables);
            array_push($way, $courses);
            //$retorno = json_encode($way);
            //dd($retorno);

            $url = 'http://localhost:8080/classify/';

            //Initiate cURL.
            $ch = curl_init($url);

            //Encode the array into JSON.
            $jsonDataEncoded = json_encode($retorno);

            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);

            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            //Execute the request
            $result = curl_exec($ch);
            return $result;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function period(Request $request)
    {
        try {

            $classifiers = Classifier::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $variables = Variable::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $courses = Course::all();
            $campus = Campus::all();

            //$objects = $this->repository->findAll();
            //$objects = TestClassifier::with('variable')->get();
            //$objects = TestClassifier::where("period", "=", 0);

            $objects = $this->repository->findBy(
                array(
                    array(0 => "period", 1 => "<>", 2 => 0),
                    array(0 => "success", 1 => ">", 2 => 200),
                    array(0 => "result", 1 => "=", 2 => 1)
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            );
            $objects->load('variables', 'classifier', 'course');

            return view($this->way[0] . 'period', compact([
                'objects', $objects,
                'classifiers', $classifiers,
                'variables', $variables,
                'courses', $courses,
                'campus', $campus
            ]));
        } catch (Exception $e) {
            return $e;
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            //return redirect('/');
        }
    }

    public function test(Request $request)
    {
        try {

            $classifiers = Classifier::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $variables = Variable::where('use_classify', 1)
                ->orderBy('name', 'asc')
                ->get();

            $courses = Course::all();
            $campus = Campus::all();

            $objects = $this->repository->findBy(
                array(
                    array(0 => "period", 1 => "=", 2 => 0),
                    array(0 => "result", 1 => "=", 2 => 1)
                ),
                array(
                    array(0 => "success", 1 => "desc")
                )
            );
            //$objects->load('variables','classifier','course');

            return view($this->way[0] . 'test', compact([
                'objects', $objects,
                'classifiers', $classifiers,
                'variables', $variables,
                'courses', $courses,
                'campus', $campus
            ]));
        } catch (Exception $e) {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('message', 'Ocorreu um erro no sistema.');
            return redirect('/');
        }
    }
}
