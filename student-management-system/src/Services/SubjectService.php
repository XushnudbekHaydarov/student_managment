<?php

require_once __DIR__ . '/../Models/Subject.php';
require_once __DIR__ . '/../Repositories/SubjectRepository.php';

class SubjectService
{
    private SubjectRepository $repository;

    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createSubject(int $id, string $name): bool
    {
        $subject = new Subject($id, $name);

        if (!$subject->isValid()) {
            return false;
        }

        return $this->repository->add($subject);
    }

    public function getAllSubjects(): array
    {
        return $this->repository->getAll();
    }

    public function getSubjectById(int $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function updateSubject(int $id, string $name): bool
    {
        $subject = new Subject($id, $name);

        if (!$subject->isValid()) {
            return false;
        }

        return $this->repository->update($subject);
    }

    public function deleteSubject(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function searchSubjects(string $query): array
    {
        return $this->repository->search($query);
    }
}
