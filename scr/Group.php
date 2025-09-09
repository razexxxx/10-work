<?php

declare(strict_types=1);

namespace App;

class Group
{
    public string $groupName;
    /** @var array<Student> */
    public array $students = [];

    public function __construct(string $groupName)
    {
        $this->groupName = $groupName;
    }

    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getGroupAverage(): float
    {
        if (empty($this->students)) {
            return 0;
        }

        $total = 0;
        foreach ($this->students as $student) {
            $total += $student->getAverage();
        }

        return $total / count($this->students);
    }

    public function getBestStudent(): ?Student
    {
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