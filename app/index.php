<?php

require "db.php";

// Add student
if (isset($_POST["add_student"])) {

    $registration_number = $_POST["registration_number"];
    $full_name = $_POST["full_name"];
    $course = $_POST["course"];
    $year_of_study = $_POST["year_of_study"];

    $sql = "INSERT INTO students
            (registration_number, full_name, course, year_of_study)
            VALUES (:registration_number, :full_name, :course, :year_of_study)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":registration_number" => $registration_number,
        ":full_name" => $full_name,
        ":course" => $course,
        ":year_of_study" => $year_of_study
    ]);
}

// Delete student
if (isset($_GET["delete"])) {

    $id = $_GET["delete"];

    $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute([":id" => $id]);
}

// Get students
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Student Management System</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #eef4fb;
            color: #1f2937;
        }

        h1 {
            text-align: center;
            color: #123b6d;
            margin-bottom: 35px;
        }

        h2 {
            color: #1e4e8c;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        input {
            padding: 10px;
            margin: 5px;
            width: 200px;
            border: 1px solid #b8c7d9;
            border-radius: 5px;
        }

        input:focus {
            border-color: #2563eb;
            outline: none;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th {
            background: #123b6d;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            border: 1px solid #d5dde8;
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background: #f3f7fc;
        }

        tr:hover {
            background: #e5effb;
        }

        a {
            color: #dc2626;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Student Management System</h1>

    <h2>Add Student</h2>

    <form method="POST">

        <input
            type="text"
            name="registration_number"
            placeholder="Registration Number"
            required
        >

        <input
            type="text"
            name="full_name"
            placeholder="Full Name"
            required
        >

        <input
            type="text"
            name="course"
            placeholder="Course"
            required
        >

        <input
            type="number"
            name="year_of_study"
            placeholder="Year of Study"
            required
        >

        <button type="submit" name="add_student">
            Add Student
        </button>

    </form>

    <h2>Students</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Registration Number</th>
            <th>Full Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Action</th>
        </tr>

        <?php foreach ($students as $student): ?>

        <tr>

            <td>
                <?= htmlspecialchars($student["id"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($student["registration_number"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($student["full_name"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($student["course"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($student["year_of_study"]) ?>
            </td>

            <td>
                <a href="?delete=<?= $student["id"] ?>">
                    Delete
                </a>
            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>

</html>