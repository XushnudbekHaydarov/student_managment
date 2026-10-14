<?php

class Grade
{
    private int $student_id;
    private int $subject_id;
    private int $score;

    public function __construct(
        int $student_id,
        int $subject_id,
        int $score
    ) {
        if ($student_id <= 0) {
            echo "Talaba ID si noto'g'ri" . PHP_EOL;
            return;
        }

        if ($subject_id <= 0) {
            echo "Fan ID si noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->isValidScore($score)) {
            echo "Baho 0 dan 100 gacha bo'lishi kerak" . PHP_EOL;
            return;
        }

        $this->student_id = $student_id;
        $this->subject_id = $subject_id;
        $this->score = $score;
    }

    public function getStudentId(): int
    {
        return $this->student_id;
    }

    public function getSubjectId(): int
    {
        return $this->subject_id;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): bool
    {
        if (!$this->isValidScore($score)) {
            echo "Baho 0 dan 100 gacha bo'lishi kerak" . PHP_EOL;
            return false;
        }

        $this->score = $score;

        return true;
    }

    public function isValid(): bool
    {
        return isset($this->student_id, $this->subject_id, $this->score) && $this->student_id > 0 && $this->subject_id > 0 && $this->isValidScore($this->score);}

    private function isValidScore(int $score): bool
    {
        return $score >= 0 && $score <= 100;
    }
}