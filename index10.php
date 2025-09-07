<?php

// Класс Student
class Student {
    public $firstName;
    public $lastName;
    public $grades = [];

    public function __construct($firstName, $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    // Добавить оценку (в 100-балльной системе)
    public function addGrade($grade) {
        if (is_numeric($grade) && $grade >= 0 && $grade <= 100) {
            $this->grades[] = $grade;
        } else {
            echo "Ошибка: оценка должна быть числом от 0 до 100.\n";
        }
    }

    // Получить средний балл в 100-балльной системе (для внутренних расчётов)
    private function getRawAverage() {
        if (empty($this->grades)) {
            return 0;
        }
        return array_sum($this->grades) / count($this->grades);
    }

    // Получить оценку по 5-балльной системе
    public function getAverage() {
        $raw = $this->getRawAverage();

        if ($raw < 60) {
            return 2;
        } elseif ($raw < 75) {
            return 3;
        } elseif ($raw < 85) {
            return 4;
        } else {
            return 5;
        }
    }

    // Опционально: получить средний балл в виде дробного числа (для статистики)
    public function getRawGrade() {
        return $this->getRawAverage();
    }
}

// Класс Group
class Group {
    public $groupName;
    public $students = [];

    public function __construct($groupName) {
        $this->groupName = $groupName;
    }

    public function addStudent($student) {
        if ($student instanceof Student) {
            $this->students[] = $student;
        } else {
            echo "Ошибка: можно добавлять только объекты класса Student.\n";
        }
    }

    // Средний балл группы по 5-балльной шкале
    public function getGroupAverage() {
        if (empty($this->students)) {
            return 0;
        }

        $total = 0;
        foreach ($this->students as $student) {
            $total += $student->getAverage(); // используем 5-балльную оценку
        }

        return $total / count($this->students);
    }

    // Лучший студент — по 5-балльной оценке
    public function getBestStudent() {
        if (empty($this->students)) {
            return null;
        }

        $bestStudent = null;
        $bestGrade = 0;

        foreach ($this->students as $student) {
            $avg = $student->getAverage();
            if ($avg > $bestGrade) {
                $bestGrade = $avg;
                $bestStudent = $student;
            }
        }

        return $bestStudent;
    }
}

// Функция вывода информации о студенте (оценка в 5-балльной системе)
function printStudentInfo($student) {
    $fivePointGrade = $student->getAverage();
    $rawAverage = number_format($student->getRawGrade(), 2);
    echo "Студент: {$student->firstName} {$student->lastName}, Средний балл (5-ти балльная): {$fivePointGrade}, (из 100: {$rawAverage})\n";
}

// Функция вывода информации о группе
function printGroupInfo($group) {
    $groupAverage = number_format($group->getGroupAverage(), 2);
    echo "Группа: {$group->groupName}\n";
    echo "Количество студентов: " . count($group->students) . "\n";
    echo "Средний балл группы (по 5-балльной шкале): {$groupAverage}\n";
}

// === Пример использования ===

$student1 = new Student("Никита", "Реутов");
$student2 = new Student("Мария", "Перьмякова");
$student3 = new Student("Алексей", "Хоряков");

// Добавляем оценки в 100-балльной системе
$student1->addGrade(85);
$student1->addGrade(90);
$student1->addGrade(78); // среднее ~84.3 → оценка 4

$student2->addGrade(92);
$student2->addGrade(96);
$student2->addGrade(89); // среднее ~92.3 → оценка 5

$student3->addGrade(60);
$student3->addGrade(65);
$student3->addGrade(70); // среднее ~75 → оценка 4

// Создаём группу
$group = new Group("Группа П-31");
$group->addStudent($student1);
$group->addStudent($student2);
$group->addStudent($student3);

// Выводим информацию
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
?>