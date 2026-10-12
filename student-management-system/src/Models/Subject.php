<?php

class Subject
{
    public int $subject_id;
    public string $subject_name;

    public function __construct(int $subject_id, string $subject_name)
    {
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

    public function setSubjectName(int $subject_name)
    {
        $this->subject_name = $subject_name;
    }

    public function validateName(string $subject_name)
    {
        if (trim($subject_name) == "") {
            return false;
        }
        return true;

    }
}