<?php

//kiểm tra nếu không có tồn tại biến $_SESSION['email']
session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}



include_once("./database/conection.php");
$result = $dbConn->query("SELECT id, name, price, quantity, image FROM products");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="justify-content-center collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success me-2" type="submit">Search</button>
                    <a href="./login.php" class="btn btn-primary">Login</a>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2>Danh sách sản phẩm</h2>
        <p>
            <a href="instert.php" class="btn btn-success">Thêm mới</a>
            <a href="#" class="btn btn-secondary">Thêm mới danh mục</a>
            <a href="logout.php" class="btn btn-danger">Log out</a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td> <img src=' " . $row['image'] . " ' width='100'</td>";
                    echo "<td>
                        <a href='./edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Sửa</a>
                        <a onclick='confirmDelete(" . $row['id'] . ")' class='btn btn-danger'>Xóa</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    const confirmDelete = (id) => {
        swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Sau khi xóa, bạn sẽ không thể khôi phục lại dữ liệu!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    //http://127.0.0.1:3456/delete.php?id=1
                    window.location.href = "delete.php?id=" + id;
                } else {

                }
            });
    }
</script>

</html>