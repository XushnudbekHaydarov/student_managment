<?php
class StudentRepository{
    private array $students;
    public function __construct(array $students){
        $this->students = $students;
    }
    public function add(Student $student): bool
    {
        if ($this->findById($student->getId()) !== null) {
            return false;
        }

        $this->students[] = $student;

        return true;
    }
    public function getAll(): array
    {
        return $this->students;
    }
    public function update(){}
    public function delete(){}
    public function findById(int $id): ?Student
    {
        foreach ($this->students as $student) {
            if ($student->getId() === $id) {
                return $student;
            }
        }

        return null;
    }

}