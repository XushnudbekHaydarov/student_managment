<?php
class Student {
    public  int $student_id;
    private string $full_name;
    private int $age;
    private string $email;

    private string $group;

    public function __construct(int $student_id,int $subject_id, int $age, string $email, string $group){
        $this->student_id = $student_id;
        $this->age = $age;
        $this->email = $email;
        $this->group = $group;
    }
    public function getId(): int
    {
        return $this->student_id;
    }
    public function getFullName(): string
    {
        return $this->full_name;
    }
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }
    public function getAge(): int
    {
        return $this->age;
    }
    public function setAge(int $age): void
    {
        $this->age = $age;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getGroup(): string
    {
        return $this->group;
    }
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }
    public function validateName(string $name): bool
    {
        if(trim($name) == ""){
            return false;
        }
        return true;
    }
}
