<?php
// بيانات الاتصال بقاعدة البيانات
$servername = "sql112.infinityfree.com"; 
$username = "if0_38156323";
$password = "rnfKDzjkQn";
$dbname = "if0_38156323_shop";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات والتحقق منها
$name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
$email = htmlspecialchars(strip_tags($_POST['email'] ?? ''));
$message = htmlspecialchars(strip_tags($_POST['message'] ?? ''));

// التحقق من صحة البيانات
if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
    // تحضير الاستعلام
    $stmt = $conn->prepare("INSERT INTO users (name, email, message) VALUES (?, ?, ?)");
    
    // ربط المتغيرات بالقيم المُدخلة
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "تمت إضافة البيانات بنجاح!";
    } else {
        echo "خطأ: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "الرجاء ملء جميع الحقول بشكل صحيح!";
}

// إغلاق الاتصال
$conn->close();
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
