<html>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pruebaphp";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        if (!empty($_GET["nombre"])){

            $nombre = $_GET["nombre"];
            $asignatura = $_GET["asignatura"];
            $dni = $_GET["dni"];

            $sql = "INSERT INTO alumno (nombre, asignatura, dni)
            VALUES ('".$nombre."', '".$asignatura."', '".$dni."');";
            

            if ($conn->multi_query($sql) === TRUE) {
                echo "<script>alert('El alumno se ha dado de alta.');</script>";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $sql = "SELECT nombre, asignatura, dni FROM alumno";
        $result = $conn->query($sql);
        $TABLE = '<table border="1">';

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $TABLE.="<tr>";
            $TABLE.="<td>".$row["nombre"]."</td>";
            $TABLE.="<td>".$row["asignatura"]."</td>";
            $TABLE.="<td>".$row["dni"]."</td>";
            $TABLE.="</tr>";
        }
        $TABLE.="</table>";
        } else {
        echo "0 results";
        }
        $conn->close();
        echo $TABLE;
    ?>
    
    <hr/>
    <form>
        <label>Nombre:<input type="text" name="nombre" value="1" placeholder="Escribe nombre"></input></label>
        <br/>
        <label>Asignatura:
            <select name="asignatura">
                <option value="ED"></option>
                <option value="SI">Sistemas informáticos</option>
                <option value="PR">Programación</option>
                <option value="BD">Bases de datos</option>
            </select>
        </label>
        <br/>
        <label>DNI:<input type="text" name="dni" value="1" placeholder="Escribe dni"></input></label>
        <br/>
        <button type="submit">Agregar alumno</button>
    </form>
</body>
</html>
