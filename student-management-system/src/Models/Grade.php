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
            throw new InvalidArgumentException("Talaba ID si noto'g'ri");
        }

        if ($subject_id <= 0) {
            throw new InvalidArgumentException("Fan ID si noto'g'ri");
        }

        $this->student_id = $student_id;
        $this->subject_id = $subject_id;

        $this->setScore($score);
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        if (!$this->isValidScore($score)) {
            throw new InvalidArgumentException(
                "Baho 0 dan 100 gacha bo'lishi kerak"
            );
        }

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

    public function isValid(): bool
    {
        return $this->isValidScore($this->score);
    }

    private function isValidScore(int $score): bool
    {
        return $score >= 0 && $score <= 100;
    }
}
