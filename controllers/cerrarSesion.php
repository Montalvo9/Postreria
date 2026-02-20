<?php
session_start();
unset($_SESSION['usuario']); 
session_destroy(); 

header(("Location: ../index.php"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <!-- Borrar el localStorage --> 
     <script>
        localStorage.clear();
     </script>
</body>
</html>

