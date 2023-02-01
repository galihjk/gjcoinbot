<?php
function handle_message_transfer($botdata){
    $text = $botdata["text"] ?? "";
    if($text == "/transfer" or $text == "/transfer@".f("get_config")("botuname","")){
        return f("proses_transfer_1")($botdata);
    }
    elseif(!empty($botdata['reply_to_message']['text'])
    and f("str_contains")($botdata['reply_to_message']['text'], "PROSES TRANSFER (1/4)")){
        return f("proses_transfer_2")($botdata);
    }
    elseif(!empty($botdata['reply_to_message']['text'])
    and f("str_contains")($botdata['reply_to_message']['text'], "PROSES TRANSFER (2/4)")){
        return f("proses_transfer_3")($botdata);
    }
    return false;
}