<?php

namespace App\Service;

class Service
{
    public function prime(int $first, int $second) : array
    {
        if($first> $second){
            $temp = $first;
            $start = $second;
            $end = $temp;
        }else{
            $start = $first;
            $end = $second;
        }

        $primes = [];

        for($i=$start;$i<=$end;$i++){
            if($this->isItPrime($i)){
                $primes[] = $i;
            }

        }

        return $primes;
    }

    private function isItprime(int $integer): bool
    {
        if($integer<2){
            return false;
        }
        for($i=2;$i<=sqrt($integer);$i++){
            if($integer%$i == 0){
                return false;
            }

        }

        return true;
    }
}