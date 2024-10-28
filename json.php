<?php
header('Content-Type: application/json');

function parseResponses($directory) {
    $responses = [];
    $files = glob($directory . "/*.txt"); 

    if (empty($files)) {
        return "Файли не знайдені у директорії.";
    }

    foreach ($files as $file) {
        $content = file_get_contents($file);
        if ($content === false) {
            error_log("Не вдалося прочитати файл: $file");
            continue;
        }

        $lines = explode("\n", trim($content));
        if (count($lines) >= 3) {
            $response = [
                'name' => trim($lines[0]),
                'email' => trim($lines[1]),
                'answers' => array_slice($lines, 2)
            ];
            $responses[] = $response;
        } else {
            error_log("Файл $file не містить достатньо даних.");
        }
    }

    return $responses;
}

$directory = 'C:\\xampp\\htdocs\\survey'; 
$responses = parseResponses($directory);

if (is_string($responses)) {
    echo json_encode(['error' => $responses]);
} else {
    echo json_encode($responses, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
}
?>


