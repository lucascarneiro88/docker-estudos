<?php

$mysql_host = 'website_mysql';
$mysql_dbname = 'app_database';
$mysql_user = 'user_app_database';
$mysql_password = 'teste1234';

$clients = null;

try {
    $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_dbname", $mysql_user, $mysql_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM Clients');
    $stmt->execute();
    $clients = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="p-5">
    
    <h1>Clientes</h1>
    <hr>
    <?php if($clients) : ?>
        <table class="table table-striped" width="100%" >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clients as $client) : ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['first_name']; ?></td>
                        <td><?php echo $client['last_name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="bg-secondary text-white p-2">Número total de clientes: <strong><?= count($clients) ?></strong></p>

    <?php else: ?>
        <p>Não existem clientes para apresentar</p>
    <?php endif; ?>
</body>
</html>