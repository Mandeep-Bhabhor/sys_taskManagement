Task Management System (Laravel 12)

A role-based Task Management System built using Laravel 12 where:

Managers can create and view tasks

Tasks are assigned to staff

Staff can view and mark tasks as completed

Role-based dashboards for Manager and Staff

Secure authentication and logout system

Features
Manager

View all tasks

See assigned staff for each task

Track task status (Pending / Completed)

Staff

View only their assigned tasks

Mark tasks as completed

Secure dashboard access

Authentication

Login & logout

Role-based access control

Middleware protected routes

Tech Stack

Laravel 12

PHP 8.2+

MySQL

Bootstrap 5

Blade Templates

Installation (ZIP Download Setup)
1. Download & Extract

Download the project ZIP from GitHub and extract it:

Task_Management/


Open in VS Code or any editor.

2. Install Dependencies
composer install


(Optional frontend)

npm install

3. Environment Setup

Copy .env.example and rename to:

.env


Generate app key:

php artisan key:generate

4. Database Configuration

Edit .env:

DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=


Create database:

CREATE DATABASE task_management;

5. Run Migrations
php artisan migrate


This creates:

users

tasks

roles & auth tables

6. Create Roles

In users table:

role = manager
role = staff


You can update manually:

UPDATE users SET role='manager' WHERE id=1;
UPDATE users SET role='staff' WHERE id=2;

7. Start Server
php artisan serve


Visit:

http://127.0.0.1:8000

Routes Overview
URL	Access	Description
/login	Public	Login
/manager/dashboard	Manager	Manager Dashboard
/manager/tasks	Manager	View all tasks
/staff/tasks	Staff	View assigned tasks
/logout	Auth	Logout
Task Workflow

Manager creates a task

Task assigned to staff

Staff logs in

Staff sees task

Staff marks task as completed

Manager sees updated status

Database Schema
tasks table
Column	Type
id	bigint
name	string
status	enum(pending, completed)
staff_id	foreign key (users.id)
timestamps	
Relationships
// Task Model
public function staff()
{
    return $this->belongsTo(User::class, 'staff_id');
}

// User Model
public function tasks()
{
    return $this->hasMany(Task::class, 'staff_id');
}

Security

CSRF protected forms

Auth middleware

Role-based middleware

POST-only logout

Route protection

Future Enhancements

Task priority

Due dates

Notifications

Admin analytics

PDF reports

Author

Developed by Mandeep
Laravel Backend Developer

If you want, next I can generate:

• ER Diagram
• Project Report PDF
• Deployment steps
• Screenshots layout for GitHub