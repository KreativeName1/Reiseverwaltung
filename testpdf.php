<?php
require('fpdf/fpdf.php');
$pdf = new FPDF("  <table>
<tbody>
<tr><td>Land</td><td>Estland</td></tr>
<tr><td>Zielort</td><td>Narva Festungstour</td></tr>
<tr><td>Dauer</td><td>3 Tag(e)</td></tr>
<tr><td>Preis</td><td>110 €</td></tr>
<tr><td>Abfahrtsdatum</td><td>21.08.2023</td></tr>
<tr><td>Abfahrtszeit</td><td>11:00</td></tr>
<tr><td>Freie Plätze</td><td>4</td></tr>
</tbody></table>");
$pdf->Output();

?>