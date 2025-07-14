# 🧪 Laravel API 

Welcome to the **Laravel API **!  
This project is a clean, scalable REST API built with **Laravel 12**, adhering to best practices such as:

- ✅ DRY (Don't Repeat Yourself)
- ✅ RESTful routing
- ✅ Clean code architecture
- ✅ Versioned API (`v1`)
- ✅ Structured modular controllers (e.g., `Api\V1\Employee\EmployeesController`)
- ✅ Note Division and Employees api is used auth sanctum so u need barrier token to acces then if not 403 ensure also Accept (Application/json)
---

## 📦 Features & Endpoints

### 🔐 Authentication

| Method | Endpoint               | Description               |
|--------|------------------------|---------------------------|
| POST   | `/api/v1/auth/login`   | Login user (with token)   |
| POST   | `/api/v1/auth/logout`  | Logout and invalidate JWT |

---

### 🏢 Divisions

| Method | Endpoint               | Description           |
|--------|------------------------|-----------------------|
| GET    | `/api/v1/divisions`    | List all divisions    |

---

### 👥 Employees

| Method | Endpoint                            | Description           |
|--------|-------------------------------------|-----------------------|
| GET    | `/api/v1/employees`                 | List employees        |
| POST   | `/api/v1/employees`                 | Create employee       |
| PUT    | `/api/v1/employees/{employee}`      | Update employee       |
| DELETE | `/api/v1/employees/{employee}`      | Delete employee       |

---

### 📊 Scores / Nilai

| Method | Endpoint               | Description                |
|--------|------------------------|----------------------------|
| GET    | `/api/v1/nilaiRT`      | Retrieve RT scores         |
| GET    | `/api/v1/nilaiST`      | Retrieve ST scores         |

---

## 🧰 Stack

- PHP 8.3
- Laravel 12+
- MySQL
- Nginx for deployment
- Composer

---

## 🚀 Getting Started

```bash
clone this repo then

composer install
cp .env.example .env
php artisan key:generate

# Set up DB credentials in .env

php artisan migrate
php artisan serve
