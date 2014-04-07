<?php
/*
	Part of the Condorcet PHP Class, with Schulze Methods and others !

	Version : 0.4

	By Julien Boudry - MIT LICENSE (Please read LICENSE.txt)
	https://github.com/julien-boudry/Condorcet_Schulze-PHP_Class 
*/


// Registering algorithm
Condorcet::add_algos('Condorcet_basic') ;


// Condorcet Basic Class, provide natural Condorcet winner or looser
class Condorcet_Condorcet_basic
{
	// Config
	protected $_Pairwise ;
	protected $_options_count ;
	protected $_options ;

	// Basic Condorcet
	protected $_basic_Condorcet_winner ;
	protected $_basic_Condorcet_loser ;


	public function __construct (array $config)
	{
		$this->_Pairwise = $config['_Pairwise'] ;
		$this->_options_count = $config['_options_count'] ;
		$this->_options = $config['_options'] ;
	}



/////////// PUBLIC ///////////


	public function get_result ()
	{
		return $this->get_winner ;
	}

	// Get the Schulze ranking
	public function get_stats ()
	{
		return Condorcet::get_static_Pairwise($this->_Pairwise, $this->_options) ;
	}


	// Get a Condorcet certified winner. If there is none = null. You can force a winner choice with alternative supported methods ($substitution)
	public function get_winner ()
	{
		// Cache
		if ( $this->_basic_Condorcet_winner !== null )
		{
			return $this->_basic_Condorcet_winner ;
		}


		// Basic Condorcet calculation
		foreach ( $this->_Pairwise as $candidat_key => $candidat_detail )
		{
			$winner = true ;

			foreach ($candidat_detail['win'] as $challenger_key => $win_count )
			{
				if	( $win_count <= $candidat_detail['lose'][$challenger_key] )
				{
					$winner = false ;
					break ;
				}
			}

			if ($winner)
			{
				$this->_basic_Condorcet_winner = $this->_options[$candidat_key] ;

				return $this->_basic_Condorcet_winner ;
			}
		}

			return null ;
	}

	// Get a Condorcet certified loser. If there is none = null. You can force a winner choice with alternative supported methods ($substitution)
	public function get_loser ()
	{
		// Cache
		if ( $this->_basic_Condorcet_loser !== null )
		{
			return $this->_basic_Condorcet_loser ;
		}

			//////

		// Basic Condorcet calculation
		foreach ( $this->_Pairwise as $candidat_key => $candidat_detail )
		{
			$loser = true ;

			foreach ( $candidat_detail['lose'] as $challenger_key => $lose_count )
			{
				if	( $lose_count <= $candidat_detail['win'][$challenger_key] )
				{  
					$loser = false ;
					break ;
				}
			}

			if ($loser)
			{ 
				$this->_basic_Condorcet_loser = $this->_options[$candidat_key] ;

				return $this->_basic_Condorcet_loser ;
			}
		}

			return null ;
	}


}
