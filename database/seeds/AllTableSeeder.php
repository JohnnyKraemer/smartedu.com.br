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
            'visible' => false,
        ]);

        $position_coordenador = Position::create([
            'name' => 'Professor',
            'description' => 'Professor de Curso',
            'visible' => true,
        ]);

        $position_coordenador = Position::create([
            'name' => 'Coordenador',
            'description' => 'Coordenador de Curso',
            'visible' => true,
        ]);

        $position_adm_campus = Position::create([
            'name' => 'Administrador do Campus',
            'description' => 'Administrador do Campus',
            'visible' => true,
        ]);

        $position_adm_instituicao = Position::create([
            'name' => 'Administrador da Instituição',
            'description' => 'Administrador da Instituição',
            'visible' => true,
        ]);

        //------------------------- Campus -------------------------
        //$campus_pato = Campus::create([
        //    'name' => 'Pato Branco',
        //    'city' => 'Pato Branco',
        //]);

        //$campus_apucarana = Campus::create([
        //    'name' => 'Apucarana',
        //    'city' => 'Apucarana',
        //]);

        //$campus_campo = Campus::create([
        //    'name' => 'Campo Mourão',
        //    'city' => 'Campo Mourão',
        //]);

        //------------------------- Course -------------------------
        /*
        $course_administracao = Course::create([
        'name' => 'Administração',
        'nivel_ensino' => 'Graduação',
        'grau' => 'Bacharelado (outros)',
        'periodicidade' => 'Anual',
        'funcionamento' => 'Em Atividade',
        'turno' => 'Manhã',
        'categoria_stricto_sensu' => '-',
        'codigo_curso' => '167',
        'codigo_inep_curso' => '14537',
        'regime_ensino' => 'Anual',
        'total_periodos' => '5',
        'campus_id' => $campus_pato->id,
        ]);

        $course_contabeis = Course::create([
        'name' => 'Ciências Contábeis',
        'nivel_ensino' => 'Graduação',
        'grau' => 'Bacharelado (outros)',
        'periodicidade' => 'Anual',
        'funcionamento' => 'Em Atividade',
        'turno' => 'Integral (T/N)',
        'categoria_stricto_sensu' => '-',
        'codigo_curso' => '166',
        'codigo_inep_curso' => '14539',
        'regime_ensino' => 'Anual',
        'total_periodos' => '5',
        'campus_id' => $campus_pato->id,
        ]);

        $course_textil = Course::create([
        'name' => 'Engenharia Têxtil',
        'nivel_ensino' => 'Graduação',
        'grau' => 'Bacharelado (engenharia)',
        'periodicidade' => 'Semestral',
        'funcionamento' => 'Em Atividade',
        'turno' => 'Diurno (M/T)',
        'categoria_stricto_sensu' => '-',
        'codigo_curso' => '7',
        'codigo_inep_curso' => '1114930',
        'regime_ensino' => 'Semestral',
        'total_periodos' => '10',
        'campus_id' => $campus_apucarana->id,
        ]);

        $course_quimica = Course::create([
        'name' => 'Licenciatura Em Química',
        'nivel_ensino' => 'Graduação',
        'grau' => 'Licenciatura',
        'periodicidade' => 'Semestral',
        'funcionamento' => 'Em Atividade',
        'turno' => 'Noite',
        'categoria_stricto_sensu' => '-',
        'codigo_curso' => '9',
        'codigo_inep_curso' => '1126431',
        'regime_ensino' => 'Semestral',
        'total_periodos' => '8',
        'campus_id' => $campus_apucarana->id,
        ]);

        $course_computacao = Course::create([
        'name' => 'Ciência Da Computação',
        'nivel_ensino' => 'Graduação',
        'grau' => 'Bacharelado (outros)',
        'periodicidade' => 'Semestral',
        'funcionamento' => 'Em Atividade',
        'turno' => 'Integral (T/N)',
        'categoria_stricto_sensu' => '-',
        'codigo_curso' => '35',
        'codigo_inep_curso' => '1164656',
        'regime_ensino' => 'Semestral',
        'total_periodos' => '8',
        'campus_id' => $campus_campo->id,
        ]);
         */

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
            'name' => 'Turno',
            'name_database' => 'turno',
            'table' => 'course',
            'description' => 'Turno',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Ano',
            'name_database' => 'ano_situacao',
            'table' => 'detail',
            'description' => 'Ano',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Semestre',
            'name_database' => 'semestre_situacao',
            'table' => 'detail',
            'description' => 'Semestre',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Coeficiente de rendimento',
            'name_database' => 'cr',
            'table' => 'detail',
            'description' => 'Coeficiente de rendimento',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Disciplinas aprovadas',
            'name_database' => 'disciplinas_aprovadas',
            'table' => 'detail',
            'description' => 'Disciplinas aprovadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas consignadas',
            'name_database' => 'disciplinas_consignadas',
            'table' => 'detail',
            'description' => 'Disciplinas consignadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas matriculadas',
            'name_database' => 'disciplinas_matriculadas',
            'table' => 'detail',
            'description' => 'Disciplinas matriculadas',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas reprovadas por frequência',
            'name_database' => 'disciplinas_reprovadas_frequencia',
            'table' => 'detail',
            'description' => 'Disciplinas reprovadas por frequência',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Disciplinas reprovadas por nota',
            'name_database' => 'disciplinas_reprovadas_nota',
            'table' => 'detail',
            'description' => 'Disciplinas reprovadas por nota',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Idade',
            'name_database' => 'idade_situacao',
            'table' => 'detail',
            'description' => 'Idade',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Matriz curricular',
            'name_database' => 'matriz',
            'table' => 'detail',
            'description' => 'Matriz curricular',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Período',
            'name_database' => 'periodo',
            'table' => 'detail',
            'description' => 'Período',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Total de semestres cursados',
            'name_database' => 'quant_semestre_cursados',
            'table' => 'detail',
            'description' => 'Total de semestres cursados',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Ano de ingresso',
            'name_database' => 'ano_ingresso',
            'table' => 'student',
            'description' => 'Ano de ingresso',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Forma de ingresso',
            'name_database' => 'forma_ingresso',
            'table' => 'student',
            'description' => 'Forma de ingresso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Gênero',
            'name_database' => 'genero',
            'table' => 'student',
            'description' => 'Gênero',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Mudou de curso - mesmo câmpus',
            'name_database' => 'mudou_curso_mesmo_campus',
            'table' => 'student',
            'description' => 'Mudou de curso - mesmo câmpus',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Mudou de curso - outro câmpus',
            'name_database' => 'mudou_curso_outro_campus',
            'table' => 'student',
            'description' => 'Mudou de curso - outro câmpus',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Humanas',
            'name_database' => 'enem_humanas',
            'table' => 'student',
            'description' => 'Nota ENEM Humanas',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Liguagem',
            'name_database' => 'enem_linguagem',
            'table' => 'student',
            'description' => 'Nota ENEM Liguagem',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Matemática',
            'name_database' => 'enem_matematica',
            'table' => 'student',
            'description' => 'Nota ENEM Matemática',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Natureza',
            'name_database' => 'enem_natureza',
            'table' => 'student',
            'description' => 'Nota ENEM Natureza',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota ENEM Redação',
            'name_database' => 'enem_redacao',
            'table' => 'student',
            'description' => 'Nota ENEM Redação',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Nota final SISU',
            'name_database' => 'nota_final_sisu',
            'table' => 'student',
            'description' => 'Nota final SISU',
            'use_classify' => 1,
            'discretize' => 1,
            'nominal' => 0,
        ]);
        Variable::create([
            'name' => 'Número de entradas em outros cursos',
            'name_database' => 'entradas_outro_curso',
            'table' => 'student',
            'description' => 'Número de entradas em outros cursos',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Número de entradas no curso',
            'name_database' => 'entradas_curso',
            'table' => 'student',
            'description' => 'Número de entradas no curso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Semestre de ingresso no curso',
            'name_database' => 'semestre_ingresso',
            'table' => 'student',
            'description' => 'Semestre de ingresso no curso',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Tipo de cota',
            'name_database' => 'cota',
            'table' => 'student',
            'description' => 'Tipo de cota',
            'use_classify' => 1,
            'discretize' => 0,
            'nominal' => 1,
        ]);
        Variable::create([
            'name' => 'Idade Ingresso',
            'name_database' => 'idade_ingresso',
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
            'situation_short' => 'Outro',
            'situation_long' => 'Enade pendente',
            'description' => 'Enade pendente',
        ]);
        Situation::create([
            'situation_short' => 'Outro',
            'situation_long' => 'Afastado para estudos no exterior',
            'description' => 'Afastado para estudos no exterior',
        ]);
    }
}