<?php

require_once __DIR__ . '/src/Models/Student.php';
require_once __DIR__ . '/src/Models/Group.php';
require_once __DIR__ . '/src/Models/Subject.php';
require_once __DIR__ . '/src/Models/Grade.php';

require_once __DIR__ . '/src/Interfaces/ManageableInterface.php';
require_once __DIR__ . '/src/Interfaces/SearchableInterface.php';

require_once __DIR__ . '/src/Repositories/GroupRepository.php';
require_once __DIR__ . '/src/Repositories/StudentRepository.php';
require_once __DIR__ . '/src/Repositories/SubjectRepository.php';
require_once __DIR__ . '/src/Repositories/GradeRepository.php';

require_once __DIR__ . '/src/Services/GroupService.php';
require_once __DIR__ . '/src/Services/StudentService.php';
require_once __DIR__ . '/src/Services/SubjectService.php';
require_once __DIR__ . '/src/Services/GradeService.php';

$groupRepository = new GroupRepository([]);
$groupService = new GroupService($groupRepository);

$repository = new StudentRepository([]);
$service = new StudentService($repository, $groupRepository);

$subjectRepository = new SubjectRepository([]);
$subjectService = new SubjectService($subjectRepository);

$gradeRepository = new GradeRepository();

$gradeService = new GradeService(
    $gradeRepository,
    $repository,
    $subjectRepository
);


function showStudent(
    Student      $student,
    GroupService $groupService
): void
{
    echo "ID: " . $student->getId() . PHP_EOL;
    echo "Ism: " . $student->getFullName() . PHP_EOL;
    echo "Yosh: " . $student->getAge() . PHP_EOL;
    echo "Email: " . $student->getEmail() . PHP_EOL;

    $group = $groupService->getGroupById(
        $student->getGroupId()
    );

    echo "Guruh: " .
        ($group !== null ? $group->getGroupName() : "Topilmadi")
        . PHP_EOL;

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


function color(string $text, string $color): string
{
    $colors = [
        'red' => "\033[31m",
        'green' => "\033[32m",
        'yellow' => "\033[33m",
        'blue' => "\033[34m",
        'magenta' => "\033[35m",
        'cyan' => "\033[36m",
        'white' => "\033[37m",
        'bold' => "\033[1m",
        'reset' => "\033[0m",
    ];

    return ($colors[$color] ?? $colors['white'])
        . $text
        . $colors['reset'];
}

function line(): void
{
    echo color(
            "============================================================",
            'cyan'
        ) . PHP_EOL;
}


while (true) {
    echo PHP_EOL;

    line();

    echo color(
            "             STUDENT MANAGEMENT SYSTEM",
            'bold'
        ) . PHP_EOL;

    line();

    echo color("  TALABALAR", 'yellow') . PHP_EOL;
    echo color("  [01]", 'green') . " Talaba qo'shish" . PHP_EOL;
    echo color("  [02]", 'green') . " Barcha talabalarni ko'rish" . PHP_EOL;
    echo color("  [03]", 'green') . " ID orqali talaba topish" . PHP_EOL;
    echo color("  [04]", 'green') . " Talaba ma'lumotlarini yangilash" . PHP_EOL;
    echo color("  [05]", 'green') . " Talabani o'chirish" . PHP_EOL;
    echo color("  [06]", 'green') . " Talaba qidirish" . PHP_EOL;

    echo PHP_EOL;
    echo color("  FANLAR", 'yellow') . PHP_EOL;
    echo color("  [07]", 'blue') . " Fan qo'shish" . PHP_EOL;
    echo color("  [08]", 'blue') . " Barcha fanlarni ko'rish" . PHP_EOL;
    echo color("  [09]", 'blue') . " ID orqali fan topish" . PHP_EOL;
    echo color("  [10]", 'blue') . " Fan nomini yangilash" . PHP_EOL;
    echo color("  [11]", 'blue') . " Fanni o'chirish" . PHP_EOL;
    echo color("  [12]", 'blue') . " Fan qidirish" . PHP_EOL;

    echo PHP_EOL;
    echo color("  BAHOLAR", 'yellow') . PHP_EOL;
    echo color("  [13]", 'magenta') . " Talabaga baho qo'shish" . PHP_EOL;
    echo color("  [14]", 'magenta') . " Barcha baholarni ko'rish" . PHP_EOL;
    echo color("  [15]", 'magenta') . " Talabaning baholarini ko'rish" . PHP_EOL;
    echo color("  [16]", 'magenta') . " Bahoni yangilash" . PHP_EOL;
    echo color("  [17]", 'magenta') . " Bahoni o'chirish" . PHP_EOL;
    echo color("  [18]", 'magenta') . " Talabaning o'rtacha bahosi" . PHP_EOL;
    echo color("  [19]", 'magenta') . " Talabaning o'tgan yoki o'tmaganini tekshirish" . PHP_EOL;

    echo PHP_EOL;
    echo color("  GURUHLAR", 'yellow') . PHP_EOL;
    echo color("  [20]", 'cyan') . " Guruh qo'shish" . PHP_EOL;
    echo color("  [21]", 'cyan') . " Barcha guruhlarni ko'rish" . PHP_EOL;
    echo color("  [22]", 'cyan') . " ID orqali guruh topish" . PHP_EOL;
    echo color("  [23]", 'cyan') . " Guruh nomini yangilash" . PHP_EOL;
    echo color("  [24]", 'cyan') . " Guruhni o'chirish" . PHP_EOL;
    echo color("  [25]", 'cyan') . " Guruh qidirish" . PHP_EOL;

    line();

    echo color("  [0]", 'red') . " Chiqish" . PHP_EOL;

    line();

    $choice = trim(readline(
        color("  Tanlovingiz >> ", 'bold')
    ));

    try {
        switch ($choice) {

            case '1':
                $id = (int)readline("Talaba ID si: ");
                $name = readline("To'liq ismi: ");
                $age = (int)readline("Yoshi: ");
                $email = readline("Email: ");

                $groups = $groupService->getAllGroups();

                if (empty($groups)) {
                    echo "Avval guruh yaratishingiz kerak!" . PHP_EOL;
                    break;
                }

                echo "Mavjud guruhlar:" . PHP_EOL;

                foreach ($groups as $group) {
                    echo $group->getGroupId() . ". "
                        . $group->getGroupName() . PHP_EOL;
                }

                $group_id = (int)readline("Guruh ID si: ");

                if ($service->createStudent(
                    $id,
                    $name,
                    $age,
                    $email,
                    $group_id
                )) {
                    echo "Talaba muvaffaqiyatli qo'shildi!" . PHP_EOL;
                } else {
                    echo "Talaba qo'shilmadi. Ma'lumotlarni tekshiring." . PHP_EOL;
                }
                break;

            case '2':
                $students = $service->getAllStudents();

                if (empty($students)) {
                    echo "Talabalar ro'yxati bo'sh." . PHP_EOL;
                    break;
                }

                foreach ($students as $student) {
                    showStudent($student, $groupService);
                }
                break;

            case '3':
                $id = (int)readline("Qidirilayotgan ID: ");
                $student = $service->getStudentById($id);

                if ($student !== null) {
                    showStudent($student, $groupService);
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

                $groups = $groupService->getAllGroups();

                if (empty($groups)) {
                    echo "Guruhlar mavjud emas." . PHP_EOL;
                    break;
                }

                echo "Mavjud guruhlar:" . PHP_EOL;

                foreach ($groups as $group) {
                    echo $group->getGroupId() . ". "
                        . $group->getGroupName() . PHP_EOL;
                }

                $group_id = (int)readline("Yangi guruh ID si: ");

                $updatedStudent = new Student(
                    $id,
                    $name,
                    $age,
                    $email,
                    $group_id
                );

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
                    showStudent($student, $groupService);
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

            case '20':
                $id = (int)readline("Guruh ID si: ");
                $name = readline("Guruh nomi: ");

                if ($groupService->createGroup($id, $name)) {
                    echo "Guruh muvaffaqiyatli qo'shildi!" . PHP_EOL;
                } else {
                    echo "Guruh qo'shilmadi. Ma'lumotlarni tekshiring yoki ID takrorlangan." . PHP_EOL;
                }
                break;

            case '21':
                $groups = $groupService->getAllGroups();

                if (empty($groups)) {
                    echo "Guruhlar ro'yxati bo'sh." . PHP_EOL;
                    break;
                }

                foreach ($groups as $group) {
                    echo "ID: " . $group->getGroupId() . PHP_EOL;
                    echo "Guruh nomi: " . $group->getGroupName() . PHP_EOL;
                    echo "------------------------" . PHP_EOL;
                }
                break;

            case '22':
                $id = (int)readline("Guruh ID si: ");
                $group = $groupService->getGroupById($id);

                if ($group !== null) {
                    echo "ID: " . $group->getGroupId() . PHP_EOL;
                    echo "Guruh nomi: " . $group->getGroupName() . PHP_EOL;
                } else {
                    echo "Guruh topilmadi." . PHP_EOL;
                }
                break;

            case '23':
                $id = (int)readline("Yangilanadigan guruh ID si: ");
                $name = readline("Yangi guruh nomi: ");

                if ($groupService->updateGroup($id, $name)) {
                    echo "Guruh yangilandi!" . PHP_EOL;
                } else {
                    echo "Guruh yangilanmadi. ID yoki nomni tekshiring." . PHP_EOL;
                }
                break;

            case '24':
                $id = (int)readline("O'chiriladigan guruh ID si: ");

                if ($groupService->deleteGroup($id)) {
                    echo "Guruh o'chirildi!" . PHP_EOL;
                } else {
                    echo "Guruh topilmadi yoki o'chirilmadi." . PHP_EOL;
                }
                break;

            case '25':
                $query = readline("Guruh nomi yoki ID sini kiriting: ");
                $groups = $groupService->searchGroups($query);

                if (empty($groups)) {
                    echo "Guruh topilmadi." . PHP_EOL;
                    break;
                }

                foreach ($groups as $group) {
                    echo "ID: " . $group->getGroupId() . PHP_EOL;
                    echo "Guruh nomi: " . $group->getGroupName() . PHP_EOL;
                    echo "------------------------" . PHP_EOL;
                }
                break;

            case '0':
                echo "Dastur tugatildi. Xayr!" . PHP_EOL;
                exit;

            default:
                echo "Noto'g'ri tanlov. Qayta urinib ko'ring." . PHP_EOL;
        }
    } catch (InvalidArgumentException $e) {
        echo color("Xatolik: " . $e->getMessage(), 'red') . PHP_EOL;
    } catch (Throwable $e) {
        echo color("Kutilmagan xatolik: " . $e->getMessage(), 'red') . PHP_EOL;
    }
}
