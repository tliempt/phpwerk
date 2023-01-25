<!DOCTYPE html>
<html lang="en">
<body>
<style>
    body {
        font-family: "Arial Black";
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #af0000;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #540000;
    }

    div.container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
<form
        method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Name: <label><label>
        <input type="text" name="firstName" required>
        Last Name: <label></label>
        <input type="text" name="lastName" required>
        Email: <label></label>
        <input type="text" name="email" required>
            <label for="region">Region</label>
            <select id="region" name="region" required>
                <option value="Friesland">Friesland</option>
                <option value="Gelderland">Gelderland</option>
                <option value="NoordHolland">Noord-Holland</option>
                <option value="Zeeland">Zeeland</option>
                <option value="Brabant">Brabant</option>
                <option value="ZuidHolland">Zuid-Holland</option>
                <option value="Noord-Brabant">Noord-Brabant</option>
                <option value="Drenthe">Drenthe</option>
                <option value="Overijssel">Overijssel</option>
                <option value="Flevoland">Flevoland</option>
                <option value="Groningen">Groingen</option>
                <option value="Utrecht">Utrecht</option>
            </select>
        Industry: <label></label>
        <input type="text" name="industry" required>
        Job Position: <label></label>
            <input type="text" name="jobPosition" required>
            Desired Salary: <label></label>
            <input type="text" name="desiredSalary" required>
    <input type="submit">
</form>

<?php
include_once 'database.php';
global $conn;

        $stm = $conn->prepare("INSERT INTO registrations (firstName, lastName, email, region, industry, jobPosition, desiredSalary) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stm->bind_param("ssssssi", $firstname, $lastName, $email, $region, $industry, $jobPosition, $desiredSalary);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formValid = true;
            $firstname = test_input($_POST["firstName"]);
            $lastName  = test_input($_POST["lastName"]);
            $email = test_input($_POST["email"]);
            $region = test_input($_POST["region"]);
            $industry = test_input($_POST["industry"]);
            $jobPosition = test_input($_POST["jobPosition"]);
            $desiredSalary = test_input($_POST["desiredSalary"]);
        $stm->execute();
        $stm->close();

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);

        }

?>


</body>
</html