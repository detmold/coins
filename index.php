<?php 
/**
 * Date 08/12/2018
 * @author Piotr Walczak
 *
 * Wykorzystuje dynamiczne programowanie do obliczenia maksymalnej liczby z n przy założeniu, że
 * wynik = max((n/2 + n/3 + n4), n) dla wszytkich n należących do zbioru <12 , 1 000 000 000> 
 * oraz wynik = n dla wszystkich n należących <0 , 11> 
 * w rozwiązaniu użyta jest technika memonanzation + rekursja 
 * Link do zadania: https://www.spoj.com/problems/COINS/
 *
 * Złożoność czasowa - O(log(n)) - przy zastosowaniu optymalizacji memonanzation
 *
 */

class Coins {
    private $matrix = array();
    private $count = 0;
 
    private function compute($n) {
      if (!isset($this->matrix[$n])) {
        $this->count++;
        if ($n  >= 0 && $n < 12) {
            $this->matrix[$n] = $n;
        } else {
            $a = $n >> 1;
            $b = floor($n/3);
            $c = $n >> 2;
            $this->matrix[$a] = !isset($this->matrix[$a]) ? $this->compute($a) : $this->matrix[$a];
            $this->matrix[$b] = !isset($this->matrix[$b]) ? $this->compute($b) : $this->matrix[$b];
            $this->matrix[$c] = !isset($this->matrix[$c]) ? $this->compute($c) : $this->matrix[$c];
            $this->matrix[$n] = max(($this->matrix[$a] + $this->matrix[$b] + $this->matrix[$c]), $n);
        }
      }
      return $this->matrix[$n];
 
    }
 
    public function init() {
        // while($n = stream_get_contents(STDIN)) {
        //     echo $this->compute($n) . PHP_EOL;
        // }
        while (($n = trim(fgets(STDIN))) || $n == '0') {
            echo $this->compute($n) . PHP_EOL;
        }
    }
}
 
$lps = new Coins();
$lps->init();
?>