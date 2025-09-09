<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use App\Student;
use App\Group;

$student1 = new Student("Никита", "Реутов");
$student2 = new Student("Мария", "Перьмякова");
$student3 = new Student("Алексей", "Хоряков");

$student1->addGrade(85);
$student1->addGrade(90);
$student1->addGrade(78);

$student2->addGrade(92);
$student2->addGrade(96);
$student2->addGrade(89);

$student3->addGrade(60);
$student3->addGrade(65);
$student3->addGrade(70);

$group = new Group("Группа П-31");
$group->addStudent($student1);
$group->addStudent($student2);
$group->addStudent($student3);

echo "=== Информация о студентах ===\n";
printStudentInfo($student1);
printStudentInfo($student2);
printStudentInfo($student3);

echo "\n=== Информация о группе ===\n";
printGroupInfo($group);

$best = $group->getBestStudent();
if ($best) {
    echo "\nЛучший студент: {$best->firstName} {$best->lastName} (оценка: {$best->getAverage()})\n";
}