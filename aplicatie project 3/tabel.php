<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");

$query = "SELECT artikelnummer, omschrijving, leverancier, artikelgroep, eenheid, prijs, aantal
        FROM producten";
$result = mysqli_query($conn, $query);
$aantal = mysqli_num_rows($result);
$contentTable = "";

$contentTable .= '<table border="1">
                        <tr>
                            <th>Artikelnummer</th>
                            <th>Omschrijving</th>
                            <th>Leverancier</th>
                            <th>Artikelgroep</th>
                            <th>Eenheid</th>
                            <th>Prijs</th>
                            <th>aantal</th>
                        </tr>';

if ($aantal > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $contentTable .= "<tr>
                            <td>" . $row['artikelnummer'] . "</td>                       
                            <td>" . $row['omschrijving'] . "</td>                       
                            <td>" . $row['leverancier'] . "</td>                       
                            <td>" . $row['artikelgroep'] . "</td>                       
                            <td>" . $row['eenheid'] . "</td>                       
                            <td>" . $row['prijs'] . "</td>
                            <td>" . $row['aantal'] . "</td>    
                        <td>
                        <form method='post' action='update_aantal.php'>
                            <input type='hidden' name='artikelnummer' value='" . $row['artikelnummer'] . "'>
                            <input type='number' name='nieuw_aantal' value='" . $row['aantal'] . "'>
                            <input type='submit' name='update_aantal' value='Opslaan'>
                        </form>
                        </td>
                        </tr>";
    }
} else {
    $contentTable .= '<tr>
                        <td colspan="6">Geen gegevens om op te halen...</td>
                    </tr>';
}

$contentTable .= '</table><br>';
echo $contentTable;

include("./footer.php");
