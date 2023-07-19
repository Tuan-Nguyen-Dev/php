<?php
include_once("../database/conection.php");
$categories = $dbConn->query("SELECT id, name FROM categories");
?>

<!-- Lưu dữ liệu vào database khi submit -->

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];


    $currentDirectory = getcwd();
    $uploadDirectory = "./uploads/";
    $fileName = $_FILES['image']['name'];
    $fileTmpName  = $_FILES['image']['tmp_name'];
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

    move_uploaded_file($fileTmpName, $uploadPath);


    // upload file
    $image = "http://127.0.0.1:3456/uploads/" . $fileName;
    $sql = "INSERT INTO products (name, price, quantity, image, categoryId, description)
    VALUES ('$name', '$price', '$quantity', '$image', '$categoryId', '$description')";
    $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Thêm sản phẩm</h2>
        <form action="./instert.php" method="post" id="form" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="mb-3 mt-3">
                <label for="price">Giá sản phẩm:</label>
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity">Số lượng sản phẩm :</label>
                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
            </div>
            <div class="mb-3 mt-3">
                <label for="image">Hình ảnh :</label>
                <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                <img id="image-display" src="https://th.bing.com/th?q=iPhone+14&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=en-WW&cc=VN&setlang=vi&adlt=moderate&t=1&mw=247" alt="" width="100">
            </div>
            <div class="mb-3 mt-3">
                <label for="categoryId">Nhà cung cấp: </label>
                <select class="form-control" id="categoryId" name="categoryId">
                    <?php
                    while ($row = $categories->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="description">Mô tả sản phẩm: </label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter description "></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        // validation ở client
        const form = document.getElementById('form');
        form.addEventListener('submit', (e) => {
            const name = document.getElementById('name').value;
            const productPrice = document.getElementById('price').value;
            const productQuantity = document.getElementById('quantity').value;
            if (!name || name.trim().lenth == 0) {
                swal('Vui lòng nhập tên sản phẩm');
                e.preventDefault(); // dừng submit form
                return false;
            }
            if (productPrice.trim() === "") {
                swal('Vui lòng nhập giá sản phẩm');
                e.preventDefault(); // dừng submit form
                return false;
            }
            if (productPrice < 0) {
                swal('Giá sản phẩm không được nhập số âm');
                e.preventDefault(); // dừng submit form
                return false;
            }
            if (productQuantity.trim() === "") {
                swal('Vui lòng nhập số lượng sản phẩm');
                e.preventDefault(); // dừng submit form
                return false;
            }

            //submit form
            return true;
        })

        // hiển thị hình ảnh khi người dùng chọn file
        const image = document.querySelector('#image');
        const imageDisplay = document.querySelector('#image-display');
        image.addEventListener('change', function(e) {
            const file = this.files[0];
            const url = URL.createObjectURL(file);
            imageDisplay.src = url;
        });
    </script>


</body>

</html>