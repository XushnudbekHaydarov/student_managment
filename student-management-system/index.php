<?php

require_once __DIR__ . '/src/Models/Student.php';
require_once __DIR__ . '/src/Interfaces/ManageableInterface.php';
require_once __DIR__ . '/src/Interfaces/SearchableInterface.php';
require_once __DIR__ . '/src/Repositories/StudentRepository.php';
require_once __DIR__ . '/src/Services/StudentService.php';

$repository = new StudentRepository([]);
$service = new StudentService($repository);

function showStudent(Student $student): void
{
    echo "ID: " . $student->getId() . PHP_EOL;
    echo "Ism: " . $student->getFullName() . PHP_EOL;
    echo "Yosh: " . $student->getAge() . PHP_EOL;
    echo "Email: " . $student->getEmail() . PHP_EOL;
    echo "Guruh: " . $student->getGroup() . PHP_EOL;
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
    echo "0. Chiqish" . PHP_EOL;

    $choice = trim(readline("Tanlovingiz: "));

    try {
        switch ($choice) {
            case '1':
                $id = (int) readline("Talaba ID si: ");
                $name = readline("To'liq ismi: ");
                $age = (int) readline("Yoshi: ");
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
                $id = (int) readline("Qidirilayotgan ID: ");
                $student = $service->getStudentById($id);

                if ($student !== null) {
                    showStudent($student);
                } else {
                    echo "Talaba topilmadi." . PHP_EOL;
                }
                break;

            case '4':
                $id = (int) readline("Yangilanadigan talaba ID si: ");
                $existing = $service->getStudentById($id);

                if ($existing === null) {
                    echo "Talaba topilmadi." . PHP_EOL;
                    break;
                }

                $name = readline("Yangi to'liq ism: ");
                $age = (int) readline("Yangi yosh: ");
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
                $id = (int) readline("O'chiriladigan talaba ID si: ");

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