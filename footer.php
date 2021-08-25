<?php
echo '<footer class="py-3 my-4">';
echo '<p class="text-center">&copy; 2021 Expendor</p>';
echo '</footer>';
echo '<br/>';
mysqli_close($conn);
if($conn !== true){echo '<!--Database Successfully Disconnected.-->';}
echo '</body>';
echo '</html>';
?>