# 🎓 Student Management System
### PHP | OOP | MVC Architecture

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
![MVC](https://img.shields.io/badge/Pattern-MVC-orange?style=flat-square)

A full-featured **Student Management System** built with PHP using **Object-Oriented Programming (OOP)** principles and the **Model-View-Controller (MVC)** design pattern. This system allows administrators to manage students, courses, grades, attendance, and more through a clean and modular codebase.

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Architecture Overview](#-architecture-overview)
- [Database Design](#-database-design)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Routing](#-routing)
- [Controllers](#-controllers)
- [Models](#-models)
- [Views](#-views)
- [Security](#-security)
- [API Reference](#-api-reference)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

| Module | Features |
|---|---|
| **Authentication** | Login, logout, session management, role-based access |
| **Students** | Add, edit, delete, view students; profile photos; search & filter |
| **Courses** | Create and manage courses, assign teachers |
| **Enrollment** | Enroll/unenroll students in courses |
| **Grades** | Record and calculate GPA, generate report cards |
| **Attendance** | Mark daily attendance, view statistics |
| **Teachers** | Manage teacher profiles and course assignments |
| **Dashboard** | Summary statistics, charts, notifications |
| **Reports** | PDF/CSV export of grades, attendance, rosters |

---

## 🛠 Tech Stack

- **Backend:** PHP 8.1+
- **Database:** MySQL 8.0 / MariaDB 10.5+
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript (Vanilla)
- **Templating:** PHP native templates (no external engine required)
- **Server:** Apache (with `mod_rewrite`) or Nginx
- **Tools:** Composer (autoloading), PDO (database), PHPMailer (email)

---

## 📁 Project Structure

```
student-management-system/
│
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── StudentController.php
│   │   ├── CourseController.php
│   │   ├── GradeController.php
│   │   ├── AttendanceController.php
│   │   ├── TeacherController.php
│   │   └── DashboardController.php
│   │
│   ├── Models/
│   │   ├── BaseModel.php
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Course.php
│   │   ├── Grade.php
│   │   ├── Attendance.php
│   │   ├── Enrollment.php
│   │   └── Teacher.php
│   │
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── main.php
│   │   │   └── auth.php
│   │   ├── auth/
│   │   │   └── login.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── students/
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── show.php
│   │   ├── courses/
│   │   ├── grades/
│   │   └── attendance/
│   │
│   └── Core/
│       ├── Router.php
│       ├── Controller.php
│       ├── Model.php
│       ├── Database.php
│       ├── Session.php
│       ├── Auth.php
│       └── View.php
│
├── config/
│   ├── app.php
│   └── database.php
│
├── public/
│   ├── index.php          ← Entry point
│   ├── .htaccess
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── uploads/
│       └── students/
│
├── database/
│   ├── schema.sql
│   └── seed.sql
│
├── vendor/                ← Composer packages
├── .env.example
├── composer.json
└── README.md
```

---

## 🏗 Architecture Overview

This project follows the **MVC (Model-View-Controller)** pattern:

```
HTTP Request
     │
     ▼
┌──────────────┐
│  public/     │   ← Single entry point (index.php)
│  index.php   │
└──────┬───────┘
       │
       ▼
┌──────────────┐
│   Router     │   ← Parses URL, dispatches to controller
└──────┬───────┘
       │
       ▼
┌──────────────┐       ┌──────────┐
│  Controller  │ ────► │  Model   │   ← Business logic + DB queries
└──────┬───────┘       └──────────┘
       │
       ▼
┌──────────────┐
│    View      │   ← Renders HTML response
└──────────────┘
```

### Core Components

**`Router`** — Maps URL patterns (e.g. `GET /students/edit/3`) to controller methods using regex-based routing.

**`Controller (Base)`** — Abstract base class. Provides `render()`, `redirect()`, `json()` helpers and input validation.

**`Model (Base)`** — Abstract base class wrapping PDO. Provides `find()`, `findAll()`, `create()`, `update()`, `delete()`, `paginate()` methods.

**`Database`** — Singleton PDO wrapper. Manages a single database connection, prepared statements, and transaction support.

**`Auth`** — Session-based authentication guard. Manages login state and role checks (`admin`, `teacher`, `student`).

---

## 🗄 Database Design

### Entity Relationship Diagram (ERD)

```
users
 ├── id (PK)
 ├── name
 ├── email (UNIQUE)
 ├── password (hashed)
 ├── role  [admin | teacher | student]
 └── created_at

students
 ├── id (PK)
 ├── user_id (FK → users.id)
 ├── student_code (UNIQUE)
 ├── date_of_birth
 ├── gender
 ├── phone
 ├── address
 └── photo

teachers
 ├── id (PK)
 ├── user_id (FK → users.id)
 ├── employee_code (UNIQUE)
 ├── department
 └── specialization

courses
 ├── id (PK)
 ├── teacher_id (FK → teachers.id)
 ├── course_code (UNIQUE)
 ├── course_name
 ├── credits
 ├── description
 └── semester

enrollments
 ├── id (PK)
 ├── student_id (FK → students.id)
 ├── course_id (FK → courses.id)
 ├── enrolled_at
 └── status  [active | dropped | completed]

grades
 ├── id (PK)
 ├── enrollment_id (FK → enrollments.id)
 ├── midterm
 ├── final
 ├── assignment
 ├── total
 └── letter_grade

attendance
 ├── id (PK)
 ├── student_id (FK → students.id)
 ├── course_id (FK → courses.id)
 ├── date
 └── status  [present | absent | late | excused]
```

---

## ⚙️ Installation

### Prerequisites

- PHP >= 8.1 with extensions: `pdo`, `pdo_mysql`, `mbstring`, `fileinfo`
- MySQL 8.0 or MariaDB 10.5+
- Apache with `mod_rewrite` enabled (or Nginx)
- Composer

### Step-by-Step Setup

**1. Clone the repository**

```bash
git clone https://github.com/your-username/student-management-system.git
cd student-management-system
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Set up environment variables**

```bash
cp .env.example .env
```

Edit `.env` with your values (see [Configuration](#-configuration)).

**4. Create the database**

```bash
mysql -u root -p -e "CREATE DATABASE student_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p student_db < database/schema.sql
mysql -u root -p student_db < database/seed.sql   # optional demo data
```

**5. Configure Apache Virtual Host**

```apache
<VirtualHost *:80>
    ServerName sms.local
    DocumentRoot /var/www/student-management-system/public
    
    <Directory /var/www/student-management-system/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**6. Set file permissions**

```bash
chmod -R 755 public/uploads
chmod 644 .env
```

**7. Open in browser**

```
http://sms.local
```

---

## 🔧 Configuration

### `.env` File

```env
# Application
APP_NAME="Student Management System"
APP_ENV=development
APP_DEBUG=true
APP_URL=http://sms.local
APP_KEY=your-random-32-char-secret-key

# Database
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_db
DB_USERNAME=root
DB_PASSWORD=secret

# Session
SESSION_LIFETIME=120
SESSION_NAME=sms_session

# Mail (optional)
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM=noreply@sms.local
```

### `config/database.php`

```php
return [
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'dbname'   => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset'  => 'utf8mb4',
    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ],
];
```

---

## 🚀 Usage

### Default Admin Credentials (after seeding)

| Role | Email | Password |
|---|---|---|
| Admin | `admin@sms.local` | `Admin@123` |
| Teacher | `teacher@sms.local` | `Teacher@123` |
| Student | `student@sms.local` | `Student@123` |

> ⚠️ **Change all default passwords immediately after first login.**

### Dashboard

After login, each role sees a tailored dashboard:

- **Admin:** Total students, teachers, courses, recent activity
- **Teacher:** My courses, pending grades, today's attendance
- **Student:** My courses, GPA summary, attendance rate

---

## 🔀 Routing

Routes are defined in `public/index.php` using the `Router` class:

```php
// Auth
$router->get('/login',  'AuthController@showLogin');
$router->post('/login',  'AuthController@login');
$router->get('/logout', 'AuthController@logout');

// Students (Admin only)
$router->get('/students',           'StudentController@index');
$router->get('/students/create',    'StudentController@create');
$router->post('/students',          'StudentController@store');
$router->get('/students/{id}',      'StudentController@show');
$router->get('/students/{id}/edit', 'StudentController@edit');
$router->post('/students/{id}',     'StudentController@update');
$router->post('/students/{id}/delete', 'StudentController@destroy');

// Grades
$router->get('/grades/{enrollmentId}',  'GradeController@show');
$router->post('/grades/{enrollmentId}', 'GradeController@save');

// Attendance
$router->get('/attendance/{courseId}',       'AttendanceController@index');
$router->post('/attendance/{courseId}/mark', 'AttendanceController@mark');
```

### URL Pattern Examples

| Method | URL | Controller Action |
|---|---|---|
| GET | `/students` | `StudentController@index` |
| GET | `/students/5` | `StudentController@show` |
| POST | `/students` | `StudentController@store` |
| POST | `/students/5` | `StudentController@update` |
| GET | `/courses/3/enroll` | `CourseController@enroll` |

---

## 🎮 Controllers

### Base Controller (`app/Core/Controller.php`)

```php
abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require_once APP_PATH . "/Views/{$view}.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function json(mixed $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function validate(array $data, array $rules): array { /* ... */ }
}
```

### StudentController Example

```php
class StudentController extends Controller
{
    private Student $studentModel;

    public function __construct()
    {
        Auth::requireRole('admin');  // Guard route
        $this->studentModel = new Student();
    }

    public function index(): void
    {
        $students = $this->studentModel->paginate(20);
        $this->render('students/index', compact('students'));
    }

    public function store(): void
    {
        $errors = $this->validate($_POST, [
            'name'  => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
        ]);

        if (!empty($errors)) {
            $this->render('students/create', compact('errors'));
            return;
        }

        $this->studentModel->create($_POST);
        $this->redirect('/students');
    }
}
```

---

## 📦 Models

### Base Model (`app/Core/Model.php`)

```php
abstract class Model
{
    protected PDO $db;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function find(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findAll(array $conditions = []): array { /* ... */ }
    public function create(array $data): int { /* ... */ }
    public function update(int $id, array $data): bool { /* ... */ }
    public function delete(int $id): bool { /* ... */ }
    public function paginate(int $perPage = 15, int $page = 1): array { /* ... */ }
}
```

### Student Model

```php
class Student extends Model
{
    protected string $table = 'students';

    public function findWithUser(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT s.*, u.name, u.email, u.role
            FROM students s
            JOIN users u ON s.user_id = u.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getGPA(int $studentId): float
    {
        $stmt = $this->db->prepare("
            SELECT AVG(g.total) as gpa
            FROM grades g
            JOIN enrollments e ON g.enrollment_id = e.id
            WHERE e.student_id = ?
        ");
        $stmt->execute([$studentId]);
        return round($stmt->fetchColumn(), 2);
    }
}
```

---

## 🖼 Views

Views are plain PHP files. The layout wraps the content automatically:

### Layout (`app/Views/layouts/main.php`)

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?? 'SMS' ?> | Student Management</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
    <main class="container mt-4">
        <?php include __DIR__ . '/../partials/alerts.php'; ?>
        <?= $content ?>
    </main>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### Student List View (snippet)

```php
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>All Students</h5>
        <a href="/students/create" class="btn btn-primary btn-sm">+ Add Student</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>GPA</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($students['data'] as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['student_code']) ?></td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= $student['gpa'] ?></td>
                    <td>
                        <a href="/students/<?= $student['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/students/<?= $student['id'] ?>" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
```

---

## 🔐 Security

This system applies the following security best practices:

| Concern | Implementation |
|---|---|
| **SQL Injection** | All queries use PDO prepared statements — no raw user input in SQL |
| **XSS** | All output escaped with `htmlspecialchars()` |
| **CSRF** | CSRF token generated per session, validated on all POST requests |
| **Password Storage** | `password_hash()` with `PASSWORD_BCRYPT` |
| **Session Fixation** | `session_regenerate_id(true)` on login |
| **Access Control** | Role-based guards on every controller (`admin`, `teacher`, `student`) |
| **File Upload** | MIME type validation, restricted extensions, random filename generation |
| **HTTP Headers** | `X-Frame-Options`, `X-Content-Type-Options`, `Content-Security-Policy` |

### CSRF Token Usage

```php
// In form views:
<input type="hidden" name="csrf_token" value="<?= Session::csrfToken() ?>">

// In controller:
if (!Session::verifyCsrfToken($_POST['csrf_token'])) {
    http_response_code(403);
    die('CSRF token mismatch');
}
```

---

## 📡 API Reference

The system exposes a lightweight JSON API for AJAX calls (e.g. live search, attendance marking).

### Endpoints

```
GET  /api/students?search=ali          Search students by name
GET  /api/students/{id}/grades         Get student grade summary
POST /api/attendance/mark              Mark attendance (JSON body)
GET  /api/courses/{id}/students        List enrolled students
GET  /api/reports/attendance/{id}      Attendance stats for a student
```

### Example Request & Response

```http
GET /api/students?search=ali HTTP/1.1
Authorization: Bearer <session_token>
```

```json
{
  "success": true,
  "data": [
    {
      "id": 12,
      "student_code": "STU-2024-012",
      "name": "Ali Hassan",
      "email": "ali@example.com",
      "gpa": 3.75
    }
  ],
  "total": 1
}
```

---

## 🧪 Running Tests

```bash
# Install PHPUnit (if not already)
composer require --dev phpunit/phpunit

# Run all tests
./vendor/bin/phpunit tests/

# Run a specific test file
./vendor/bin/phpunit tests/Unit/StudentModelTest.php
```

Test files are located in:

```
tests/
├── Unit/
│   ├── StudentModelTest.php
│   ├── GradeModelTest.php
│   └── AuthTest.php
└── Feature/
    ├── StudentCrudTest.php
    └── AttendanceTest.php
```

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/add-notifications`
3. Commit your changes: `git commit -m "Add: email notifications for grades"`
4. Push to branch: `git push origin feature/add-notifications`
5. Open a Pull Request

### Coding Standards

- Follow **PSR-12** coding style
- Use **type hints** on all method parameters and return types
- Write **PHPDoc** blocks for all public methods
- Every new feature must include **unit tests**

---

## 📄 License

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2024 Your Name

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction...
```

See [LICENSE](LICENSE) for the full text.

---

## 📬 Contact

**Author:** Your Name
**Email:** your.email@example.com
**GitHub:** [@your-username](https://github.com/your-username)

---

> Built with ❤️ using PHP OOP and the MVC design pattern.
