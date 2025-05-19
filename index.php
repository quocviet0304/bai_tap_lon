<?php 
  session_start();
  if(!isset($_SESSION['User_name']) and !isset($_SESSION['id'])) {
    header("Location: login.html");
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Trang chủ</title>
</head>


<?php
// Kết nối CSDL
$host = "baitapdb.mysql.database.azure.com";
$user = "baitaplon";
$password = "ttm62dh@";
$dbname = "utt"; // thay bằng tên CSDL của bạn

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách tất cả sinh viên
$sql_students = "SELECT * FROM student";
$result_students = $conn->query($sql_students);

// Mặc định chọn sinh viên đầu tiên
$default_student = null;
$student_data = [];

if ($result_students->num_rows > 0) {
    while ($student = $result_students->fetch_assoc()) {
        $student_data[$student['Student_id']] = $student;
        if (!$default_student) $default_student = $student;
    }
} else {
    echo "Không có dữ liệu sinh viên!";
    exit;
}
?>

<body>
    <div class="wraper">
        <div class="header">
            <div class="header__title">
                <div class="header__title__description" style="color: #fff;">
                    TRƯƠNG ĐẠI HỌC HÀNG HẢI VIỆT NAM
                </div>

                <div class="header__title__user">
                    <h3>Sinh Viên: <?= htmlspecialchars($default_student['Name']) ?></h3>
                </div>

            </div>
            <div class="header__system">
                <a href="" class="header__system__link">Trang chủ</a>
                <a href="logout.php" class="header__system__link">Đăng xuất</a>
                <a href="" class="header__system__link">hỏi đáp</a>
                <a href="" class="header__system__link">Trợ giúp</a>
                <select class="header__system__link-op" name="Product_Type" >
                    <option value="">VN</option>
                    <option value="">EN</option>
                  </select>
            </div>
        </div>

        <div class="container">

            <div class="container__information">
                <div class="container__information--col">
                    <div class="container__information--row"> 
                        <div class="container__information--title">Mã Sinh Viên:</div>
						  <select id="studentSelect" class="container__information--id">
							<?php foreach ($student_data as $sid => $sinfo): ?>
							  <option value="<?= htmlspecialchars($sid) ?>" <?= ($sid == $default_student['Student_id']) ? 'selected' : '' ?>>
								<?= htmlspecialchars($sid) ?>
							  </option>
							<?php endforeach; ?>
						  </select>
						  
                    </div>
                    <div class="container__information--row"> 
                        <div class="container__information--title">Khoa: </div>
                        <div class="container__information--department" id="studentDepartment"><?= htmlspecialchars($default_student['Department']) ?></div>
                    </div>
                    <div class="container__information--row"> 
                        <div class="container__information--title">Học kì:</div>
                       <select class="container__information--semester" name="Product_Type" >
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
                        <div class="container__information--name" id="studentName"><?= htmlspecialchars($default_student['Name']) ?></div>
                    </div>
                    <div class="container__information--row"> 
                        <div class="container__information--title">Ngành: </div>
                       <div class="container__information--specialized" id="studentSpecialized"><?= htmlspecialchars($default_student['Specialized']) ?></div>
                    </div>
                    <div class="container__information--row"> 
                        <div class="container__information--title">Lọc:</div>
                        <select class="container__information--semester" name="Product_Type" >
                            <option value="">Xem những học phần có diểm </option>
                            <option value="">EN</option>
                          </select>
                    </div>
                </div>

                <div class="container__information--col">
                    <div class="container__information--row"> 
                        <div class="container__information--title">Trạng thái:</div>
                        <div class="container__information--status">Đang học</div>
                    </div>
                    <div class="container__information--row"> 
                        <div class="container__information--title">Lớp: </div>
                        <div class="container__information--class" id="studentClass"><?= htmlspecialchars($default_student['Class']) ?></div>
                    </div>
                </div>

            </div>

            <div class="container__scores">
                <table width="100%" align="center" border="1" style="border-collapse: collapse;">
                    <tbody>
                      <tr>
                        <td class="container__scores__header">Năm học</td>
                        <td class="container__scores__header">Học kỳ</td>
                        <td class="container__scores__header">TBTL Hệ 10 N1</td>
                        <td class="container__scores__header">TBTL Hệ 10 N2</td>
                        <td class="container__scores__header">TBTL Hệ 4 N1</td>
                        <td class="container__scores__header">TBTL Hệ 4 N2</td>
                        <td class="container__scores__header">Số TCTL N1</td>
                        <td class="container__scores__header">Số TCTL N2</td>
                        <td class="container__scores__header">TBC Hệ 10 N1</td>
                        <td class="container__scores__header">TBC Hệ 10 N2</td>
                        <td class="container__scores__header">TBC Hệ4 N1</td>
                        <td class="container__scores__header">TBC Hệ4 N2</td>
                        <td class="container__scores__header">Số TC N1</td>
                        <td class="container__scores__header">Số TC N2</td>
                      </tr>
                      <tr>
                        <td class="container__scores__row">2021_2022</td>
                        <td class="container__scores__row">1</td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                      </tr>
                      <tr>
                        <td class="container__scores__row">2021_2022</td>
                        <td class="container__scores__row">2</td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                      </tr>
                      <tr>
                        <td class="container__scores__row">2021_2022</td>
                        <td class="container__scores__row">Cả năm</td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                      </tr>
                      <tr>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">Toàn Khóa</td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row_diem_kol_jo"><?php echo number_format(mt_rand(400, 1000) / 100, 2); ?></td>
                        <td class="container__scores__row"></td>
                        <td class="container__scores__row">16</td>
                        <td class="container__scores__row"></td>
                      </tr>
                      <tr>
                    </tbody>
                  </table>

                
                  
            </div>
        </div>

        <div class="footer">
            <div class="footer__description">
                Đường dây nóng: 
            </div>
        </div>


    </div>
	<script>
  const studentData = <?= json_encode($student_data) ?>;

  const select = document.getElementById('studentSelect');
  const nameField = document.getElementById('studentName');
  const deptField = document.getElementById('studentDepartment');
  const specField = document.getElementById('studentSpecialized');
  const classField = document.getElementById('studentClass');

  select.addEventListener('change', function () {
    const sid = this.value;
    const data = studentData[sid];

    if (data) {
        function getRandomScore(min = 4, max = 10) {
        return (Math.random() * (max - min) + min).toFixed(2);
    }

    // Chọn tất cả các ô có class container__scores__row
    document.querySelectorAll('.container__scores__row_diem_kol_jo').forEach(td => {
        td.textContent = getRandomScore();
    });
      nameField.textContent = data.Name;
      deptField.textContent = data.Department;
      specField.textContent = data.Specialized;
      classField.textContent = data.Class;
    }
    
  });
</script>
</body>

</html>
