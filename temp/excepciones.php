<?php
try {
    throw new Exception('Error horroroso');
    echo "Se ha saltado la excepción.";
} catch (Exception $e) {
    echo "Se ha provocado el siguiente error: " . $e->getMessage();
}
