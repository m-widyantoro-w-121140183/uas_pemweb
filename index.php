<?php 
    session_start(); 
?>

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
            <h1>Input Data</h1>
                <form method="post">
                    <div class="ex">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <br>

                    <div class="ex">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>
                    </div>

                    <br>

                    <div class="ex">
                        <label for="status">Status Mahasiswa (Aktif/Tidak Aktif)</label>
                        <input type="text" id="status" name="status" required>
                    </div>

                    <br>

                    <div class="ex">
                        <label>Jenis Kelamin:</label>
                        <input type="radio" id="Laki-laki" name="gender" value="Laki-laki">
                        <label for="Laki-laki">Laki-laki</label>
                        <input type="radio" id="Perempuan" name="gender" value="Perempuan">
                        <label for="Perempuan">Perempuan</label>
                    </div>

                    <br>
                    <div class="btn">
                        <input class="button" type="submit" value="Submit">
                    </div>
                </form>
           
        </section>
    </div>

    <!-- <section class="table" id="view">
        <table id="dataTable">
        </table>
    </section> -->
    
        <section class="db">
            <h1>Table Database</h1>
            <table id="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status Keaktifan</th>
                        <th>Gender</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include "database.php";
                    
                    $db = new Data("localhost", "root", "", "uaspemweb");
                    
                    $list = $db->show();
                    
                    foreach ($list as $row):
                        ?>
                        <tr>
                            <td><?= $row['name']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['status']?></td>
                            <td><?= $row['gender']?></td>
                            <td>
                                <a href="edit.php?email=<?= $row['email'] ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    <section class="output">
        <h2>Data Pengguna dari Session</h2>
        <?php

        if (isset($_SESSION['user'])) {
            echo "Nama: " . $_SESSION['user']['name'] . "<br>";
            echo "Email: " . $_SESSION['user']['email'] . "<br>";
            echo "Status: " . $_SESSION['user']['status'] . "<br>";
            echo "Gender: " . $_SESSION['user']['gender'] . "<br>";
        } else {
            echo "Data pengguna tidak ditemukan dalam session.";
        }
        ?>
    </section>
    
    <script src="script.js"></script>
    <script src="cookie.js"></script>
</body>
</html>
