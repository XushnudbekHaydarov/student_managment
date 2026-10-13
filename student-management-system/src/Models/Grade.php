<?php


class Grade
{
    private int $student_id;
    private int $subject_id;
    private int $score;

    public function __construct(int $student_id, int $subject_id, int $score)
    {
        $this->student_id = $student_id;
        $this->subject_id = $subject_id;

        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        if ($score > 0 and $score < 100) {
            return;
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
        return $this->score >= 0 && $this->score <= 100;
    }
}
