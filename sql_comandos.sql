SELECT probability.probability_evasion
FROM test_classifier
LEFT JOIN probability
ON test_classifier.id = probability.test_classifier_id
WHERE test_classifier.period_calculation = (SELECT MAX(test_classifier.period_calculation)
                                  FROM test_classifier
                                  WHERE test_classifier.type = 9
                                  AND test_classifier.result = 1)
AND test_classifier.type = 9
AND test_classifier.result = 1
AND probability.student_id = 1

------------------- Ultimo detalhe do aluno -------------------
SELECT detail.*
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND student.id =1

------------------- Quantidade de alunos evadidos por Ano/Semestre -------------------
SELECT Concat(detail.year_situation,"-",detail.semester_situation ) as ano_semestre,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
GROUP BY ano_semestre;

-----------------------------------------------------------------------------------------------
--------------------------------------------- GÊNERO ------------------------------------------
-----------------------------------------------------------------------------------------------

SELECT situation.situation_short, student.genre,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short != "Outro"
AND student.course_id = 1
GROUP BY situation.situation_short, student.genre
ORDER BY situation.situation_short ASC

------------------- Quantidade de alunos evadidos por Gênero -------------------
-- Retorna os alunos evadidos por gênero de toda a instituição
SELECT student.genre,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
GROUP BY student.genre;

------------------- Quantidade de alunos evadidos por Gênero por Campus -------------------
-- Retorna os alunos evadidos por gênero de um campus
SELECT student.genre,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
AND campus.id = :campus
GROUP BY student.genre;

------------------- Quantidade de alunos evadidos por Gênero por Curso -------------------
-- Retorna os alunos evadidos por gênero de um curso
SELECT student.genre,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
AND student.course_id = :course
GROUP BY student.genre;


-----------------------------------------------------------------------------------------------
-------------------------------------------- PERÍODO ------------------------------------------
-----------------------------------------------------------------------------------------------
------------------- Quantidade de alunos evadidos por Período -------------------
-- Retorna os alunos evadidos por período de toda a instituição
SELECT detail.period,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
GROUP BY detail.period

------------------- Quantidade de alunos evadidos por Período por Campus -------------------
-- Retorna os alunos evadidos por período de um campus
SELECT detail.period,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
AND campus.id = :campus
GROUP BY detail.period;

------------------- Quantidade de alunos evadidos por Período por Curso -------------------
-- Retorna os alunos evadidos por período de um curso
SELECT detail.period,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short = "Evadido"
AND student.course_id = :course
GROUP BY detail.period;

-----------------------------------------------------------------------------------------------
-------------------------------------------- IDADE INGRESSO ------------------------------------------
-----------------------------------------------------------------------------------------------
------------------- Quantidade de por situcao resumida e idade ingresso -------------------
SELECT situation.situation_short, student.age,  COUNT(student.id) AS total
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN situation ON detail.situation_id = situation.id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND situation.situation_short != "Outro"
AND student.course_id = 1
GROUP BY situation.situation_short, student.age
ORDER BY student.age ASC






SELECT student.name,detail.year_situation, detail.semester_situation, test_classifier.id, probability.probability_evasion
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
LEFT JOIN test_classifier ON course.id = test_classifier.course_id
LEFT JOIN probability ON test_classifier.id = probability.test_classifier_id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND course.id = 2
AND test_classifier.type = 9
AND test_classifier.period_calculation = (SELECT IFNULL(MAX(test_classifier.period_calculation),1) as period_calculation
FROM test_classifier
WHERE test_classifier.type = 9)
AND probability.student_id = student.id


SELECT student.name,detail.year_situation, detail.semester_situation, test_classifier.id, probability.probability_evasion
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
LEFT JOIN probability ON student.id = probability.student_id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND course.id = 2
AND probability.test_classifier_id = 1868

SELECT student.name, detail.year_situation, detail.semester_situation, detail.period, student.quota, detail.semesters, situation.situation_long, situation.situation_short, student.id, probability.probability_evasion
FROM student
LEFT JOIN detail ON student.id = detail.student_id
LEFT JOIN course ON student.course_id = course.id
LEFT JOIN campus ON course.campus_id = campus.id
LEFT JOIN situation ON detail.situation_id = situation.id
LEFT JOIN probability ON student.id = probability.student_id
WHERE detail.loading_period = (SELECT MAX(detail.loading_period) FROM detail WHERE detail.student_id = student.id)
AND course.id = 2
AND probability.test_classifier_id = 1868