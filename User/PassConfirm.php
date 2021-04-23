<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
?>
<div id="InsertToConfirm">
<span>Insert the password to access to private informations:</span>
<form action="PassConfirmPHP.php" method="post">
<input type="password" name="pass"></input>
<input type="submit" value="Confirm"></input>
</form>


</div>
</body>
</html>