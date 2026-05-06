<?php
session_start(); // بدء الجلسة

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "username", "password", "database_name");

// تحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// التحقق من وجود معرّف الإشعار في الرابط
if (isset($_GET['id'])) {
    $notification_id = intval($_GET['id']);

    // جلب تفاصيل الإشعار من قاعدة البيانات
    $sql = "SELECT * FROM notifications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // بيانات الإشعار
        $notification = $result->fetch_assoc();
    } else {
        echo "الإشعار غير موجود.";
        exit;
    }
} else {
    echo "معرّف الإشعار غير محدد.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الإشعار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>تفاصيل الإشعار</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($notification['title']); ?></h5>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($notification['message'])); ?></p>
            <p class="text-muted">تاريخ الإشعار: <?php echo htmlspecialchars($notification['created_at']); ?></p>
            <a href="notifications.php" class="btn btn-secondary">عودة للإشعارات</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
