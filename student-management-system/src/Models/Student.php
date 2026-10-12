<?php
class Student{
    public  int $student_id;
    private string $full_name;
    private int $age;
    private string $email;

    private string $group;

    public function __construct(int $student_id, int $age, string $email, string $group){
        $this->student_id = $student_id;
        $this->age = $age;
        $this->email = $email;
        $this->group = $group;
    }
    public function getId(){
        return $this->student_id;
    }
    public function getFullName(){
        return $this->full_name;
    }
    public function setFullName(string $full_name){
        $this->full_name = $full_name;
    }
    public function getAge(){
        return $this->age;
    }
    public function setAge(int $age){
        $this->age = $age;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function getGroup(){
        return $this->group;
    }
    public function setGroup(string $group){
        $this->group = $group;
    }
    public function validateName(string $name)
    {
        if(trim($name) == ""){
            return false;
        }

    }
}
