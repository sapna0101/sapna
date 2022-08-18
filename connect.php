<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['full_name']) && isset($_POST['email']) &&
        isset($_POST['subjects'])  && isset($_POST['messages'])) {
        
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $subjects = $_POST['subjects'];
        $messages = $_POST['messages'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "test";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(full_name, email, subjects, messages) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssss",$full_name, $email, $subjects, $messages);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>