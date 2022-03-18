<?php
        session_start();
        unset($_SESSION['id_p']);
        unset($_SESSION['id_g']);
        unset($_SESSION['id_st']); // уничтожаем переменные в сессиях
        exit("<html><head><meta http-equiv='Refresh' content='0; URL=/'></head></html>");
?>