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
    public function update(Student $student): bool
    {
        foreach ($this->students as $index => $existingStudent) {
            if ($existingStudent->getId() === $student->getId()) {
                $this->students[$index] = $student;

                return true;
            }
        }

        return false;
    }
    public function delete(int $id): bool
    {
        foreach ($this->students as $index => $student) {
            if ($student->getId() === $id) {
                unset($this->students[$index]);

                $this->students = array_values($this->students);

                return true;
            }
        }

        return false;
    }
    public function findById(int $id): ?Student
    {
        foreach ($this->students as $student) {
            if ($student->getId() === $id) {
                return $student;
            }
        }

        return null;
    }
    public function search(string $query): array
    {
        $results = [];

        foreach ($this->students as $student) {
            if (stripos($student->getFullName(), $query) !== false || (string) $student->getId() === $query) {
                $results[] = $student;
            }
        }

        return $results;
    }

}