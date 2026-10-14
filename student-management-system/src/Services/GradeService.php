<?php

require_once __DIR__ . '/../Models/Grade.php';
require_once __DIR__ . '/../Repositories/GradeRepository.php';
require_once __DIR__ . '/../Repositories/StudentRepository.php';
require_once __DIR__ . '/../Repositories/SubjectRepository.php';

class GradeService
{
    private GradeRepository $gradeRepository;
    private StudentRepository $studentRepository;
    private SubjectRepository $subjectRepository;

    public function __construct(
        GradeRepository $gradeRepository,
        StudentRepository $studentRepository,
        SubjectRepository $subjectRepository
    ) {
        $this->gradeRepository = $gradeRepository;
        $this->studentRepository = $studentRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function createGrade(
        int $student_id,
        int $subject_id,
        int $score
    ): bool {
        if ($this->studentRepository->findById($student_id) === null) {
            echo "Talaba topilmadi" . PHP_EOL;
            return false;
        }

        if ($this->subjectRepository->findById($subject_id) === null) {
            echo "Fan topilmadi" . PHP_EOL;
            return false;
        }

        $grade = new Grade($student_id, $subject_id, $score);

        if (!$grade->isValid()) {
            echo "Baho ma'lumotlari noto'g'ri" . PHP_EOL;
            return false;
        }

        return $this->gradeRepository->add($grade);
    }

    public function getAllGrades(): array
    {
        return $this->gradeRepository->getAll();
    }

    public function getGrade(
        int $student_id,
        int $subject_id
    ): ?Grade {
        return $this->gradeRepository->findByStudentAndSubject(
            $student_id,
            $subject_id
        );
    }

    public function updateGrade(
        int $student_id,
        int $subject_id,
        int $score
    ): bool {
        $grade = $this->gradeRepository->findByStudentAndSubject(
            $student_id,
            $subject_id
        );

        if ($grade === null) {
            echo "Baho topilmadi" . PHP_EOL;
            return false;
        }

        if (!$grade->setScore($score)) {
            return false;
        }

        return true;
    }

    public function deleteGrade(
        int $student_id,
        int $subject_id
    ): bool {
        return $this->gradeRepository->delete(
            $student_id,
            $subject_id
        );
    }

    public function getStudentGrades(int $student_id): array
    {
        if ($this->studentRepository->findById($student_id) === null) {
            echo "Talaba topilmadi" . PHP_EOL;
            return [];
        }

        return $this->gradeRepository->getByStudentId($student_id);
    }

    public function getSubjectGrades(int $subject_id): array
    {
        if ($this->subjectRepository->findById($subject_id) === null) {
            echo "Fan topilmadi" . PHP_EOL;
            return [];
        }

        return $this->gradeRepository->getBySubjectId($subject_id);
    }

    public function getAverageGrade(int $student_id): ?float
    {
        $grades = $this->getStudentGrades($student_id);

        if (empty($grades)) {
            return null;
        }

        $total = 0;

        foreach ($grades as $grade) {
            $total += $grade->getScore();
        }

        return $total / count($grades);
    }

    public function isPassed(int $student_id): ?bool
    {
        $average = $this->getAverageGrade($student_id);

        if ($average === null) {
            return null;
        }

        return $average >= 60;
    }
}