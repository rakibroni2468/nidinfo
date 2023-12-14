<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nid_number = $_POST['nidNumber'];
    $dob = $_POST['dob'];

    $url = 'https://dkdmama.cu.ma/nid-check/process.php'; // Change this URL to your actual processing URL
    $data = array(
        'nid' => $nid_number,
        'dob' => $dob
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Process the result as needed

    // Display the result on a new page
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Result</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Check Result:</h1>';

    if (!empty($result)) {
        echo '<p>' . $result . '</p>
              <button onclick="printResult()">Print</button>';
    } else {
        echo '<p>Invalid response. The result is not from the expected source.</p>';
    }

    echo '<script>
            function printResult() {
                window.print();
            }
          </script>
        </body>
    </html>';
} else {
    // Handle non-POST requests
    echo 'Invalid request method.';
}
?>
