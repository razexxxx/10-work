<?php

declare(strict_types=1);

use App\Student;
use App\Group;

function printStudentInfo(Student $student): void
{
    $fivePointGrade = $student->getAverage();
    $rawAverage = number_format($student->getRawGrade(), 2);
    echo "Студент: {$student->firstName} {$student->lastName}, Средний балл (5-ти балльная): {$fivePointGrade}, (из 100: {$rawAverage})\n";
}

function printGroupInfo(Group $group): void
{
    $groupAverage = number_format($group->getGroupAverage(), 2);
    echo "Группа: {$group->groupName}\n";
    echo "Количество студентов: " . count($group->students) . "\n";
    echo "Средний балл группы (по 5-балльной шкале): {$groupAverage}\n";
}