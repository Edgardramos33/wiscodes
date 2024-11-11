    <?php 
        include "db.php";

        if (isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "SELECT * FROM contacts WHERE id=$id";
            $result=$conn->query($sql);

            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $name =$row ['name'];
                $phone =$row ['phone'];
            }
            else {
                echo "No contact found with that id.";
            }
        }
    if ($_SERVER['REQUEST_METHOD']== "POST"){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];

        if (!empty($name) && !empty($phone)) {
            $sql=  "UPDATE contacts SET name = '$name' , phone='$phone' WHERE id=$id";

            if ($conn-> query($sql) === TRUE) {
                echo "Contact successfuly edited.";
            } else {
                echo "Error editing record." . $sql . "<br>" . $conn->error;
            }


        }else {
            echo "Please fill in all fields.";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update</title>
    </head>
    <body>
        <h2>Edit contacts</h2>

        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            Name: <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
            Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>
            <input type="submit" value="Update contact">
        </form>

        <a href="index.php">Back to phonebook</a>
    </body>
    </html>