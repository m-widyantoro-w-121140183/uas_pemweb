<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>UAS</title>
</head>

<body>
    <div class="container">
        <section>
            <h1>Update Data</h1>
            <?php
            include 'database.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
                $email = $_GET['email'];
                $db = new Data("localhost", "root", "", "uaspemweb");
                $result = $db->getEmail($email);

                if ($result !== false && count($result) > 0) {
                    $data = $result[0];
                    ?>
                    <form method="post">
                        <div class="ex">
                            <label for="name">Nama:</label>
                            <input type="text" value="<?= $data["name"] ?>" name="name" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="email">Email:</label>
                            <input type="text" value="<?= $data["email"] ?>" name="email" required readonly>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="status">Status Mahasiswa (Aktif/Tidak Aktif)</label>
                            <input type="text" value="<?= $data["status"] ?>" name="status" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label>Jenis Kelamin:</label>
                            <input type="radio" id="male" name="gender" value="Laki-laki" <?= ($data["gender"] == "Laki-laki") ? "checked" : "" ?>>
                            <label for="Laki-laki">Laki-laki</label>
                            <input type="radio" id="female" name="gender" value="Perempuan" <?= ($data["gender"] == "Perempuan") ? "checked" : "" ?>>
                            <label for="Perempuan">Perempuan</label>
                        </div>

                        <br>
                        <div class="btn">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
            <?php
                }
            }

            elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $status = isset($_POST['status']) ? $_POST['status'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

                $db = new Data("localhost", "root", "", "uaspemweb");

                $saveResult = $db->updateByEmail($email, $name, $status, $gender);

                if ($saveResult) {
                    echo '<script>alert("Data berhasil diupdate."); window.location.href = "index.php";</script>';
                    exit();
                } else {
                    echo "Gagal mengupdate data.";
                }
                $db->closeConnection();
            }
            ?>
        </section>
    </div>
</body>

</html>
