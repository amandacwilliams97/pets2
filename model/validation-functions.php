<?php
/**
 * Created by PhpStorm.
 * User: philbowden
 * Date: 3/17/19
 * Time: 9:01 AM
 */

function validColor($color)
{
    global $f3;
    return in_array($color, $f3->get('colors'));
}

function validString($animal)
{
    if($animal != "")
    {
        if(ctype_alpha($animal))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}