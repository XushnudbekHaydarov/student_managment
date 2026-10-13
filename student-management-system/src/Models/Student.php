<?php

class Student
{
    private int $student_id;
    private string $full_name;
    private int $age;
    private string $email;
    private string $group;

    public function __construct(
        int $student_id,
        string $full_name,
        int $age,
        string $email,
        string $group
    ) {
        if ($student_id <= 0) {
            echo "ID noto'g'ri" . PHP_EOL;
            return;
        }

        $this->student_id = $student_id;

        if (!$this->setFullName($full_name)) {
            echo "Ism noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->setAge($age)) {
            echo "Yosh noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->setEmail($email)) {
            echo "Email noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->setGroup($group)) {
            echo "Guruh noto'g'ri" . PHP_EOL;
            return;
        }
    }

    public function getId(): int
    {
        return $this->student_id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): bool
    {
        if ($this->validateName($full_name)) {
            $this->full_name = trim($full_name);
            return true;
        }

        return false;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): bool
    {
        if ($age <= 0) {
            return false;
        }

        $this->age = $age;
        return true;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        }

        return false;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): bool
    {
        if ($this->validateName($group)) {
            $this->group = trim($group);
            return true;
        }

        return false;
    }

    private function validateName(string $name): bool
    {
        return trim($name) !== "";
    }
}