<?php
/*
    Minimax part of the Condorcet PHP Class

    By Julien Boudry - MIT LICENSE (Please read LICENSE.txt)
    https://github.com/julien-boudry/Condorcet
*/
declare(strict_types=1);

namespace Condorcet\Algo\Methods;

use Condorcet\Algo\Methods\Minimax_Core;
use Condorcet\CondorcetException;
use Condorcet\Result;

class MinimaxMargin extends Minimax_Core
{
    // Method Name
    public const METHOD_NAME = ['Minimax Margin','MinimaxMargin','MinimaxMargin','Minimax_Margin'];

    protected function makeRanking () : void
    {
        $this->_Result = $this->createResult(self::makeRanking_method('margin', $this->_Stats));
    }
}
