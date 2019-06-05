<?php
        setcookie("nivel", "", time()-3600);
        unset($_COOKIE["nivel"]);
        session_destroy();
        echo '
        <script>
          window.location.href = "index.php?action=tutorias";
        </script>
      ';
?>