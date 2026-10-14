<?php

require_once __DIR__ . '/../Models/Grade.php';

class GradeRepository
{
    private array $grades = [];

    public function __construct(array $grades = [])
    {
        foreach ($grades as $grade) {
            if ($grade instanceof Grade && $grade->isValid()) {
                $this->add($grade);
            }
        }
    }

    public function getAll(): array
    {
        return $this->grades;
    }

    public function findByStudentAndSubject(
        int $student_id,
        int $subject_id
    ): ?Grade {
        foreach ($this->grades as $grade) {
            if (
                $grade->getStudentId() === $student_id &&
                $grade->getSubjectId() === $subject_id
            ) {
                return $grade;
            }
        }

        return null;
    }

    public function add(Grade $grade): bool
    {
        if (!$grade->isValid()) {
            echo "Baho ma'lumotlari noto'g'ri" . PHP_EOL;
            return false;
        }

        $existingGrade = $this->findByStudentAndSubject(
            $grade->getStudentId(),
            $grade->getSubjectId()
        );

        if ($existingGrade !== null) {
            echo "Bu talaba ushbu fandan allaqachon baholangan"
                . PHP_EOL;
            return false;
        }

        $this->grades[] = $grade;

        return true;
    }

    public function update(Grade $grade): bool
    {
        if (!$grade->isValid()) {
            echo "Baho ma'lumotlari noto'g'ri" . PHP_EOL;
            return false;
        }

        $existingGrade = $this->findByStudentAndSubject(
            $grade->getStudentId(),
            $grade->getSubjectId()
        );

        if ($existingGrade === null) {
            echo "Yangilanadigan baho topilmadi" . PHP_EOL;
            return false;
        }

        $existingGrade->setScore($grade->getScore());

        return true;
    }

    public function delete(
        int $student_id,
        int $subject_id
    ): bool {
        foreach ($this->grades as $index => $grade) {
            if (
                $grade->getStudentId() === $student_id &&
                $grade->getSubjectId() === $subject_id
            ) {
                unset($this->grades[$index]);

                $this->grades = array_values($this->grades);

                return true;
            }
        }

        echo "O'chiriladigan baho topilmadi" . PHP_EOL;

        return false;
    }

    public function getByStudentId(int $student_id): array
    {
        $results = [];

        foreach ($this->grades as $grade) {
            if ($grade->getStudentId() === $student_id) {
                $results[] = $grade;
            }
        }

        return $results;
    }

    public function getBySubjectId(int $subject_id): array
    {
        $results = [];

        foreach ($this->grades as $grade) {
            if ($grade->getSubjectId() === $subject_id) {
                $results[] = $grade;
            }
        }

        return $results;
    }
}