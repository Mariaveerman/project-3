<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");
?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="csvbestand" id="fbestand" size="25" placeholder="selecteer bestand..." accept=".csv"><br><br>
        <label for="chkKoptekst">Koptekst in bestand:</label>
        <input type="checkbox" id="chkKoptekst" value="1" name="chkKoptekst"><br><br>
        <input class="importbtn" type="submit" name="submit" value="Start Import"><br>
    </form>
    <?php
    $b = '<br>';
    $iRecord = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filename = $_FILES["csvbestand"]["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        echo '<h2>Lezen bestand</h2>';
        if ($extension == 'csv' and $_FILES['csvbestand']['size'] > 0) {
            $importFile = fopen($filename, "r");

            $koptekst = isset($_POST['chkKoptekst']) ? $_POST['chkKoptekst'] : 0;
            $table = "<table border=\"1\">
                           ";
            while (!feof($importFile)) {
                $iRecord++;
                $record = fgetcsv($importFile, 255, ";");

                if ($iRecord == 1 && $koptekst == 1) {
                    continue;
                } elseif (is_array($record)) {

                    $artikelnummer = substr($record[0], 0, 2);
                    $omschrijving = substr($record[0], 2, 1);
                    $table .= "<tr>
                                <td>" . $record[0] . "</td>
                                <td>" . $record[1] . "</td>
                                <td>" . $record[2] . "</td>
                                <td>" . $record[3] . "</td>
                                <td>" . $record[4] . "</td>
                                <td>" . $record[5] . "</td>
                                <td>" . $record[6] . "</td>
                          
                            
                            </tr>";
                }
            }
            $table .= "</table><br>";
            fclose($importFile);
            echo $table;
        } else {
            echo "<p>Helaas, dit is geen csv-bestand óf het bestand is helemaal leeg...</p>";
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filename = $_FILES["csvbestand"]["tmp_name"];
        $extension = pathinfo($_FILES["csvbestand"]["name"], PATHINFO_EXTENSION);
    
        if ($extension == 'csv' && $_FILES['csvbestand']['size'] > 0) {
            $importFile = fopen($filename, "r");
            $koptekst = isset($_POST['chkKoptekst']) ? $_POST['chkKoptekst'] : 0;
    
            while (($record = fgetcsv($importFile, 1000, ";")) !== false) {
                if ($koptekst == 1) {
                    $koptekst = 0;
                    continue;
                }
    
                // Voeg de gegevens toe aan de database
                $artikelnummer = floatval($record[0]);
                $omschrijving = mysqli_real_escape_string($conn, $record[1]);
                $leverancier = mysqli_real_escape_string($conn, $record[2]);
                $artikelgroep = mysqli_real_escape_string($conn, $record[3]);
                $eenheid = mysqli_real_escape_string($conn, $record[4]);
                $prijs = mysqli_real_escape_string($conn, $record[5]);
                $aantal = floatval($record[6]);
    
                $query = "INSERT INTO producten (artikelnummer, omschrijving, leverancier, artikelgroep, eenheid, prijs, aantal) 
                          VALUES ('$artikelnummer', '$omschrijving', '$leverancier', '$artikelgroep', '$eenheid', '$prijs', '$aantal')";
                mysqli_query($conn, $query);
            }
            fclose($importFile);
            echo "<p>Bestand succesvol geïmporteerd naar de database.</p>";
        } else {
            echo "<p>Helaas, dit is geen geldig CSV-bestand of het bestand is leeg.</p>";
        }
    }
    
    ?>
   

</body>

</html>