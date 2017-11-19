<?php
function tjekBillede($billede){
    if ($billede['size']>0) {
        return true;
    }else {
        return false;
    }
}

function visBillede($value, $dest){
    if (is_file($dest.$value)) {
        $img = '<img class="img-responsive" src="'.$dest.$value.'" alt="'.$value.'">';
    }else{
        $img = '<p style="color:red">INTET BILLEDE</p>';
    }
    return $img;
}
function haandterFil($fil, $dest, $gammelFil=null){
    if ($gammelFil !== null) {
        // Så slet den!
        if (is_file($dest.$gammelFil)) {
            unlink($dest.$gammelFil);
        }
    }
    if($fil['error'] === 0 && $fil['size'] > 0){
        $filnavn = $fil['name'];
        // Filen flyttes til server
        move_uploaded_file($fil['tmp_name'], $dest . $filnavn);
    }
    
    return $filnavn;
}