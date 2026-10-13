<?php
class Student {
    private int $student_id;
    private string $full_name;
    private int $age;
    private string $email;
    private string $group;

    public function __construct(int $student_id,string $full_name, int $age, string $email, string $group){

        if ($student_id <= 0) {
            throw new InvalidArgumentException("ID noto'g'ri");
        }
        $this->student_id = $student_id;
        if (!$this->setFullName($full_name)) {
            throw new InvalidArgumentException("Ism noto'g'ri");
        }
        if (!$this->setAge($age)) {
            throw new InvalidArgumentException("Yosh noto'g'ri");
        }
        if (!$this->setEmail($email)) {
            throw new InvalidArgumentException("Email noto'g'ri");
        }
        if (!$this->setGroup($group)) {
            throw new InvalidArgumentException("Guruh noto'g'ri");
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
        if ($this->validateName($full_name))
        {
            $this->full_name = $full_name;
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
        if ( $age<=0 ) {
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
        if ($this->validateName($group))
        {
            $this->group = $group;
            return true;
        }
        return false;
    }
    private function validateName(string $name): bool
    {
        if(trim($name) == ""){
            return false;
        }
        return true;
    }
}
