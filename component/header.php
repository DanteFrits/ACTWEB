<?php
function setActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}
?>