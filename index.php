<?php
session_start();
if (!isset($_SESSION['User_name']) || !isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Kết nối CSDL
$host = "baitapdb.mysql.database.azure.com";
$username = "baitaplon";
$password = "ttm62dh@";
$database = "utt";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy toàn bộ sinh viên
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);

// Lấy sinh viên cần hiển thị (theo GET hoặc mặc định sinh viên đầu tiên)
$selected_id = $_GET['id'] ?? $students[0]['id'] ?? null;

// Truy vấn chi tiết sinh viên theo ID
$student = null;
if ($selected_id) {
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->bind_param("s", $selected_id);
    $stmt->execute();
    $result_detail = $stmt->get_result();
    $student = $result_detail->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Sinh viên</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .container { max-width: 600px; margin: auto; }
        select { padding: 5px; margin-bottom: 10px; }
        .info { margin-top: 20px; background: #f0f0f0; padding: 10px; }
        .label { font-weight: bold; width: 120px; display: inline-block; }
    </style>
</head>
<body>
<div class="container">
    <h2>Trang thông tin sinh viên</h2>

    <form method="get" action="">
        <label for="id">Chọn mã sinh viên:</label>
        <select name="id" id="id" onchange="this.form.submit()">
            <?php foreach ($students as $s): ?>
                <option value="<?= htmlspecialchars($s['id']) ?>" <?= ($s['id'] == $selected_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['Student_id']) ?> - <?= htmlspecialchars($s['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($student): ?>
        <div class="info">
            <div><span class="label">Mã SV:</span> <?= htmlspecialchars($student['Student_id']) ?></div>
            <div><span class="label">Họ tên:</span> <?= htmlspecialchars($student['Name']) ?></div>
            <div><span class="label">Khoa:</span> <?= htmlspecialchars($student['Department']) ?></div>
            <div><span class="label">Ngành:</span> <?= htmlspecialchars($student['Specialized']) ?></div>
            <div><span class="label">Lớp:</span> <?= htmlspecialchars($student['Class']) ?></div>
        </div>
    <?php else: ?>
        <p>Không tìm thấy sinh viên.</p>
    <?php endif; ?>
</div>
</body>
</html>
