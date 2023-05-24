<?php

function convertSize($bytes, $precision = 2) {
  // Keep original value if loop never return a value
  $originalValue = $bytes;
  // Value as variable to modify it easier on future at a single point
  $units = array(' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB', ' HB');
  $bytesDivision = 1024;

  // Loop on every unit
  foreach ($units as $unit) {
      // If next bytes < 1 on next loop then return as guard condition
      if (($bytes /= $bytesDivision) >= $bytesDivision) {
        continue;
      }
      return round($bytes, $precision) . $unit;
  }

  // Return value if condition is never reached
  return $originalValue . ' B';

  /**
   * Commentaire :
   * Je n'ai pas modifié pour garder la logique du code fourni à l'initial
   * mais cela aurait été plus cohérent, vu le nom de la fonction, de vérifier
   * dès le début si $bytes était inférieur à 1024 pour ne pas renvoyer une valeur à "0 KB"
   * et potentiellement de retourner automatiquement la valeur en "HB"
   * sur la dernière occurence du tableau
   */
}
