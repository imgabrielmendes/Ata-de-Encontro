<?php
include "conexao2.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="row">
      <div class="col">
        <a class="btn btn-primary text-light" href="admin.php">Add</a>
      </div>
    </div>

<div class="container">

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Password</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM crud";
                $result = mysqli_query($conn, $sql);
                print_r($result);

                if ($result && mysqli_num_rows($result) > 0) {               
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $password = $row['password'];

                        echo "<tr>";
                        echo "<th scope='row'>" . $id . "</th>";
                        echo "<td>" . $name . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $mobile . "</td>";
                        echo "<td>" . $password . "</td>";
                        echo "<td>
                                <button class='btn btn-primary'>
                                    <a class='text-light' href='admin.php? updateid=".$id."'>Update</a>
                                </button>
                                <button class='btn btn-danger'>
                                    <a class='text-light' href='delete.php?delteteid=".$id."'>Delete</a>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
