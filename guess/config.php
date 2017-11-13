<?php
session_start();

ini_set('date.timezone','America/New_York');
ini_set('file_uploads','0');
ini_set('memory_limit','8388608');
ini_set('upload_max_filesize','262144');

ini_set('include_path', ini_get('include_path').':/home/pimp3am/includes');
require_once('class.htdoc.php');

$DEBT = array(d => "116632", c => "84");

function score($debt, $guess){
    $d = substr($debt, -1);
	$g = substr($guess, -1);

	if($d === false or $g === false)
        return 0;
    else if($d !== $g)
        return score(substr($debt,0,-1), substr($guess,0,-1));
    else
        return 1 + score(substr($debt,0,-1), substr($guess,0,-1));
}

function message($scores){
    $messages = array(
        "correct" => "Correct! You've guessed our debt! I'm sorry we can't give you a prize--we're broke.",
        "wrong" => "Sorry, you don't have any digits correct.",
        "soclose" => "You're so close!",
        "waystogo" => "You've got a ways to go.",
        "greatstart" => "Great start!",
        "goodstart" => "Not a bad start.",
        "badstart" => "Rough start.",
        "better" => "You're getting closer.",
        "same" => "You didn't go anywhere!",
        "worse" => "You were closer last time!"
    );

    if(count($scores) === 1){
        switch(end($scores)){
            case 0: case 1:
                $msg[] = $messages["badstart"];
                break;
            case 2: case 3: case 4: case 5:
                $msg[] = $messages["goodstart"];
                break;
            case 6: case 7:
                $msg[] = $messages["greatstart"];
                break;
        }
    }
    elseif(count($scores) >= 2){
        if(end($scores) > prev($scores))
            $msg[] = $messages["better"];
        elseif(end($scores) < prev($scores))
            $msg[] = $messages["worse"];
        else
            $msg[] = $messages["same"];
    }
    
    switch(end($scores)){
        case 0:
            $msg[] = $messages["wrong"];
            break;
        case 1:
            $msg[] = $messages["waystogo"];
            break;
        case 7:
            $msg[] = $messages["soclose"];
            break;
        case 8:
            $msg = array($messages["correct"]);
            break;
    }
    return implode(" ", $msg);
}

function married(){
	$now = mktime();
	$wedding = strtotime("10/6/07");
    $days = date("j", $now) - date("j", $wedding);
    $months = date("n", $now) - date("n", $wedding);
    $years = date("Y", $now) - date("Y", $wedding);
    if($days < 0){
        $days *= -1;
        $days += date(t, strtotime(date("n", $now) - 1 . "/" . date("j/Y", $now)));
    }
    if($months < 0){
        $years -= 1;
        $months += 12;
    }
    $time[] = ($years > 0) ? "$years years" : "";
    $time[] = ($months != 0) ? "$months months" : "";
    $time[] = ($days != 0) ? "$days days" : "";
    return ImplodeProper($time);
}

function ImplodeProper($arr, $lastConnector = 'and')
{
    $arr = array_filter($arr);
    if( !is_array($arr) or count($arr) == 0) return '';
    $last = array_pop($arr);
    if(count($arr))
        return implode(', ',$arr).((count($arr)>1)? "," : "")." $lastConnector $last";
    else
        return $last; 
}
?>