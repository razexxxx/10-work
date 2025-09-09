<?php

declare(strict_types=1);

namespace App;

class Student
{
    public string $firstName;
    public string $lastName;
    /** @var array<int> */
    public array $grades = [];

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function addGrade(float|int $grade): void
    {
        if (is_numeric($grade) && $grade >= 0 && $grade <= 100) {
            $this->grades[] = (int)$grade;
        } else {
            echo "Ошибка: оценка должна быть числом от 0 до 100.\n";
        }
    }

    private function getRawAverage(): float
    {
        if (empty($this->grades)) {
            return 0;
        }
        return array_sum($this->grades) / count($this->grades);
    }

    public function getAverage(): int
    {
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

    public function getRawGrade(): float
    {
        return $this->getRawAverage();
    }
}