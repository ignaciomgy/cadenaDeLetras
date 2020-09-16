<?php

//proceso recursivo con salida a un archivo de texto.
//en caso de no existir el archivo crea circleWords.txt

//ie array
$words = array('chair', 'height', 'racket', 'touch', 'tunic');
$circulo = array();

//Recorro el array $words para allar las combinaciones que me 
//lleven a conseguir un circulo de palabras

foreach ($words as $word) 
{
	circleWords($words, $circulo, $word);
}

function circleWords($words, $circ, $pivot) 
{
	$sizeWords = count($words); 

	if ($sizeWords > 0) 
	{ 
		$key_pivot = array_search($pivot, $words);
		unset($words[$key_pivot]); 
		array_push($circ, $pivot);

		if (count($words) == 0) 
		{
			endCircle($circ, $pivot);
		}

		foreach ($words as $key => $value) {
			if (controlExist($words, $pivot, $value)) {
				circleWords($words, $circ, $value);
			}
		}
	}

}

function endCircle($circ, $pivot) {
	$firstWord = $circ[0]; 
	if (compareLetters($pivot, $firstWord))
	{
		array_push($circ, $firstWord);
		write_output_file($circ);
	}
}

function controlExist($ar_swds, $pvt, $word) {
	foreach ($ar_swds as $w) {
		if (compareLetters($pvt,$word)) {
			return true;
		}
	}
}

function compareLetters($word1, $word2) {
	if ($word1[strlen($word1) -1] == $word2[0]) {
		return true;
	}
}

function write_output_file($circleWords) {
	$wordsFile = fopen("circleWords.txt", "a") or die("Unable to open file!");
	foreach ($circleWords as $words) {
		fwrite($wordsFile, $words. " ");
	}
	fwrite($wordsFile, "\r\n");
	fclose($wordsFile);
}

?>