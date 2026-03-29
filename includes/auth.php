<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isTrainer() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'trainer';
}

function isUser() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}

function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
}