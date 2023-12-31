<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết phim</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
.movie-detail-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin: 20px;
}

.movie-detail {
    display: flex;
}

.movie-image-container {
    flex-basis: 40%;
    margin-right: 20px;
}

.movie-info-container {
    flex-basis: 60%;
}

    </style>
</head>
<body>

<div class="header-container">
        <div class="logo">
            Logo của trang
        </div>

        <div class="user-actions">
            <a href="#">Đăng nhập</a> | <a href="#">Đăng ký</a>
        </div>

        <div class="search-container">
            <form class="search-form" action="#" method="GET">
                <input class="search-input" type="text" name="search" placeholder="Tìm kiếm phim...">
                <button class="search-button" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <div class="navigation-container">
        <div class="navigation-item"><a href="movies_list.php">Trang chủ</a></div>
        <div class="navigation-item"><a href="single.php">Phim lẻ</a></div>
        <div class="navigation-item"><a href="series.php">Phim bộ</a></div>
        <div class="navigation-item"><a href="#">Quốc gia</a></div>
        <div class="navigation-item"><a href="#">Thể loại</a></div>
        <div class="navigation-item"><a href="#">Bảng xếp hạng</a></div>
    </div>

    <div class="movie-detail-container">
        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "movie_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Không thể kết nối đến cơ sở dữ liệu: " . $conn->connect_error);
        }

        // Nhận tham số ID từ URL
        $movieId = $_GET['id'];

        // Thực thi truy vấn để lấy thông tin chi tiết của bộ phim dựa trên ID
        $sql = "SELECT * FROM movies WHERE id = '$movieId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị thông tin chi tiết của bộ phim
            while ($row = $result->fetch_assoc()) {
                echo "<div class='movie-detail'>";
                echo "<div class='movie-image-container'>";
                echo "<img class='movie-image' src='" . $row['image'] . "'>";
                echo "</div>";
    
                echo "<div class='movie-info-container'>";
                echo "<h2 class='movie-title'>" . $row['title'] . "</h2>";
                echo "<p>Năm sản xuất: " . $row['release_year'] . "</p>";
                echo "<p>Quốc gia: " . $row['country'] . "</p>";
                echo "<p>Thể loại: " . $row['genre'] . "</p>";
                echo "<p>Trạng thái: " . $row['status'] . "</p>";
                echo "<p>Số tập: " . $row['episodes'] . "</p>";
                echo "<p>Diễn viên: " . $row['actors'] . "</p>";
                echo "<p>Đạo diễn: " . $row['director'] . "</p>";
                echo "<p>Nội dung: " . $row['summary'] . "</p>";
                // và các thông tin khác
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Không tìm thấy thông tin phim.";
        }


        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>
</html>
