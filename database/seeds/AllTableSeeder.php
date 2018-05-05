<?php

use App\Models\Campus;
use App\Models\Classifier;
use App\Models\Position;
use App\Models\Situation;
use App\Models\Variable;
use App\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:fresh');

        //------------------------- Position -------------------------
        $position_dev = Position::create([
            'name' => 'Desenvolvedor',
            'description' => 'Desenvolvedor do Sistema',
        ]);

        $position_adm_instituicao = Position::create([
            'name' => 'Administrador da Instituição',
            'description' => 'Administrador da Instituição',
        ]);

        $position_adm_campus = Position::create([
            'name' => 'Administrador do Campus',
            'description' => 'Administrador do Campus',
        ]);

        $position_coordenador = Position::create([
            'name' => 'Coordenador',
            'description' => 'Coordenador de Curso',
        ]);


        $position_coordenador = Position::create([
            'name' => 'Professor',
            'description' => 'Professor de Curso',
        ]);

        //------------------------- User -------------------------
        User::create([
            'name' => 'Johnny Rockembach',
            'email' => 'johnny@alunos.utfpr.edu.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => $position_dev->id,
        ]);

        User::create([
            'name' => 'Desenvolvedor 1',
            'email' => 'desenvolvedor@smartedu.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => $position_dev->id,
        ]);

        /*
        $user = User::create([
        'name' => 'Coordenador Pato Branco',
        'email' => 'patobranco@coordenador.com.br',
        'password' => bcrypt('111111'),
        'status' => 1,
        'position_id' => $position_coordenador->id,
        'campus_id' => $campus_pato->id,
        ]);
        $user->course()->attach($course_administracao);

        $user = User::create([
        'name' => 'Coordenador Apucarana',
        'email' => 'apucarana@coordenador.com.br',
        'password' => bcrypt('111111'),
        'status' => 1,
        'position_id' => $position_coordenador->id,
        'campus_id' => $campus_apucarana->id,
        ]);
        $user->course()->attach($course_textil);
        $user->course()->attach($course_quimica);

        $user = User::create([
        'name' => 'Administrador Pato Branco',
        'email' => 'patobranco@administrador.com.br',
        'password' => bcrypt('111111'),
        'status' => 1,
        'position_id' => $position_adm_campus->id,
        'campus_id' => $campus_pato->id,
        ]);

        $user = User::create([
        'name' => 'Administrador Campo Mourão',
        'email' => 'campo_mourao@administrador.com.br',
        'password' => bcrypt('111111'),
        'status' => 1,
        'position_id' => $position_adm_campus->id,
        'campus_id' => $campus_campo->id,
        ]);

        $user = User::create([
        'name' => 'Administrador Instituição',
        'email' => 'instituicao@administrador.com.br',
        'password' => bcrypt('111111'),
        'status' => 1,
        'position_id' => $position_adm_instituicao->id,
        ]);
         */
        //------------------------- Variable -------------------------

        Variable::create([
            'name' => 'Ano',
            'name_database' => 'year_situation',
            'table' => 'detail',
            'description' => 'Ano',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Semestre',
            'name_database' => 'semester_situation',
            'table' => 'detail',
            'description' => 'Semestre',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Coeficiente de rendimento',
            'name_database' => 'coefficient',
            'table' => 'detail',
            'description' => 'Coeficiente de rendimento',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Disciplinas aprovadas',
            'name_database' => 'disciplines_approved',
            'table' => 'detail',
            'description' => 'Disciplinas aprovadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas consignadas',
            'name_database' => 'disciplines_consigned',
            'table' => 'detail',
            'description' => 'Disciplinas consignadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas matriculadas',
            'name_database' => 'disciplines_matriculate',
            'table' => 'detail',
            'description' => 'Disciplinas matriculadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas reprovadas por frequência',
            'name_database' => 'disciplines_reprovated_frequency',
            'table' => 'detail',
            'description' => 'Disciplinas reprovadas por frequência',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas reprovadas por nota',
            'name_database' => 'disciplines_reprovated_note',
            'table' => 'detail',
            'description' => 'Disciplinas reprovadas por nota',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Idade',
            'name_database' => 'age_situation',
            'table' => 'detail',
            'description' => 'Idade',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Matriz curricular',
            'name_database' => 'matrix',
            'table' => 'detail',
            'description' => 'Matriz curricular',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Período',
            'name_database' => 'period',
            'table' => 'detail',
            'description' => 'Período',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Total de semestres cursados',
            'name_database' => 'semesters',
            'table' => 'detail',
            'description' => 'Total de semestres cursados',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Ano de ingresso',
            'name_database' => 'year_ingress',
            'table' => 'student',
            'description' => 'Ano de ingresso',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Forma de ingresso',
            'name_database' => 'type_ingress',
            'table' => 'student',
            'description' => 'Forma de ingresso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Gênero',
            'name_database' => 'genre',
            'table' => 'student',
            'description' => 'Gênero',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Mudou de curso - mesmo câmpus',
            'name_database' => 'changed_course',
            'table' => 'student',
            'description' => 'Mudou de curso - mesmo câmpus',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Mudou de curso - outro câmpus',
            'name_database' => 'changed_course_campus',
            'table' => 'student',
            'description' => 'Mudou de curso - outro câmpus',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Humanas',
            'name_database' => 'enem_human',
            'table' => 'student',
            'description' => 'Nota ENEM Humanas',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Liguagem',
            'name_database' => 'enem_language',
            'table' => 'student',
            'description' => 'Nota ENEM Liguagem',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Matemática',
            'name_database' => 'enem_math',
            'table' => 'student',
            'description' => 'Nota ENEM Matemática',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Natureza',
            'name_database' => 'enem_nature',
            'table' => 'student',
            'description' => 'Nota ENEM Natureza',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Redação',
            'name_database' => 'enem_redaction',
            'table' => 'student',
            'description' => 'Nota ENEM Redação',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota final SISU',
            'name_database' => 'sisu',
            'table' => 'student',
            'description' => 'Nota final SISU',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Número de entradas em outros cursos',
            'name_database' => 'entries_other_course',
            'table' => 'student',
            'description' => 'Número de entradas em outros cursos',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Número de entradas no curso',
            'name_database' => 'entries_course',
            'table' => 'student',
            'description' => 'Número de entradas no curso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Semestre de ingresso no curso',
            'name_database' => 'semester_ingress',
            'table' => 'student',
            'description' => 'Semestre de ingresso no curso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Tipo de cota',
            'name_database' => 'quota',
            'table' => 'student',
            'description' => 'Tipo de cota',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Idade Ingresso',
            'name_database' => 'age',
            'table' => 'student',
            'description' => 'Idade Ingresso',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);

        //------------------------- Classifier -------------------------
        Classifier::create([
            'name' => 'BayesNet',
            'use_classify' => 1,
        ]);
        Classifier::create([
            'name' => 'NaiveBayes',
            'use_classify' => 1,
        ]);
        Classifier::create([
            'name' => 'NaiveBayesUpdateable',
        ]);
        Classifier::create([
            'name' => 'Logistic',
            'use_classify' => 1,
        ]);
        Classifier::create([
            'name' => 'MultilayerPerceptron',
        ]);
        Classifier::create([
            'name' => 'SimpleLogistic',
            'use_classify' => 1,
        ]);
        Classifier::create([
            'name' => 'SMO',
        ]);
        Classifier::create([
            'name' => 'IBk',
        ]);
        Classifier::create([
            'name' => 'KStar',
        ]);
        Classifier::create([
            'name' => 'LWL',
        ]);
        Classifier::create([
            'name' => 'AdaBoostM1',
        ]);
        Classifier::create([
            'name' => 'JRip',
        ]);
        Classifier::create([
            'name' => 'J48',
        ]);
        Classifier::create([
            'name' => 'LMT',
        ]);
        Classifier::create([
            'name' => 'RandomForest',
        ]);
        Classifier::create([
            'name' => 'REPTree',
        ]);

        // Situation
        Situation::create([
            'situation_short' => 'Não Evadido',
            'situation_long' => 'Regular',
            'description' => 'Regular',
        ]);
        Situation::create([
            'situation_short' => 'Não Evadido',
            'situation_long' => 'Trancado',
            'description' => 'Trancado',
        ]);
        Situation::create([
            'situation_short' => 'Formado',
            'situation_long' => 'Formado',
            'description' => 'Formado',
        ]);
        Situation::create([
            'situation_short' => 'Evadido',
            'situation_long' => 'Desistente',
            'description' => 'Desistente',
        ]);
        Situation::create([
            'situation_short' => 'Evadido',
            'situation_long' => 'Transferido',
            'description' => 'Transferido',
        ]);
        Situation::create([
            'situation_short' => 'Evadido',
            'situation_long' => 'Jubilado',
            'description' => 'Jubilado',
        ]);
        Situation::create([
            'situation_short' => 'Outro',
            'situation_long' => 'Falecido',
            'description' => 'Falecido',
        ]);
        Situation::create([
            'situation_short' => 'Não Evadido',
            'situation_long' => 'Enade pendente',
            'description' => 'Enade pendente',
        ]);
        Situation::create([
            'situation_short' => 'Não Evadido',
            'situation_long' => 'Afastado para estudos no exterior',
            'description' => 'Afastado para estudos no exterior',
        ]);
        Situation::create([
            'situation_short' => 'Outro',
            'situation_long' => 'Expulso',
            'description' => 'Expulso',
        ]);
        Situation::create([
            'situation_short' => 'Outro',
            'situation_long' => 'Matrícula sub judice',
            'description' => 'Matrícula sub judice',
        ]);
        Situation::create([
            'situation_short' => 'Evadido',
            'situation_long' => 'Mudou de Curso',
            'description' => 'Mudou de Curso',
        ]);
        Situation::create([
            'situation_short' => 'Outro',
            'situation_long' => 'Em mobilidade (intercâmpus)',
            'description' => 'Em mobilidade (intercâmpus)',
        ]);
    }
}