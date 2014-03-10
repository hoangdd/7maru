<?php
if(isset($statuts)){
    if($statuts == true) echo "Active";
    elseif($statuts == false) echo "Block";
    else echo "Unknow" ;
}
else {
    echo "Unknow" ;
}
?>
