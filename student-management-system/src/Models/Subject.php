<?php

class Subject
{
    private int $subject_id;
    private string $subject_name;

    public function __construct(
        int $subject_id,
        string $subject_name
    ) {
        $subject_name = trim($subject_name);

        if ($subject_id <= 0) {
            echo "Fan ID si noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->validateName($subject_name)) {
            echo "Fan nomi bo'sh bo'lishi mumkin emas" . PHP_EOL;
            return;
        }

        $this->subject_id = $subject_id;
        $this->subject_name = $subject_name;
    }

    public function getSubjectId(): int
    {
        return $this->subject_id;
    }

    public function getSubjectName(): string
    {
        return $this->subject_name;
    }

    public function setSubjectName(string $subject_name): bool
    {
        $subject_name = trim($subject_name);

        if (!$this->validateName($subject_name)) {
            echo "Fan nomi bo'sh bo'lishi mumkin emas" . PHP_EOL;
            return false;
        }

        $this->subject_name = $subject_name;
        return true;
    }

    private function validateName(string $subject_name): bool
    {
        return $subject_name !== '';
    }

    public function isValid(): bool
    {
        return isset($this->subject_id, $this->subject_name) && $this->subject_id > 0 && $this->validateName($this->subject_name);
    }
}
