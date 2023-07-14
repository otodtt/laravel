<?php
// 16. Договор за предаване
if(!isset($protocols)){
    $contract1 = false;
    $contract2 = false;
    $contract3 = false;
    $contract_note= null;
}
else{
    if($protocols->contract == 0){
        $contract1 = false;
        $contract2 = false;
        $contract3 = false;
    }
    if($protocols->contract == 1){
        $contract1 = true;
        $contract2 = false;
        $contract3 = false;
    }
    if($protocols->contract == 2){
        $contract1 = false;
        $contract2 = true;
        $contract3 = false;
    }
    if($protocols->contract == 3){
        $contract1 = false;
        $contract2 = false;
        $contract3 = true;
    }
    $contract_note= $protocols->contract_note;
}