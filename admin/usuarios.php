<?php

include "../db/db_utils.php";

$usuarios = getTable("usuarios");


echo "<table><tr>";

foreach($usuarios["columns"] as $column) {
  echo "<th>$column</th>";
}

echo "</tr>";

foreach($usuarios["data"] as $row) {
  echo "<tr>";
  foreach($usuarios["columns"] as $column) {
    echo "<td>$row[$column]</td>";
  }
  echo "</tr>";
}

echo "</table>";

?>
