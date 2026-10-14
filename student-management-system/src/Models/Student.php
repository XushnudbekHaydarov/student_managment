<?php

class Student
{
    private int $student_id;
    private string $full_name;
    private int $age;
    private string $email;
    private int $group_id;

    public function __construct(
        int $student_id,
        string $full_name,
        int $age,
        string $email,
        int $group_id
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

        if (!$this->setGroupId($group_id)) {
            echo "Guruh ID si noto'g'ri" . PHP_EOL;
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
        $full_name = trim($full_name);

        if (!$this->validateName($full_name)) {
            return false;
        }

        $this->full_name = $full_name;
        return true;
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
        $email = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->email = $email;
        return true;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): bool
    {
        if ($group_id <= 0) {
            return false;
        }

        $this->group_id = $group_id;
        return true;
    }

    private function validateName(string $name): bool
    {
        return trim($name) !== '';
    }

    public function isValid(): bool
    {
        return isset(
                $this->student_id,
                $this->full_name,
                $this->age,
                $this->email,
                $this->group_id
            )
            && $this->student_id > 0
            && $this->validateName($this->full_name)
            && $this->age > 0
            && filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false
            && $this->group_id > 0;
    }
}
