<?php
echo '<br/>';
mysqli_close($conn);
if($conn !== true){echo '<!--Database Successfully Disconnected.-->';}
?>