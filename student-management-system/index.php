<?php

require_once __DIR__ . '/src/Models/Student.php';
require_once __DIR__ . '/src/Interfaces/ManageableInterface.php';
require_once __DIR__ . '/src/Interfaces/SearchableInterface.php';
require_once __DIR__ . '/src/Repositories/StudentRepository.php';
require_once __DIR__ . '/src/Services/StudentService.php';
require_once __DIR__ . '/src/Models/Subject.php';
require_once __DIR__ . '/src/Repositories/SubjectRepository.php';
require_once __DIR__ . '/src/Services/SubjectService.php';
require_once __DIR__ . '/src/Repositories/GradeRepository.php';
require_once __DIR__ . '/src/Services/GradeService.php';

$repository = new StudentRepository([]);
$service = new StudentService($repository);

$subjectRepository = new SubjectRepository([]);
$subjectService = new SubjectService($subjectRepository);

$gradeRepository = new GradeRepository();

$gradeService = new GradeService(
    $gradeRepository,
    $repository,
    $subjectRepository
);

function showStudent(Student $student): void
{
    echo "ID: " . $student->getId() . PHP_EOL;
    echo "Ism: " . $student->getFullName() . PHP_EOL;
    echo "Yosh: " . $student->getAge() . PHP_EOL;
    echo "Email: " . $student->getEmail() . PHP_EOL;
    echo "Guruh: " . $student->getGroup() . PHP_EOL;
    echo "------------------------" . PHP_EOL;
}

function showSubject(Subject $subject): void
{
    echo "Fan ID: " . $subject->getSubjectId() . PHP_EOL;
    echo "Fan nomi: " . $subject->getSubjectName() . PHP_EOL;
    echo "------------------------" . PHP_EOL;
}

function showGrade(Grade $grade): void
{
    echo "Talaba ID: " . $grade->getStudentId() . PHP_EOL;
    echo "Fan ID: " . $grade->getSubjectId() . PHP_EOL;
    echo "Baho: " . $grade->getScore() . PHP_EOL;
    echo "------------------------" . PHP_EOL;
}

while (true) {
    echo PHP_EOL;
    echo "===== STUDENT MANAGEMENT SYSTEM =====" . PHP_EOL;
    echo "1. Talaba qo'shish" . PHP_EOL;
    echo "2. Barcha talabalarni ko'rish" . PHP_EOL;
    echo "3. ID orqali talaba topish" . PHP_EOL;
    echo "4. Talaba ma'lumotlarini yangilash" . PHP_EOL;
    echo "5. Talabani o'chirish" . PHP_EOL;
    echo "6. Talaba qidirish" . PHP_EOL;
    echo "7. Fan qo'shish" . PHP_EOL;
    echo "8. Barcha fanlarni ko'rish" . PHP_EOL;
    echo "9. ID orqali fan topish" . PHP_EOL;
    echo "10. Fan nomini yangilash" . PHP_EOL;
    echo "11. Fanni o'chirish" . PHP_EOL;
    echo "12. Fan qidirish" . PHP_EOL;
    echo "13. Talabaga baho qo'shish" . PHP_EOL;
    echo "14. Barcha baholarni ko'rish" . PHP_EOL;
    echo "15. Talabaning baholarini ko'rish" . PHP_EOL;
    echo "16. Bahoni yangilash" . PHP_EOL;
    echo "17. Bahoni o'chirish" . PHP_EOL;
    echo "18. Talabaning o'rtacha bahosi" . PHP_EOL;
    echo "19. Talabaning o'tgan yoki o'tmaganini tekshirish" . PHP_EOL;
    echo "0. Chiqish" . PHP_EOL;

    $choice = trim(readline("Tanlovingiz: "));

    try {
        switch ($choice) {
            case '1':
                $id = (int)readline("Talaba ID si: ");
                $name = readline("To'liq ismi: ");
                $age = (int)readline("Yoshi: ");
                $email = readline("Email: ");
                $group = readline("Guruhi: ");

                if ($service->createStudent($id, $name, $age, $email, $group)) {
                    echo "Talaba muvaffaqiyatli qo'shildi!" . PHP_EOL;
                } else {
                    echo "Bu ID bilan talaba allaqachon mavjud!" . PHP_EOL;
                }
                break;

            case '2':
                $students = $service->getAllStudents();

                if (empty($students)) {
                    echo "Talabalar ro'yxati bo'sh." . PHP_EOL;
                    break;
                }

                foreach ($students as $student) {
                    showStudent($student);
                }
                break;

            case '3':
                $id = (int)readline("Qidirilayotgan ID: ");
                $student = $service->getStudentById($id);

                if ($student !== null) {
                    showStudent($student);
                } else {
                    echo "Talaba topilmadi." . PHP_EOL;
                }
                break;

            case '4':
                $id = (int)readline("Yangilanadigan talaba ID si: ");
                $existing = $service->getStudentById($id);

                if ($existing === null) {
                    echo "Talaba topilmadi." . PHP_EOL;
                    break;
                }

                $name = readline("Yangi to'liq ism: ");
                $age = (int)readline("Yangi yosh: ");
                $email = readline("Yangi email: ");
                $group = readline("Yangi guruh: ");

                $updatedStudent = new Student($id, $name, $age, $email, $group);

                if ($service->updateStudent($updatedStudent)) {
                    echo "Talaba ma'lumotlari yangilandi!" . PHP_EOL;
                } else {
                    echo "Talabani yangilash amalga oshmadi." . PHP_EOL;
                }
                break;

            case '5':
                $id = (int)readline("O'chiriladigan talaba ID si: ");

                if ($service->deleteStudent($id)) {
                    echo "Talaba o'chirildi!" . PHP_EOL;
                } else {
                    echo "Talaba topilmadi." . PHP_EOL;
                }
                break;

            case '6':
                $query = readline("Talaba ismi yoki ID sini kiriting: ");
                $results = $service->searchStudents($query);

                if (empty($results)) {
                    echo "Mos talabalar topilmadi." . PHP_EOL;
                    break;
                }

                foreach ($results as $student) {
                    showStudent($student);
                }
                break;
            case '7':
                $id = (int)readline("Fan ID si: ");
                $name = readline("Fan nomi: ");

                if ($subjectService->createSubject($id, $name)) {
                    echo "Fan muvaffaqiyatli qo'shildi!" . PHP_EOL;
                } else {
                    echo "Fan qo'shilmadi. Ma'lumotlarni tekshiring yoki ID takrorlangan." . PHP_EOL;
                }
                break;

            case '8':
                $subjects = $subjectService->getAllSubjects();

                if (empty($subjects)) {
                    echo "Fanlar ro'yxati bo'sh." . PHP_EOL;
                    break;
                }

                foreach ($subjects as $subject) {
                    showSubject($subject);
                }
                break;

            case '9':
                $id = (int)readline("Qidirilayotgan fan ID si: ");
                $subject = $subjectService->getSubjectById($id);

                if ($subject !== null) {
                    showSubject($subject);
                } else {
                    echo "Fan topilmadi." . PHP_EOL;
                }
                break;

            case '10':
                $id = (int)readline("Yangilanadigan fan ID si: ");
                $existingSubject = $subjectService->getSubjectById($id);

                if ($existingSubject === null) {
                    echo "Fan topilmadi." . PHP_EOL;
                    break;
                }

                $name = readline("Yangi fan nomi: ");

                if ($subjectService->updateSubject($id, $name)) {
                    echo "Fan muvaffaqiyatli yangilandi!" . PHP_EOL;
                } else {
                    echo "Fan yangilanmadi. Nomni tekshiring." . PHP_EOL;
                }
                break;

            case '11':
                $id = (int)readline("O'chiriladigan fan ID si: ");

                if ($subjectService->deleteSubject($id)) {
                    echo "Fan o'chirildi!" . PHP_EOL;
                } else {
                    echo "Fan topilmadi." . PHP_EOL;
                }
                break;

            case '12':
                $query = readline("Fan nomi yoki ID sini kiriting: ");
                $results = $subjectService->searchSubjects($query);

                if (empty($results)) {
                    echo "Mos fanlar topilmadi." . PHP_EOL;
                    break;
                }

                foreach ($results as $subject) {
                    showSubject($subject);
                }
                break;
            case '13':
                $student_id = (int)readline("Talaba ID: ");
                $subject_id = (int)readline("Fan ID: ");
                $score = (int)readline("Baho: ");

                if ($gradeService->createGrade($student_id, $subject_id, $score)) {
                    echo "Baho muvaffaqiyatli qo'shildi" . PHP_EOL;
                } else {
                    echo "Baho qo'shilmadi" . PHP_EOL;
                }
                break;

            case '14':
                $grades = $gradeService->getAllGrades();

                if (empty($grades)) {
                    echo "Baholar mavjud emas" . PHP_EOL;
                    break;
                }

                foreach ($grades as $grade) {
                    showGrade($grade);
                }
                break;

            case '15':
                $student_id = (int)readline("Talaba ID: ");
                $grades = $gradeService->getStudentGrades($student_id);

                if (empty($grades)) {
                    echo "Baholar topilmadi" . PHP_EOL;
                    break;
                }

                foreach ($grades as $grade) {
                    showGrade($grade);
                }
                break;

            case '16':
                $student_id = (int)readline("Talaba ID: ");
                $subject_id = (int)readline("Fan ID: ");
                $score = (int)readline("Yangi baho: ");

                if ($gradeService->updateGrade($student_id, $subject_id, $score)) {
                    echo "Baho yangilandi" . PHP_EOL;
                } else {
                    echo "Baho yangilanmadi" . PHP_EOL;
                }
                break;

            case '17':
                $student_id = (int)readline("Talaba ID: ");
                $subject_id = (int)readline("Fan ID: ");

                if ($gradeService->deleteGrade($student_id, $subject_id)) {
                    echo "Baho o'chirildi" . PHP_EOL;
                } else {
                    echo "Baho o'chirilmadi" . PHP_EOL;
                }
                break;

            case '18':
                $student_id = (int)readline("Talaba ID: ");
                $average = $gradeService->getAverageGrade($student_id);

                if ($average === null) {
                    echo "Baholanmagan" . PHP_EOL;
                } else {
                    echo "O'rtacha baho: " . round($average, 2) . PHP_EOL;
                }
                break;

            case '19':
                $student_id = (int)readline("Talaba ID: ");
                $passed = $gradeService->isPassed($student_id);

                if ($passed === null) {
                    echo "Baholanmagan" . PHP_EOL;
                } elseif ($passed) {
                    echo "O'tgan" . PHP_EOL;
                } else {
                    echo "O'tmagan" . PHP_EOL;
                }
                break;
            case '0':
                echo "Dastur tugatildi. Xayr!" . PHP_EOL;
                exit;

            default:
                echo "Noto'g'ri tanlov. Qayta urinib ko'ring." . PHP_EOL;
        }
    } catch (InvalidArgumentException $e) {
        echo "Xatolik: " . $e->getMessage() . PHP_EOL;
    } catch (Throwable $e) {
        echo "Kutilmagan xatolik: " . $e->getMessage() . PHP_EOL;
    }
}