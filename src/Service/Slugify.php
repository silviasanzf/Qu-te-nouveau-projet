<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 25/11/18
 * Time: 16:11
 */

namespace App\Service;


class Slugify
{
    public function generate (string $input): string
    {
        $input = trim($input);
        $input = preg_replace('#Ç#', 'C', $input);
        $input = preg_replace('#ç#', 'c', $input);
        $input = preg_replace('#è|é|ê|ë#', 'e', $input);
        $input = preg_replace('#È|É|Ê|Ë#', 'E', $input);
        $input = preg_replace('#à|á|â|ã|ä|å#', 'a', $input);
        $input = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $input);
        $input = preg_replace('#ì|í|î|ï#', 'i', $input);
        $input = preg_replace('#Ì|Í|Î|Ï#', 'I', $input);
        $input = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $input);
        $input = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $input);
        $input = preg_replace('#ù|ú|û|ü#', 'u', $input);
        $input = preg_replace('#Ù|Ú|Û|Ü#', 'U', $input);
        $input = preg_replace('#ý|ÿ#', 'y', $input);
        $input = preg_replace('#Ý#', 'Y', $input);
        $input = preg_replace('/(-)/', ' ', $input);
        $input = preg_replace('/( +)/', '-', $input);
        $input = preg_replace('/[^A-Za-z0-9-]/', '', $input);
        $input = preg_replace('/(-+)/', '-', $input);
        return $input;

    }
}

