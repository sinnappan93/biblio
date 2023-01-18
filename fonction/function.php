<?php
	function affichage($variable){
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}


    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN"; 
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
?>



<style>
	pre{
		display: block;
		font-family: monospace;
		white-space: pre;
		margin:1em 0;
		background-color: white;
		border-radius: 5px;
	}
</style>
