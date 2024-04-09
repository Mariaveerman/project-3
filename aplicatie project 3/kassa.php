<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");
?>
<?php
function toonResultaten($conn, $zoekterm) {
    $output = '';

    if (!empty($zoekterm)) {
        $sql = "SELECT * FROM producten WHERE artikelnummer LIKE '%$zoekterm%'";
        $resultaat = $conn->query($sql);

        if ($resultaat->num_rows > 0) {
            while ($row = $resultaat->fetch_assoc()) {
                $output .= "<div class='tekst'>" . $row["omschrijving"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["prijs"] . "<br>" . "</div>";
            }
        } else {
            $output .= "Geen resultaten gevonden";
        }
    } else {
        $output = "<div class='tekst'>Voer een zoekterm in.</div>";
        
    }

    if(isset($_POST['knop_klik'])) {
        $sql = "SELECT * FROM producten WHERE artikelnummer LIKE '%$zoekterm%'";
        $resultaat = $conn->query($sql);

        if ($resultaat->num_rows > 0) {
            while ($row = $resultaat->fetch_assoc()) {
                $output .= "<div class='teksten'>" . $row["omschrijving"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["prijs"] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["aantal"] . "<br>" . "</div>";
            }
        } 
    }

    return $output;
}

if (isset($_GET['zoekterm'])) {
    $zoekterm = $_GET['zoekterm'];

    $zoekterm = mysqli_real_escape_string($conn, $zoekterm);

    $resultaten_output = toonResultaten($conn, $zoekterm);
} else {
    $resultaten_output = "<div class='tekst'>Voer een zoekterm in.</div>";
}

$conn->close();
?>

<form id="myForm" method="GET" action="kassa.php">
    <input type="text" id="zoekterm" name="zoekterm" placeholder="Voer zoekterm in">
    <button type="submit" class="zoek">toevoegen</button>
</form>
<div id="keyboard">
    <button class="key" id="een" data-key="1">1</button>
    <button class="key" id="twee" data-key="2">2</button>
    <button class="key" id="drie" data-key="3">3</button>
    <button class="key" id="vier" data-key="4">4</button>
    <button class="key" id="vijf" data-key="5">5</button>
    <button class="key" id="zes" data-key="6">6</button>
    <button class="key" id="zeven" data-key="7">7</button>
    <button class="key" id="acht" data-key="8">8</button>
    <button class="key" id="negen" data-key="9">9</button>
    <button class="key" id="nul" data-key="0">0</button>
</div>
<div class="uitloggen"><a href="uitloggen.php">uitloggen</a></div>
<div id="resultaten">
    <?php echo $resultaten_output; ?>
</div>

<script>
    const keyboard = document.getElementById('keyboard');
    const zoekterm = document.getElementById('zoekterm');

    keyboard.addEventListener('click', function(event) {
        if (event.target.classList.contains('key')) {
            zoekterm.value += event.target.getAttribute('data-key');
        }
    });
</script>
<form  method="POST">
    <input class="knop_klik" type="submit" name="knop_klik" value="toevoegen">
</form>
<form  method="POST">
    <input class="afrekken" type="submit" name="afrekken" value="afrekken">
</form>
<?php
if(isset($_POST['afrekken'])){
    header("Location: bonnetje.php");
    exit();
}
?>
<?php
include("./footer.php");
?>
