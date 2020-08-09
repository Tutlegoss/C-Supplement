<?php
	/* Syntax for $raw[]:
		+--------------------+-----------------+
		|Wrap all strings:   |       ' '       |
		|--------------------------------------|
		|newlines:           |       \\n       |
		|--------------------------------------|
		|display newline:    |      \\\n       |
		|--------------------------------------|
		|display apostrophe  |     . "\'" .    |
		|--------------------------------------|
		|display quote       |        "        |
		+--------------------+-----------------+
	*/
	
	/* Code display variables $_<VAR> are solely a portion of an overall styling variable */
	$_span        = '<span class="';
	$_code        = '<code class="';
	$_startOfLine = '<div><pre><span></span>';
	$endOfLine    = '</code></pre></div>'; //Use in step 3, but defined here due to use in $emptyLine
	/* 1) Choose an overall line style first */
	$emptyLine    = $_startOfLine . '<code> ' . $endOfLine;
	$includeLine  = $_startOfLine . $_code . 'magenta">';
	$commentLine  = $_startOfLine . $_code . 'text-white">';
	$bodyLine     = $_startOfLine . $_code . 'green">';
	/* 2-repeat) Choose color of the next code, write the code, and end with $endSpan always */
	$keyword   = $_span . 'red">';
	$type      = $_span . 'cyan">';
	$comment   = $_span . 'text-white">';
	$escape    = $_span . 'yellow">';
	$literal   = $_span . 'magenta">';
	$nonPrim   = $_span . 'turquoise">';
	$endSpan   = '</span>';
	/* 3) End with $endOfLine always */

	$code[4] =  $includeLine . '#include &lt;iostream&gt;										' . $endOfLine
			   .$emptyLine
			   .$bodyLine . '	class Box{														' . $endOfLine
			   .$bodyLine . 'int main(){										   				' .$endOfLine
			   .$bodyLine	.'	int SIZE = 5; 									   				' .$endOfLine
			   .$bodyLine	.'	int for[SIZE], while[SIZE], do[SIZE], case[SIZE];  				' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.'	// For Loop							  			   				' .$endOfLine
			   .$bodyLine	.'	for(int i = 0; i < SIZE; ++i) 					   				' .$endOfLine
			   .$bodyLine	.'  	for[i] = i;									  			 	' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' // While Loop 									   				' .$endOfLine
			   .$bodyLine	.' int j = 0;									       				' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' while(j != 5){									   				' .$endOfLine
			   .$bodyLine	.'		while[SIZE] = j;							   				' .$endOfLine
			   .$bodyLine	.'		++j;										   				' .$endOfLine
			   .$bodyLine	.' }												   				' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' // Do-While Loop									   				' .$endOfLine
			   .$bodyLine	.' int k = 0; 										   				' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' do{											       				' .$endOfLine
			   .$bodyLine	.' 	do[SIZE] = k;								   					' .$endOfLine
		       .$bodyLine	.'	++k;									       					' .$endOfLine
			   .$bodyLine	.' }while(k != 5);					     	  	   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' //Switch-Case Loop							   					' .$endOfLine
			   .$bodyLine	.' int l = 1;								       					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' switch(l){									   					' .$endOfLine
			   .$bodyLine	.' 	case 1:									   						' .$endOfLine
			   .$bodyLine	.'  	case[SIZE] = l;							   					' .$endOfLine
			   .$bodyLine	.'		++l;									   					' .$endOfLine
			   .$bodyLine	.'		break;									   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.'	case 2:										   					' .$endOfLine
			   .$bodyLine	.'		case[SIZE] = l;							   					' .$endOfLine
			   .$bodyLine	.'		++l;									   					' .$endOfLine
			   .$bodyLine	.'		break;									   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.'  case 3:										   					' .$endOfLine
			   .$bodyLine	.'		break;									   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.'	default:									   					' .$endOfLine
			   .$bodyLine	.'		exit(0);								   					' .$endOfLine
			   .$bodyLine	.' }											   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' // Printing each loop						   					' .$endOfLine
			   .$bodyLine	.' std::cout << "For loop contains: ";			   					' .$endOfLine
			   .$bodyLine	.' for(int i = 0; i < SIZE; ++i)				   					' .$endOfLine
			   .$bodyLine	.'	std::cout << for[i] << ", ";				   					' .$endOfLine
			   .$bodyLine	.' std::cout << std::endl;						   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' std::cout << "While loop contains: ";		   					' .$endOfLine
			   .$bodyLine	.' for(int i = 0; i < SIZE; ++i)				   					' .$endOfLine
			   .$bodyLine	.'	std::cout << while[i] << ", ";				   					' .$endOfLine
			   .$bodyLine	.' std::cout << std::endl;						   					' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' // Printing each loop 							   				' .$endOfLine
			   .$bodyLine	.' std::cout << "Do-While loop contains: ";			   				' .$endOfLine
			   .$bodyLine	.' for(int i = 0; i < SIZE; ++i)					   				' .$endOfLine
			   .$bodyLine	.'	std::cout << do[i] << ", ";						  		 		' .$endOfLine
			   .$bodyLine	.' std::cout << std::endl;						    				' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' // Printing each loop							   				' .$endOfLine
			   .$bodyLine	.' std::cout << "Switch-Case loop contains: ";		   				' .$endOfLine
			   .$bodyLine	.' for(int i = 0; i < SIZE; ++i)					   				' .$endOfLine
			   .$bodyLine	.'	std::cout << case[i] << ", ";					   				' .$endOfLine
			   .$bodyLine	.' std::cout << std::endl;											' .$endOfLine
			   .$emptyLine	
			   .$bodyLine	.' return 0;										  				' .$endOfLine
			   .$bodyLine	.'}														 			' .$endOfLine
			   .$emptyLine
			   .$bodyLine . $keyword . '    return ' . $endSpan . $literal . '0' . $endSpan . ';' . $endOfLine
			   .$bodyLine . '}																	' . $endOfLine;
	
	$raw[4] =   '#include <iostream>								\\n\\n'
								
				.'int main(){										   \\n'
				.'	int SIZE = 5; 									   \\n'
				.'	int for[SIZE], while[SIZE], do[SIZE], case[SIZE];  \\n'
				
				.'	// For Loop							  			   \\n'
				.'	for(int i = 0; i < SIZE; ++i) 					   \\n'
				.'  	for[i] = i;									\\n\\n'
				
				.' // While Loop 									   \\n'
				.' int j = 0;									    \\n\\n'
				
				.' while(j != 5){									   \\n'
				.'		while[SIZE] = j;							   \\n'
				.'		++j;										   \\n'
				.' }												\\n\\n'
				
				.' // Do-While Loop									   \\n'
				.' int k = 0; 										\\n\\n'
				
				.' do{											       \\n'
				.' 	do[SIZE] = k;								       \\n'
				.'	++k;									           \\n'
				.' }while(k != 5);					     	  	    \\n\\n'
				
				.' //Switch-Case Loop								   \\n'
				.' int l = 1;								    	\\n\\n'
				
				.' switch(l){									       \\n'
				.' 	case 1:											   \\n'
				.'  	case[SIZE] = l;								   \\n'
				.'		++l;										   \\n'
				.'		break;										\\n\\n'
				
				.'	case 2:											   \\n'
				.'		case[SIZE] = l;								   \\n'
				.'		++l;										   \\n'
				.'		break;										\\n\\n'
				
				.'  case 3:											   \\n'
				.'		break;										\\n\\n'
				
				.'	default:										   \\n'
				.'		exit(0);									   \\n'
				.' }												\\n\\n'
				
				.' // Printing each loop							   \\n'
				.' std::cout << "For loop contains: ";				   \\n'
				.' for(int i = 0; i < SIZE; ++i)					   \\n'
				.'	std::cout << for[i] << ", ";				       \\n'
				.' std::cout << std::endl;							\\n\\n'
				
				.' std::cout << "While loop contains: ";			   \\n'
				.' for(int i = 0; i < SIZE; ++i)				       \\n'
				.'	std::cout << while[i] << ", ";					   \\n'
				.' std::cout << std::endl;							\\n\\n'
				
				.' // Printing each loop 							   \\n'
				.' std::cout << "Do-While loop contains: ";			   \\n'
				.' for(int i = 0; i < SIZE; ++i)					   \\n'
				.'	std::cout << do[i] << ", ";						   \\n'
				.' std::cout << std::endl;						    \\n\\n'
				
				.' // Printing each loop							   \\n'
				.' std::cout << "Switch-Case loop contains: ";		   \\n'
				.' for(int i = 0; i < SIZE; ++i)					   \\n'
				.'	std::cout << case[i] << ", ";					   \\n'
				.' std::cout << std::endl;							\\n\\n'
				
				.' return 0;										  \\n'
				.'}														 ';