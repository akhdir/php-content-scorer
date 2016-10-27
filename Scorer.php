<?php 

class Scorer {

	private $high_risk_phrases = Array();

	private $low_risk_phrases = Array();

	private $high_risk_score;

	private $low_risk_score;

	function __construct(Array $high_risk, Array $low_risk, $high_risk_score = 2, $low_risk_score = 1) {

		// apply cleanup on every element of the array, and get a unique array
		$high_risk = array_unique(array_map( array($this, "_cleanUp"), $high_risk));

		$low_risk = array_unique(array_map( array($this, "_cleanUp"), $low_risk));
		
		$this->low_risk_phrases = $low_risk;

		$this->high_risk_phrases = $high_risk;

		$this->high_risk_score = $high_risk_score;

		$this->low_risk_score = $low_risk_score;

	}


	function score($comment) {

		$comment =  $this->_cleanUp($comment);

		$score = 0;
		
		foreach ( $this->high_risk_phrases as $value) {

			$score += $this->high_risk_score * $this->_phraseCount( $value, $comment); 

		}

		foreach ( $this->low_risk_phrases as $value) {

			$score += $this->low_risk_score * $this->_phraseCount( $value, $comment); 

		}

		return $score;

	}


	function scoreFast($comment) {

		$comment =  $this->_cleanUp($comment);

		// tear down the comment to array of words
		$words = explode(" ", $comment);

		// flip words array to makes words keys instead of values
		$words = array_flip($words);
		
		return $this->_calculate($this->high_risk_phrases, $comment, $words, $this->high_risk_score) + 
			$this->_calculate($this->low_risk_phrases, $comment, $words, $this->low_risk_score);

	}

	private function _cleanUp($textLine) {

		// remove puncutations
		$textLine = preg_replace("#[[:punct:]]#", " ", $textLine);

		// remove newlines and trim spaces
		$textLine = trim(preg_replace('/\s\s+/', ' ', $textLine));

		// convert to lowercase
		$textLine = strtolower($textLine);

		return $textLine;

	}


	private function _phraseCount( $phrase, $statement) {
		return preg_match_all( '/\b'.$phrase.'\b/', $statement);
	}


	private function _calculate(Array $phrases, $statement, Array $words, $risk_score) {

		$score = 0;

		foreach ( $phrases as $value) {

			// check if the risky phrase is a single word or multi word
			if( str_word_count($value,0) == 1 ){  // single word phrase

				if( isset($words[$value]) ){
					// we found at least one occurance, let's count all occurances
					$score += $risk_score * $this->_phraseCount( $value, $statement); 

				}

			} else { //multi word phrase

				$mutli = explode(" ", $value);

				if( isset($words[$mutli[0]]) ) {
					// we found at least one word of the phrase in the comment, let's count all occurances of the phrase
					$score += $risk_score * $this->_phraseCount( $value, $statement); 

				}

			}

		}

		return $score;

	}

}

?>