<?php


class Subject
{
    private int $subject_id;
    private string $subject_name;

    public function __construct(int $subject_id, string $subject_name)
    {
        if ($subject_id <= 0) {
            throw new InvalidArgumentException("Fan ID si noto'g'ri");
        }

        $this->subject_id = $subject_id;
        $this->setSubjectName($subject_name);
    }

    public function getSubjectId(): int
    {
        return $this->subject_id;
    }

    public function getSubjectName(): string
    {
        return $this->subject_name;
    }

    public function setSubjectName(string $subject_name): void
    {
        if (!$this->validateName($subject_name)) {
            throw new InvalidArgumentException("Fan nomi bo'sh bo'lishi mumkin emas");
        }

        $this->subject_name = trim($subject_name);
    }

    private function validateName(string $subject_name): bool
    {
        return trim($subject_name) !== "";
    }
}
