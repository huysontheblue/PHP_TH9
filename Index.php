<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinh Viên</title>
</head>
<body>
    <?php
        // kết nối đến csdl
        $conn = mysqli_connect("localhost","root","","quanlyhoc_db");
        // truy vấn dữ liệu
        if(isset($_GET["search"]) && !empty($_GET["search"]))
        {
            $key = $_GET["search"];
            $sql = "SELECT HoTen, LopBC, NgaySinh, DiaChi, TenKhoa FROM sinh_vien sv join khoa_dao_tao kdt on sv.MaKhoa=kdt.MaKhoa where HoTen like '%$key%'";
        }
        else {
            $sql = "SELECT HoTen, LopBC, NgaySinh, DiaChi, TenKhoa FROM sinh_vien sv join khoa_dao_tao kdt on sv.MaKhoa=kdt.MaKhoa";
        }
        $result = mysqli_query($conn,$sql);
    ?>
    <h1 style="text-align: center">Quản Lý Sinh Viên</h1>
    <div style="margin: 20px 560px; ">
        <form action="" method="GET">
            <label>Tìm kiếm: </label>
            <input type="text" name="search" placeholder ="Nhập nội dung tìm kiếm" value="<?php if(isset($_GET["search"])) { echo $_GET["search"]; } ?>">
            <input type="submit" value="Tìm kiếm">
            <input type="button" value="Tất cả" onclick ="window.location.href = '/PHP_TH10/Index.php'">
        </form>
    </div>
    <table border = "1" align="center" cellspacing = "0" cellspadding = "0" width = "600px">
        <tr>
            <th>Họ Tên</th>
            <th>Lớp BC</th>
            <th>Ngày Sinh</th>
            <th>Địa Chỉ</th>
            <th>Tên Khoa</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php
            //kết nối đến csdl
            //$conn = mysqli_connect("localhost","root","","quanlyhoc_db");
            // truy vấn dữ liệu
            //$sql = "SELECT HoTen, LopBC, NgaySinh, DiaChi, TenKhoa FROM sinh_vien sv join khoa_dao_tao kdt on sv.MaKhoa=kdt.MaKhoa";
            //$result = mysqli_query($conn, $sql);
            // in danh sách dữ liệu
            while($row = mysqli_fetch_assoc($result))
            {
                $ht = $row["HoTen"];
                $lbc = $row["LopBC"];
                $ns = $row["NgaySinh"];
                $dc = $row["DiaChi"];
                $tk = $row["TenKhoa"];
        ?>
        <tr>
            <td><?php echo $ht ?></td>
            <td><?php echo $lbc ?></td>
            <td><?php echo $ns ?></td>
            <td><?php echo $dc ?></td>
            <td><?php echo $tk ?></td>
            <td>
                <a href="suasv.php?HoTen=<?php echo $ht;?>"> Sửa</a>
            </td>
            <td>
                <a href="xoasv.php?HoTen=<?php echo $ht;?>"onclick="return confirm('Bạn có muốn xoá sinh viên không?')"> Xóa </a> 
            </td>
        </tr>
        <?php
            }
        ?>
        <?php
            mysqli_close($conn);
        ?>
        <tr>
            <td colspan = "7" align = "center">
                <Button type="button" onclick="myFunction()">Thêm mới</Button>
            </td>
        </tr>
    </table>
</body>
</html>
<script>
    function myFunction(){
        location.replace("themsv.php");
    }
</script>
