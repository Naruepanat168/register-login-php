<?php
session_start();
require 'config.php';

// กำหนดค่าความยาวขั้นต่ำของรหัสผ่าน
$minLength = 6;

// ตรวจสอบว่ามีการกดปุ่ม "Register" หรือไม่
if (isset($_POST['register'])) {

    // ดึงข้อมูลจาก input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // ตรวจสอบความถูกต้องของข้อมูล
    if (empty($username)) {
        $_SESSION['error'] = "Please enter your username";
        header("location: register.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address";
        header("location: register.php");
    } else if (strlen($password) < $minLength) {
        $_SESSION['error'] = "Please enter a valid password (minimum of $minLength characters)";
        header("location: register.php");
    } else if ($password != $confirmPassword) {
        $_SESSION['error'] = "Your password do not match";
        header("location: register.php");
    } else {

        // ตรวจสอบว่ามี Username นี้ในระบบหรือไม่
        $checkUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $checkUsername->execute([$username]);
        $userNameExists = $checkUsername->fetchColumn();

        // ตรวจสอบว่ามี Email นี้ในระบบหรือไม่
        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkEmail->execute([$email]);
        $userEmailExists = $checkEmail->fetchColumn();

        if ($userNameExists) {
            $_SESSION['error'] = "username  already exists.";
            header("location: register.php");
        } else if ($userEmailExists) {
            $_SESSION['error'] = "email  already exists.";
            header("location: register.php");
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
                $stmt->execute([$username, $email, $hashedPassword]);
                $_SESSION['success'] = "Registration Successfully";
                header("location: register.php");

            } catch (PDOException $e) {
                $_SESSION['error'] = "Some";
                header("location: register.php");

            }
        }
    }
}
