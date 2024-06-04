<?php 

namespace App\services;

final class SystemNotation 
{
    public function convertirNote($note)
{
    if ($note >= 16 && $note <= 20) {
        return 'A+';
    } elseif ($note >= 14 && $note <= 15.9) {
        return 'A';
    } elseif ($note >= 12 && $note <= 13.9) {
        return 'B';
    } elseif ($note >= 10 && $note <= 11.9) {
        return 'C';
    } elseif ($note >= 8 && $note <= 9.9) {
        return 'D';
    } elseif ($note >= 0 && $note <= 7.9) {
        return 'F';
    } else {
        return 'Note invalide';
    }
}

}
