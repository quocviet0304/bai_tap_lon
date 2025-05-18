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
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy thông tin sinh viên
$stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
$id = $_SESSION['id'];
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

ini_set('display_errors', '0');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div class="wraper">
        <div class="header">
            <div class="header__title">
                <div class="header__title__description" style="color: #fff;">
                    TRƯỜNG ĐẠI HỌC HÀNG HẢI VIỆT NAM
                </div>
                <div class="header__title__user">
                    <h3>Sinh viên: <?php echo htmlspecialchars($row['Name']); ?></h3>
                </div>
            </div>
            <div class="header__system">
                <a href="index.php" class="header__system__link">Trang chủ</a>
                <a href="logout.php" class="header__system__link">Đăng xuất</a>
                <a href="#" class="header__system__link">Hỏi đáp</a>
                <a href="#" class="header__system__link">Trợ giúp</a>
                <select class="header__system__link-op" name="language">
                    <option value="vn">VN</option>
                    <option value="en">EN</option>
                </select>
            </div>
        </div>

        <div class="container">
            <div class="container__information">
                <div class="container__information--col">
                    <div class="container__information--row">
                        <div class="container__information--title">Mã Sinh Viên:</div>
                        <div class="container__information--id"><?php echo htmlspecialchars($row['Student_id']); ?></div>
                    </div>
                    <div class="container__information--row">
                        <div class="container__information--title">Khoa:</div>
                        <div class="container__information--department"><?php echo htmlspecialchars($row['Department']); ?></div>
                    </div>
                    <div class="container__information--row">
                        <div class="container__information--title">Học kỳ:</div>
                        <select class="container__information--semester">
                            <option value="">2021_2022_1</option>
                            <option value="">2021_2022_2</option>
                            <option value="">2022_2023_1</option>
                            <option value="">2022_2023_2</option>
                        </select>
                    </div>
                </div>

                <div class="container__information--col">
                    <div class="container__information--row">
                        <div class="container__information--title">Họ tên:</div>
                        <div class="container__information--name"><?php echo htmlspecialchars($row['Name']); ?></div>
                    </div>
                    <div class="container__information--row">
                        <div class="container__information--title">Ngành:</div>
                        <div class="container__information--specialized"><?php echo htmlspecialchars($row['Specialized']); ?></div>
                    </div>
                    <div class="container__information--row">
                        <div class="container__information--title">Lọc:</div>
                        <select class="container__information--semester">
                            <option value="">Xem những học phần có điểm</option>
                            <option value="">Học phần chưa có điểm</option>
                        </select>
                    </div>
                </div>

                <div class="container__information--col">
                    <div class="container__information--row">
                        <div class="container__information--title">Trạng thái:</div>
                        <div class="container__information--status">Đang học</div>
                    </div>
                    <div class="container__information--row">
                        <div class="container__information--title">Lớp:</div>
                        <div class="container__information--class"><?php echo htmlspecialchars($row['Class']); ?></div>
                    </div>
                </div>
            </div>

            <div class="container__scores">
                <table width="100%" align="center" border="1" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Năm học</th><th>Học kỳ</th><th>TBTL Hệ 10 N1</th><th>TBTL Hệ 10 N2</th>
                            <th>TBTL Hệ 4 N1</th><th>TBTL Hệ 4 N2</th><th>Số TCTL N1</th><th>Số TCTL N2</th>
                            <th>TBC Hệ 10 N1</th><th>TBC Hệ 10 N2</th><th>TBC Hệ 4 N1</th><th>TBC Hệ 4 N2</th>
                            <th>Số TC N1</th><th>Số TC N2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2021_2022</td><td>1</td><td>8.53</td><td></td><td>3.66</td><td></td>
                            <td>16</td><td></td><td>8.53</td><td></td><td>3.66</td><td></td><td>16</td><td></td>
                        </tr>
                        <tr>
                            <td>2021_2022</td><td>2</td><td>8.53</td><td></td><td>3.66</td><td></td>
                            <td>16</td><td></td><td>8.53</td><td></td><td>3.66</td><td></td><td>16</td><td></td>
                        </tr>
                        <tr>
                            <td>2021_2022</td><td>Cả năm</td><td>8.53</td><td></td><td>3.66</td><td></td>
                            <td>32</td><td></td><td>8.53</td><td></td><td>3.66</td><td></td><td>32</td><td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
