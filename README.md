# Fitness Web App

Простой проект для практики управления тренировками.

## Структура проекта

- `public/` — публичные PHP файлы
- `public/css/style.css` — стили
- `config/db.php` — подключение к MySQL
- `includes/auth.php` — функции проверки сессий
- `sql/init.sql` — база данных

## Установка

1. Клонируйте репозиторий:

```bash
git clone https://github.com/yourusername/myapp.git

Скопируйте проект в htdocs (XAMPP):
C:\xampp\htdocs\myapp
Запустите XAMPP (Apache + MySQL)
Импортируйте базу данных:
Откройте phpMyAdmin
Импортируйте файл sql/init.sql
Проверьте config/db.php:
$conn = new mysqli("localhost", "root", "", "fitness");
Откройте в браузере:
http://localhost/myapp/public/register.php
Тестовые логины
admin → admin123
ivan (тренер) → trainer123
maria (тренер) → trainer123
user1 → user123
user2 → user123