<?php
echo '<br/>';
mysqli_close($conn);
if($conn !== true){echo '<center><em>Database Successfully Disconnected.</em></center>';}
?>