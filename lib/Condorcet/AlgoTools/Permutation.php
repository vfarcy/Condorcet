<?php
/*
    Condorcet PHP Class, with Schulze Methods and others !

    Version: 0.93

    By Julien Boudry - MIT LICENSE (Please read LICENSE.txt)
    https://github.com/julien-boudry/Condorcet
*/
namespace Condorcet\AlgoTools ;

// Thanks to Jorge Gomes @cyberkurumin 
class Permutation
{
    public static $_prefix = 'C';

    public $results = [];

    public static function countPossiblePermutations ($candidatesNumber) {
        
        if (!is_int($candidatesNumber))
            { return false; }


        $result = $candidatesNumber ;

        for ($iteration = 1 ; $iteration < $candidatesNumber ; $iteration++)
        {
            $result = $result * ($candidatesNumber - $iteration) ;
        }

        return $result ;
    }


    public function __construct($arr) {
        $this->_exec(
            $this->_permute( (is_int($arr)) ? $this->createCandidates($arr) : $arr )
        );
    }

    public function getResults ($serialize = false) {
        return ($serialize) ? serialize($this->results) : $this->results ;
    }

    public function writeResults ($path) {
        file_put_contents($path, $this->getResults(true));
    }

    protected function createCandidates ($numberOfCandidates) {
        $arr = array();

        for ($i = 0 ; $i < $numberOfCandidates ; $i++) {
            $arr[] = self::$_prefix.$i;
        }
        return $arr;
    }

    private function _exec($a, array $i = []) {
        if (is_array($a)) {
            foreach($a as $k => $v) {
                $i2 = $i;
                $i2[] = $k;

                $this->_exec($v, $i2);
            }
        }
        else {
            $i[] = $a;

            // Del 0 key, first key must be 1.
            $r = [0=>null]; $r = array_merge($r,$i); unset($r[0]);

            $this->results[] = $r;
        }
    }

    private function _permute(array $arr) {
        $out = array();
        if (count($arr) > 1)
            foreach($arr as $r => $c) {
                $n = $arr;
                unset($n[$r]);
                $out[$c] = $this->_permute($n);
            }
        else {
            return array_shift($arr);
        }
        return $out;
    }
}