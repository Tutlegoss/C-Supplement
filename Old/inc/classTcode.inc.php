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
			   .$bodyLine . '		public:														' . $endOfLine
			   .$bodyLine . '			void make    (int, int, int);							' . $endOfLine
			   .$bodyLine . '			int	find_volume();										' . $endOfLine
			   .$bodyLine . '		private:													' . $endOfLine
			   .$bodyLine . '			int length, width, height;								' . $endOfLine
			   .$bodyLine . '	};																' . $endOfLine
			   .$emptyLine
			   .$bodyLine . '	Box::Box(){														' . $endOfLine
			   .$bodyLine . '		length = 0;													' . $endOfLine
			   .$bodyLine . '		width = 0;													' . $endOfLine
			   .$bodyLine . '		height = 0;													' . $endOfLine
			   .$bodyLine . '	}																' . $endOfLine
			   .$emptyLine 
			   .$bodyLine . '	void Box::make(int l, int w, int h){							' . $endOfLine
			   .$bodyLine . '		length = l;													' . $endOfLine
			   .$bodyLine . '		width = 0;													' . $endOfLine
			   .$bodyLine . '		height = 0;													' . $endOfLine
			   .$bodyLine . '	}																' . $endOfLine
			   .$emptyLine  
			   .$bodyLine . '	int Box::find_volume(){											' . $endOfLine
			   .$bodyLine . '		return (length * width * height);							' . $endOfLine
			   .$bodyLine . '	}																' . $endOfLine  
			   .$emptyLine  
			   .$bodyLine . $type . 'int ' . $endSpan . 'main(){								' . $endOfLine
			   .$bodyLine . '	Box myBox;														' . $endOfLine
			   .$emptyLine
			   .$bodyLine . '   // Making and printing a box									' . $endOfLine
			   .$bodyLine . '	myBox.make(2, 2, 2);		    								' . $endOfLine
			   .$bodyLine . '	std::cout << myBox.find_volume() << std::endl; 														    ' . $endOfLine
			   .$emptyLine  
			   .$bodyLine . $keyword . '    return ' . $endSpan . $literal . '0' . $endSpan . ';' . $endOfLine
			   .$bodyLine . '}																	' . $endOfLine;
	
	$raw[4] =   '#include <iostream>								\\n\\n'

				.'class Box{										   \\n'
				.'	public:										       \\n'
				.'		Box();										   \\n'
				.'		void make(int, int, int);					   \\n'
				.'		int find_volume();							   \\n'
				.'	private:										   \\n'
				.'		int length, width, height;					   \\n'
				.'};											    \\n\\n'

				.'Box::Box(){										   \\n'
				.'	length = 0;										   \\n'
				.'	width = 0;									       \\n'
				.'	height = 0;										   \\n'
				.'}												    \\n\\n'
				
				.'void Box::make(int l, int w, int h){				   \\n'
				.'	length = l;										   \\n'
				.'	width = w;										   \\n'
				.'	height = h;										   \\n'
				.'}\\n\\n'

				.'int Box::find_volume(){							   \\n'
				.'	return (length * width * height);				   \\n'
				.'}													\\n\\n'

				.'int main(){\\n'
				.'	Box myBox;\\n'

				.'	myBox.make(2, 2, 2);							  \\n'
				.'	std::cout << myBox.find_volume() << std::endl; \\n\\n'

				.'	return 0;										  \\n'
				.'}'												     ;