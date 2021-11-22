<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function splitChiffre($ds)
{
    $chiffre = '';
    $count = strlen($ds);
    $i = 0;
        if($count % 3 == 0)
            do{
                    $chiffre .= substr($ds, $i , 3).".";
                    $count -= 3;
                    $i += 3;
                }
                while($count > 0);
        
        else if($count % 3 == 2)
            {
                $chiffre .= substr($ds, $i , 2).".";
                $i+= 2;
                do{
                    $chiffre .= substr($ds, $i , 3).".";
                    $count -= 3;
                    $i += 3;
                }
                while($count > 0);
            }
        else if($count % 3 == 1)
            {
                $chiffre .= substr($ds, $i , 1).".";
                $i = 1;
                do{
                    $chiffre .= substr($ds, $i , 3).".";
                    $count -= 3;
                    $i += 3;
                }
                while($count > 0);
                    
}
echo rtrim($chiffre , ".");
}
