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
	$_startOfLine = '<div><pre id="pre-code"><span></span>';
	$end    = '</code></pre></div>'; //Use in step 3, but defined here due to use in $empty
	/* 1) Choose an overall line style first */
	$empty = $_startOfLine . '<code> ' . $end;
	$inc   = $_startOfLine . $_code . 'magenta">';
	$cmnt  = $_startOfLine . $_code . 'text-white">';
	$body  = $_startOfLine . $_code . 'green">';
	/* 2-repeat) Choose color of the next code, write the code, and end with $es always */
	$k  = $_span . 'red">';
	$t  = $_span . 'cyan">';
	$c  = $_span . 'text-white">';
	$e  = $_span . 'yellow">';
	$l  = $_span . 'magenta">';
	$n  = $_span . 'turquoise">';
	$es = '</span>';
	/* 3) End with $end always */

	$code["VirtualFunctions"] =  
		$inc.'#include &lt;iostream&gt;'.$end
	   .$empty
	   .$body.$t.'class'.$es .' Parent'.$end
	   .$body.'{ '.$c.'//Virtual keyword required in the parent class'.$es.$end
	   .$body.$k.'    public'.$es.':'.$end
	   .$body.$t.'        virtual void '.$es.'display() '.$t.'const'.$es.$end
	   .$body.'        {'.$end
	   .$body.'            std::cout &lt;&lt; '.$l.'"Parent Class Display'.$e.'\n'.$es.'"'.$es.';'.$end
	   .$body.'        }'.$end
	   .$body.'};'.$end
	   .$empty
	   .$cmnt.'/* The virtual keyword and override identifier are not required in the'.$end
	   .$cmnt.'   child classes, but it is good practice to include them where necessary */'.$end
	   .$body.$t.'class'.$es.' Child1 : '.$k.'public '.$es.'Parent'.$end
	   .$body.'{ '.$end
	   .$body.$k.'    public'.$es.':'.$end
	   .$body.$t. '        virtual void '.$es.'display() '.$t.'const override'.$es.$end
	   .$body.'        {'.$end
	   .$body.'            std::cout &lt;&lt; '.$l.'"Child1 Class Display'.$e.'\n'.$es.'"'.$es.';'.$end
	   .$body.'        }'.$end
	   .$body.'};'.$end
	   .$empty
	   .$body.$t.'class'.$es.' Child2 : '.$k.'public '.$es.'Parent'.$end
	   .$body.'{ '.$end
	   .$body.$k.'    public'.$es.':'.$end
	   .$body.$t.'        virtual void '.$es.'display() '.$t.'const override'.$es.$end
	   .$body.'        {'.$end
	   .$body.'            std::cout &lt;&lt; '.$l.'"Child2 Class Display'.$e.'\n'.$es.'"'.$es.';'.$end
	   .$body.'        }'.$end
	   .$body.'};'.$end
	   .$empty
	   .$body.$t.'class'.$es.' Child3 : '.$k.'public '.$es.'Parent'.$end
	   .$body.'{ '.$end
	   .$cmnt.'    // Empty to show that the Parent class\' function is invoked'.$end
	   .$body.'};'.$end
	   .$empty
	   .$body.$t.'int '.$es.'main()'.$end
	   .$body.'{ '.$end
	   .$body.$n.'    Child1 '.$es.'Obj1;'.$end
	   .$body.'    Obj1.display(); '.$c.'// Child1 Class Display'.$es.$end
	   .$body.$n.'    Child2 '.$es.'Obj2;'.$end
	   .$body.'    Obj2.display(); '.$c.'// Child2 Class Display'.$es.$end
	   .$body.$n.'    Child3 '.$es.'Obj3;'.$end
	   .$body.'    Obj3.display(); '.$c.'// Parent Class Display'.$es.$end
	   .$body.$k.'    return '.$es.$l.'0'.$es.';'.$end
	   .$body.'}'.$end;
	
	$raw["VirtualFunctions"] =   
		'#include <iostream>\\n\\n'
	   .'class Parent\\n'
	   .'{ //Virtual keyword required in the parent class\\n'
	   .'    public:\\n'
	   .'        virtual void display() const\\n'
	   .'        {\\n'
	   .'            std::cout << "Parent Class Display\\\n";\\n'
	   .'        }\\n'
	   .'};\\n\\n'
	   .'/* The virtual keyword and override identifier are not required in the\\n'
	   .'   child classes, but it is good practice to include them where necessary */\\n'
	   .'class Child1 : public Parent\\n'
	   .'{\\n' 
	   .'    public:\\n'
	   .'        virtual void display() const override\\n'
	   .'        {\\n'
	   .'            std::cout << "Child1 Class Display\\\n";\\n'
	   .'        }\\n'
	   .'};\\n\\n'
	   .'class Child2 : public Parent\\n'
	   .'{\\n'
	   .'    public:\\n'
	   .'        virtual void display() const override\\n'
	   .'        {\\n'
	   .'            std::cout << "Child2 Class Display\\\n";\\n'
	   .'        }\\n'
	   .'};\\n\\n'
	   .'class Child3 : public Parent\\n'
	   .'{\\n'
	   .'    // Empty to show that the Parent class' ."\'". ' function is invoked\\n'
	   .'};\\n\\n'
	   .'int main()\\n'
	   .'{\\n'
	   .'    Child1 Obj1;\\n'
	   .'    Obj1.display(); // Child1 Class Display\\n'
	   .'    Child2 Obj2;\\n'
	   .'    Obj2.display(); // Child2 Class Display\\n'
	   .'    Child3 Obj3;\\n'
	   .'    Obj3.display(); // Parent Class Display\\n'
	   .'    return 0;\\n'
	   .'}\\n';

	$code["Pointers1"] =
		$body.$t.'int '.$es.'x = '.$l.'1'.$es.';'.$end
       .$body.$t.'int'.$es.'* pointer;'.$end
       .$body.'pointer = &x;'.$end;

	$raw["Pointers1"] =
		'int x = 1; \\n'
	   .'int* pointer; \\n'
	   .'pointer = &x \\n';
	   
	$code["Pointers2"] =
		$body.$t.'typedef int'.$es.'* intPtrs;'.$end
       .$body.'intPtrs ptr, ptr2, ptr3;'.$end;

	$raw["Pointers2"] =
		'typedef int* intPtrs; \\n'
	   .'intPtrs ptr, ptr2, ptr3 \\n';
	   
	$code["Pointers3"] =
		$body.'*pointer = '.$l.'23'.$es.';'.$c. ' // Changed x to 23'.$es.$end
       .$body.'std::cout &lt;&lt; '.$l.'x is now: '.$es.'&lt;&lt; x &lt;&lt; std::endl;'.$c.' // Displays 23'.$es.$end;

	$raw["Pointers3"] =
		'typedef int* intPtrs; \\n'
	   .'intPtrs ptr, ptr2, ptr3 \\n';
	   
	$code["Pointers4"] = 
		$body.'std::cout &lt;&lt; pointer &lt;&lt; '.$l.'" is the same as outputting "'.$es.' &lt;&lt; &x &lt;&lt std::endl;'.$end;
	
	$raw["Pointers4"] =
		'std::cout << pointer << " is the same as outputting " << &x << std::endl; \\n';
		
	$code["Pointers5"] =
		$body.$t.'int '.$es.'x = '.$l.'100'.$es.';'.$end
       .$body.$t.'int '.$es.'*ptr1, *ptr2;'.$end
       .$body.'ptr1 = &x;'.$end
	   .$body.'ptr2 = ptr1;'.$end;

	$raw["Pointers5"] =
		'int x = 100; \\n'
	   .'int *ptr1, *ptr2; \\n'
	   .'ptr1 = &x; \\n'
	   .'ptr2 = ptr1; \\n';
	   
	$code["Pointers6"] =
		$body.$t.'void '.$es.'function('.$t.'int '.$es.'*ptr);'.$c.' // Function declaration'.$es.$end
       .$body.'function(pointer_variable);'.$c.' // Function invocation elsewhere in program'.$es.$end;
	   
	$raw["Pointers6"] =
		'void function(int *ptr); // Function declaration \\n'
	   .'function(pointer_variable); // Function invocation elsewhere in program \\n';
	   
	$code["Pointers7"] =
		$body.$t.'void'.$es.' function('.$t.'const int'.$es.' *ptr);'.$end;
	$raw["Pointers7"] = 
		'void function(const int *ptr); \\n';
		
	$code["PointersQuiz1"] = 
		$body.$t.'int '.$es.'x = '.$l.'25'.$es.';'.$end
	   .$body.$t.'int'.$es.'* ptr = &x;'.$end
	   .$body.'std::cout &lt;&lt; *ptr &lt;&lt; std::endl;'.$end;
	   
	$code["PointersQuiz2"] = 
		$body.$t.'char '.$es.'c = '.$l.'\'c\''.$es.';'.$end
	   .$body.$t.'char'.$es.' d = '.$l.'\'d\''.$es.', *ptr = &c;'.$end
	   .$body.'std::cout &lt;&lt; *ptr &lt;&lt; std::endl;'.$end;
	   
	$code["PointersQuiz3"] =
		$inc . '#include &lt;iostream&gt;'.$end
	   .$empty
	   .$body.$t.'void '.$es.'changeVal('.$t.'int '.$es.'*ptr)'.$end
	   .$body.'{'.$end
	   .$body.'    *ptr = '.$l.'204'.$es.';'.$end
	   .$body.'}'.$end
	   .$empty
	   .$body.$t.'int '.$es.'main()'.$end
	   .$body.'{'.$end
	   .$body.$t.'    int '.$es.'num = '.$l.'50'.$es.';'.$end
	   .$body.$t.'    int '.$es.'*ptr = &amp;num;'.$end
	   .$body.'    changeVal(ptr);'.$end
	   .$body.'    std::cout &lt;&lt; *ptr &lt;&lt; std::endl;'.$end
	   .$body.'}'.$end;

	$code["Arrays1"] = 
		$body.$t.'int '.$es.'arrayVar[] = {'.$l.'100,200,300,400'.$es.'};'.$end;
		
	$raw["Arrays1"] = 
		'int arrayVar[] = {100,200,300,400}; \\n';
		
	$code["Arrays2"] = 
		$body.$t.'double '.$es.'arrayVar[5];'.$end;
		
	$raw["Arrays2"] = 
		'double arrayVar[5]; \\n';
		
	$code["Arrays3"] = 
		$body.$t.'int '.$es.'arrayVar[4] = {'.$l.'100,200,300,400'.$es.'};'.$end;
		
	$raw["Arrays3"] = 
		'int arrayVar[4] = {100,200,300,400}; \\n';
		
	$code["Arrays4"] = 
		$inc . '#include &lt;iostream&gt;'.$end
	   .$empty
	   .$body.$t.'int '.$es.'main()'.$end
	   .$body.'{'.$end
	   .$body.$t.'    int '.$es.'intArray[] = {'.$l.'1'.$es.','.$l.'2'.$es.','.$l.'3'.$es.'};'.$end
	   .$body.'    std::cout &lt;&lt; intarray['.$l.'0'.$es.'] &lt;&lt; '.$l.'" "'.$es.' &lt;&lt; intarray['.$l.'1'.$es.'] &lt;&lt; std::endl;'.$end
	   .$body.'}'.$end;
	   
	$raw["Arrays4"] = 
		'#include <iostream> \\n\\n'
	   .'int main() \\n'
	   .'{ \\n'
	   .'    int intArray[] = {1,2,3}; \\n'
	   .'    std::cout << intArray[0] << " " << intArray[1] << std::endl; \\n'
	   .'} \\n';
	   
	$code["Arrays5"] = 
		$inc . '#include &lt;iostream&gt;'.$end
	   .$empty
	   .$body.$t.'int '.$es.'main()'.$end
	   .$body.'{'.$end
	   .$body.$t.'    int '.$es.'intArray['.$l.'50'.$es.'];'.$end
	   .$body.$t.'    int '.$es.'used = '.$l.'0'.$es.';'.$end
	   .$body.$t.'    int '.$es.'input;'.$end
	   .$body.'    std::cout &lt;&lt; '.$l.'"Enter up to 50 non-negative integers. Enter negative num to stop.'.$e.'\n'.$es.'"'.$es.';'.$end
	   .$body.$k.'    for'.$es.'('.$t.'int '.$es.'i = '.$l.'0'.$es.'; i < '.$l.'50'.$es.'; ++i) {'.$end
	   .$body.'        std::cin &gt;&gt; input;'.$end
	   .$body.$k.'        if'.$es.'('.'input < '.$l.'0'.$es.')'.$end
	   .$body.$k.'            break'.$es.';'.$end
	   .$body.'        intArray[i] = input;'.$end
	   .$body.'        ++used;'.$end
	   .$body.'    }'.$end
	   .$empty
	   .$body.$k.'    for'.$es.'('.$t.'int '.$es.'i = '.$l.'0'.$es.'; i < used; ++i) {'.$end
	   .$body.'        std::cout &lt;&lt; '.$l.'"Number["'.$es.' &lt;&lt; i &lt;&lt; '.$l.'"]: "'.$es.' &lt;&lt; intArray[i] &lt;&lt; std::endl;'.$end
	   .$body.'    }'.$end
	   .$body.'}'.$end;
	   
	$raw["Arrays5"] = 
		'#include <iostream> \\n\\n'
	   .'int main() \\n'
	   .'{ \\n'
	   .'    int intArray[50]; \\n'
	   .'    int used = 0; \\n'
	   .'    int input; \\n'
	   .'    std::cout << "Enter up to 50 non-negative integers. Enter negative num to stop.\\\n"; \\n'
	   .'    for(int i = 0; i < 50; ++i) { \\n'
	   .'        std::cin >> input; \\n'
	   .'        if(input < 0) \\n'
	   .'            break; \\n'
	   .'        intArray[i] = input; \\n'
	   .'        ++used; \\n'
	   .'    } \\n\\n'
	   .'    for(int i = 0; i < used; ++i) { \\n'
	   .'        std::cout << "Number[" << i << "]: " << intArray[i] << std::endl; \\n'
	   .'    }'
	   .'} \\n';


	$code[2] =  $inc . '#include &lt;iostream&gt;										' . $end
			   .$body . '#include &lt;map&gt;												' . $end
			   .$body . '#include &lt;iterator&gt;											' . $end
			   .$empty
			   .$body . $t . 'int ' . $es . 'main(){								' . $end
			   .$body . '	map <int, int> myMap;											' . $end
			   .$body . '	// inserting elements into map									' . $end
			   .$body . '	myMap.insert (pair<int, int>(1, 5);								' . $end
			   .$body . '	myMap.insert (pair<int, int>(2, 4);								' . $end
			   .$body . '	myMap.insert (pair<int, int>(3, 3);								' . $end
			   .$body . '	myMap.insert (pair<int, int>(4, 2);								' . $end
			   .$body . '	myMap.insert (pair<int, int>(5, 1);								' . $end
			   .$empty
			   .$body . '	// printing myMap: 5, 4, 3, 2, 1								' . $end
			   .$body . '	myMap<int, int>::iterator itr;									' . $end
			   .$body . '	std::cout << "My map contains: ";								' . $end
			   .$empty
			   .$body . '   for(itr = myMap.begin(); itr != myMap.end(); ++itr){			' . $end
			   .$body . '		std::cout << \t << itr->first << \t itr->second <<		    ' . $end
			   .$body . '	}															    ' . $end
			   .$body . '	std::cout << std::endl;												' . $end 
			   .$body . $k . '    return ' . $es . $l . '0' . $es . ';' . $end
			   .$body . '}																	' . $end;
	
	$raw[2] =   '#include <iostream>											 \\n'
			   .'#include <map>													 \\n'
			   .'#include <iterator>										  \\n\\n'
			   .'int main(){													 \\n'
			   .'    map <int, int> myMap;									  \\n\\n'
			   .'	 // inserting elements into map								 \\n'
			   .'    myMap.insert (pair<int, int>(1, 5);						 \\n'
			   .'    myMap.insert (pair<int, int>(2, 4);						 \\n'
			   .'    myMap.insert (pair<int, int>(3, 3);						 \\n'
			   .'    myMap.insert (pair<int, int>(4, 2);						 \\n'
			   .'    myMap.insert (pair<int, int>(5, 1);					  \\n\\n'
			   .'	 // printing myMap: 5, 4, 3, 2, 1							 \\n'
			   .'	 myMap<int, int>::iterator itr;								 \\n'
			   .'    std::cout << "My map contains: "							 \\n'
			   .' 	 for(itr = myMap.begin(); itr != myMap.end(); ++itr){		 \\n'
			   .'	 	std::cout << \t << itr->first << \t itr->second << \n;   \\n'
			   .'	 }'
			   .'	 std::cout << std::endl;\\n'
			   .'    return 0;\\n'
	           .'}\\n';
			   
	$code[3] =  $inc . '#include &lt;iostream&gt;										   ' . $end
			   .$empty
			   .$body 	 . $t . 'int ' . $es . 'main(){								   ' . $end
			   .$body 	 . '	int SIZE = 5;												   ' . $end
			   .$body 	 . '	int myArray[SIZE] = {1, 2, 3, 4, 5};						   ' . $end
			   .$empty
			   .$body 	 . '	// printing myArray: 1, 2, 3, 4, 5							   ' . $end
			   .$body 	 . '	std::cout << "My array contains: ";							   ' . $end
			   .$empty
			   .$body 	 . '   for(int i = 0; itr != SIZE - 1; ++i){ 						   ' . $end
			   .$body 	 . '		std::cout <<  i << ", ";  								   ' . $end
			   .$body 	 . '	}															   ' . $end
			   .$body 	 . '	std::cout << std::endl;										   ' . $end 
			   .$body 	 . $k . '    return ' . $es . $l . '0' . $es . ';' . $end
			   .$body 	 . '}																   ' . $end;
	
	$raw[3] =   '#include <iostream>				     \\n\\n'
			   .'int main(){								\\n'
			   .'    int SIZE = 5;					     \\n\\n'
			   .'    int myArray[SIZE] = {1, 2, 3, 4, 5};   \\n'
			   .'	 // Printing myArray: 1, 2, 3, 4, 5     \\n'
			   .'    std::cout << "My array contains: "; 	\\n'
			   .'    for (int i = 0; i < SIZE - 1; ++i){ 	\\n'
			   .'    	std::cout << i << ", ";			 	\\n'
			   .'    }									 	\\n'
			   .'    std::cout << std::endl;			 	\\n'
			   .'    return 0;						     	\\n'
	           .'}										 	\\n';