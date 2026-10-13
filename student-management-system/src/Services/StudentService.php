<?php

require_once __DIR__ . '/../Models/Student.php';
require_once __DIR__ . '/../Repositories/StudentRepository.php';

class StudentService
{
    private StudentRepository $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }
    public function createStudent(
        int $id,
        string $fullName,
        int $age,
        string $email,
        string $group
    ): bool
    {
        $student = new Student($id, $fullName, $age, $email, $group);

        return $this->repository->add($student);
    }

        public function getAllStudents(): array
    {
        return $this->repository->getAll();
    }


    public function getStudentById(int $id): ?Student
    {
        return $this->repository->findById($id);
    }

        public function updateStudent(Student $student): bool
    {
        return $this->repository->update($student);
    }


    public function deleteStudent(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function searchStudents(string $query): array
    {
        return $this->repository->search($query);
    }
}