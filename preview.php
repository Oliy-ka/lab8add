<?php
$jsonData = file_get_contents('http://localhost/lab8add/json.php'); 
$responses = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Помилка декодування JSON: " . json_last_error_msg();
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Відповіді анкети</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Відповіді анкети</h1>
    <table>
        <tr>
            <th>Ім'я</th>
            <th>Email</th>
            <th>Відповіді</th>
        </tr>
        <?php foreach ($responses as $response): ?>
            <tr>
                <td><?php echo htmlspecialchars($response['name']); ?></td>
                <td><?php echo htmlspecialchars($response['email']); ?></td>
                <td>
                    <ul>
                        <?php foreach ($response['answers'] as $answer): ?>
                            <li><?php echo htmlspecialchars($answer); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

