<?php
function handle_callback_query_transfer($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "tf_")
    and !empty($botdata["message"])){
        f("proses_transfer_4")($botdata);
        return true;
    }
    elseif(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "admacctf_")
    and !empty($botdata["message"])){
        f("proses_transfer_5")($botdata);
        return true;
    }
    return false;
}