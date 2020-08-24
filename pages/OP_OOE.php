<?php
    
    session_start();

	$article = "OpPrec and OrdOfEval";
	require_once("../inc/header.inc.php"); 
?>
	<title><?php echo $headerData["Title"]; ?></title>
	<meta name="description" content="<?php echo $headerData["Description"]; ?>">

</head>
<body>
	
	<?php require_once("../inc/navbar.inc.php"); ?>
	
	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div id="article" class="col-12">
					<h2 class="heading mt-3 text-center">Does Operator Precedence Determine Order of Evaluation?</h2>
					<p class="pre mt-3"><!--   
				  -->  Creation Date: 22/JUN/2020
<!--              -->  Edit Date:     10/JUL/2020<!--
			     --></p>
					<br>
					<div class="exBoxYellow">
						<p class="yellow exBoxTitle text-center mt-3">Prerequisites</p>
						<ul>
							<li>
								Truth tables for <span class="yellow">logical AND (&amp;&amp;)</span> and <span class="yellow">logical OR (||)</span>
							</li>
							<br>
							<li>
								<span class="yellow">PEMDAS</span> or <span class="yellow">BEDMAS</span> - Basic mathematical order of operations
								<ol class="numberedList">
									<li>Parenthesis</li>
									<li>Exponents</li>
									<li>Multiplication/Division</li>
									<li>Addition/Subtraction</li>
								</ol>
							</li>
							<li>
								<span class="yellow">Recall</span>: Whichever operator is furthest left gets evaluated first for 
								Multiplication/Division and Addition/Subtraction<br>[e.g. <span class="co-m">2</span><span class="co-y"> / </span> 
								<span class="co-m">4</span><span class="co-y"> * </span><span class="co-m">5</span><span class="co-y"> / </span><span class="co-m">20</span> is parsed as 
								((<span class="co-m">2</span><span class="co-y"> / </span> <span class="co-m">4</span>)<span class="co-y"> * </span><span class="co-m">5</span>)
								<span class="co-y"> / </span><span class="co-m">20</span>]
							</li>
						</ul>
					</div>
					<br>
					<div class="exBoxCyan">
						<p class="cyan exBoxTitle text-center mt-3">Terms and Definitions</p>
						<ul>
							<li>
								<span class="cyan">Short-Circuit Evaluation</span> - 
								If the left-hand side of a boolean expression determines the outcome, the right-hand side isn't evaluated
							</li>
							<br>
							<li>
								<span class="cyan">Operator</span> - A symbol or keyword denoting an operation, such as 
								<span class="co-y">+</span> (addition), <span class="co-y">++</span> (prefix increment), 
								<span class="co-y">new</span> (dynamic memory allocation)
							</li>
							<br>
							<li>
								<span class="cyan">Unary Operator</span> - An operator that takes one operand
							</li>
							<br>
							<li>
								<span class="cyan">Binary Operator</span> - An operator that takes two operands
							</li>
							<br>
							<li>
								<span class="cyan">Operand</span> - 
								An argument to an operator; An expression 
								<br>(e.g. <span class="co-m">A</span><span class="co-y"> + </span><span class="co-m">9</span>; <span class="co-m">A</span> 
								and <span class="co-m">9</span> are operands of the<span class="co-y"> + </span>operator)
							</li>
							<br>
							<li>
								<span class="cyan">Operator Precedence</span> - 
								Levels (that are derived from the grammar) indicating how operators are parsed 
								<br>[e.g. <span class="co-m">x</span><span class="co-y"> * </span><span class="co-m">y</span><span class="co-y"> + </span><span class="co-m">8</span>; 
								is parsed as (<span class="co-m">x</span><span class="co-y"> * </span><span class="co-m">y</span>)<span class="co-y"> + </span><span class="co-m">8</span>] 
								and operators with a lower precedence level have higher priority (see table below) [compile-time]
							</li>
							<br>
							<li>
								<span class="cyan">Associativity</span> - 
								The direction in which operators are parsed 
								<br>[e.g. <span class="co-m">x</span><span class="co-y"> = </span><span class="co-m">y</span> = <span class="co-m">z</span>
								<span class="co-y"> = </span><span class="co-m">2</span>; 
								is parsed as <span class="co-m">x</span> <span class="co-y">=</span> (<span class="co-m">y</span> <span class="co-y">=</span> 
								(<span class="co-m">z</span> <span class="co-y">=</span> <span class="co-m">2</span>))] 
								since the assignment operator is parsed right-to-left [compile-time]
							</li>
							<br>
							<li>
								<span class="cyan">Order of Evaluation</span> - 
								The sequence that operator's operands are processed; 
								C++ has no specified sequence in most contexts <br>(e.g. <span class="co-m">A</span><span class="co-y">++ + ++</span><span class="co-m">B</span>; 
								the compiler can choose either <span class="co-m">A</span><span class="co-y">++</span> or <span class="co-y">++</span><span class="co-m">B </span>to be evaluated first) [runtime]
							</li>
							<br>
							<li>
								<span class="cyan">LHS / lhs</span> - 
								Left-hand side (left operand of operator)
							</li>
							<br>
							<li>
								<span class="cyan">RHS / rhs</span> - 
								Right-hand side (right operand of operator)
							</li>
						</ul>
					</div>
					<br>
					<br>
					<br>
					<h3 class="heading ml-4">C++ Table of Operator Precedence</h3>
					<hr style="border-color: #002664;">
					<p class="text-justify ml-2 mr-2">
						First and foremost, we need to see how C++ orders its operators. Below are all the current operators, 
						but visit cppreference.com for complete details at   
						<a href="https://en.cppreference.com/w/cpp/language/operator_precedence">C++ Operator Precedence</a>. 
						I will not be discussing all of the operators in this article save for the mathematical, logical, and increment operators.
						<span class="co-y">Please note</span>: The precedence level numbers aren't explicitly defined in the C++ standard. 
						They are a result of the grammar.
					</p>
					<div class="row justify-content-center">
						<div class="col-auto">
							<table class="table-dark table-responsive" id="precTable">
								<thead>
									<tr class="text-center">
										<th>Precedence</th>
										<th>Operator</th>
										<th>Description</th>
										<th>Associativity</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>::</td>
										<td>Scope resolution</td>
										<td rowspan="2" class="lasc">Left-to-right</td>
									</tr>
									<tr>
										<td>2</td>
										<td>
											var++ var--<br>
											<em>type</em>() <em>type</em>{}<br>
											function()<br>
											arrayVar[]<br>
											. ->
										</td>
										<td>
											Postfix increment/decrement<br>
											Functional cast<br>
											Function call<br>
											Subscript<br>
											Member access
										</td>
										
									</tr>
									<tr>
										<td>3</td>
										<td>
											++var --var<br>
											+var -var<br>
											! ~<br>
											(<em>type</em>)<br>
											*ptr<br>
											&amp;var<br>
											sizeof<br>
											new new[]<br>
											delete delete[]<br>
											co_await
										</td>
										<td>
											Prefix increment/decrement<br>
											Unary plus and minus<br>
											Logical NOT and bitwise NOT<br>
											C-style cast<br>
											Indirection (dereference)<br>
											Address-of<br>
											Size-of<br>
											Dynamic memory allocation<br>
											Dynamic memory deallocation<br>
											Await-expression
										</td>
										<td class="rasc">Right-to-left</td>
									</tr>
									<tr>
										<td>4</td>
										<td>.* &nbsp; ->*</td>
										<td>Pointer-to-member</td>
										<td rowspan="12" class="lasc">Left-to-right</td>
									</tr>
									<tr>
										<td>5</td>
										<td>
											lhs * rhs<br>
											num / denom<br>
											lhs % rhs
										</td>
										<td>
											Multiplication<br>
											Divsion<br>
											Remainder
										</td>

									</tr>
									<tr>
										<td>6</td>
										<td>
											lhs + rhs<br>
											lhs - rhs
										</td>
										<td>
											Addition<br>
											Subtraction
										</td>
										
									</tr>
									<tr>
										<td>7</td>
										<td>
											&lt;&lt;<br>
											&gt;&gt;
										</td>
										<td>
											Bitwise left shift<br>
											Bitwise right shift
										</td>
					
									</tr>
									<tr>
										<td>8</td>
										<td>&lt;=&gt;</td>
										<td>Three-way comparison</td>
										
									</tr>
									<tr>
										<td>9</td>
										<td>
											&lt; &nbsp; &lt;=<br>
											&gt; &nbsp; &gt;=
										</td>
										<td>
											Relational operators
										</td>
										
									</tr>
									<tr>
										<td>10</td>
										<td>== &nbsp; !=</td>
										<td>Relational operators</td>
										
									</tr>
									<tr>
										<td>11</td>
										<td>&amp;</td>
										<td>Bitwise AND</td>
										
									</tr>
									<tr>
										<td>12</td>
										<td>^</td>
										<td>Bitwise XOR</td>
										
									</tr>
									<tr>
										<td>13</td>
										<td>|</td>
										<td>Bitwise OR</td>
										
									</tr>
									<tr>
										<td>14</td>
										<td>&amp;&amp;</td>
										<td>Logical AND</td>
										
									</tr>
									<tr>
										<td>15</td>
										<td>||</td>
										<td>Logical OR</td>
										
									</tr>
									<tr>
										<td>16</td>
										<td>
											a ? b : c<br>
											throw<br>
											co_yield<br>
											=<br>
											+= &nbsp; -=<br>
											*= &nbsp; /= &nbsp; %=<br>
											&lt;&lt;= &nbsp; &gt;&gt;=<br>
											&amp;= &nbsp; ^= &nbsp; |=
										</td>
										<td>
											Ternary conditional<br>
											Throw operator<br>
											Yield-expression<br>
											Direct assignment<br>
											Compound Assignments<br>
											<br>
											<br>
											<br>
										</td>
										<td class="rasc">Right-to-left</td>
									</tr>
									<tr>
										<td>17</td>
										<td>,</td>
										<td>Comma</td>
										<td class="lasc">Left-to-right</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<br>
					<h3 class="heading ml-4">Four Basic Mathematic Operations</h3>
					<hr style="border-color: #002664;">
					<p class="text-justify ml-2 mr-2">
						Let's start with something all of us should be familiar with. The four mathematical operations:
						addition, subtraction, multiplication, and division. We know that addition and subtraction
						have the same precedence <span class="co-y">(level 6)</span> and multiplication and division have 
						the same precedence <span class="co-y">(level 5)</span>. Therefore, multiplication and divsion must 
						come before addition and subtraction since the lower the level ensures a higher priority.
						Let's start off with a simple snippet of code:
					</p>
					<div class="exBoxPurple">
						<figure class="code">
							<pre><table class="table borderless my-auto">
<!--                         --><tr>
<!--                             --><td><pre class="co-o">1
<!--                                  -->2
<!--                             --></pre></td>
<!--                             --><td><pre class="co-g"><span class="co-c">double</span> x = <span class="co-m">2.0</span>, y = <span class="co-m">4.0</span>, z = <span class="co-m">5.0</span>;
<!--                                 -->std::cout &lt;&lt; x <span class="co-y">/</span> y <span class="co-y">+</span> z <span class="co-y">/</span> 20.0;
<!--                                 --></pre></td>
<!--                         --></tr></table></pre>
							<p class="ml-2 mb-2">OUTPUT: 0.75</p>
						</figure>
					</div>
					<p class="text-justify ml-2 mr-2 mt-3">
						The output is 
						<span class="co-m highlight">0.75</span> or 
						<span class="co-m highlight">3/4</span>. Division, multiplication, and addition have left-to-right associativity, so 
						<span class="green highlight">x <span class="co-y">/</span> y</span> are grouped together and 
						<span class="green highlight">z <span class="co-y">/</span> 20.0</span> are grouped together and are both evaluated before addition with a result of 
						<span class="co-m highlight">1/2</span> and
						<span class="co-m highlight">1<span class="co-y">/</span>4</span> respectively. Therefore, our expression can be written as
						<span class="green highlight">(x <span class="co-y">/</span> y) <span class="co-y">+</span> (z <span class="co-y">/</span> 20.0)</span>. We see that the evaluated division expressions 
						become the operands of the addition operator. So, 
						<span class="green highlight">1<span class="co-y">/</span>2 <span class="co-y">+</span> 1<span class="co-y">/</span>4 <span class="co-y">=</span> 3<span class="co-y">/</span>4</span> or 
						<span class="co-m highlight">0.75</span>. This calculates exactly as expected. Now, notice I didn't specify whether 
						<span class="green highlight">x <span class="co-y">/</span> y</span> or 
						<span class="green highlight">z <span class="co-y">/</span> 20.0</span> is evaluated first. If division has left-to-right associativity, then surely
						<span class="green highlight">x <span class="co-y">/</span> y</span> is the logical choice. Well, this may not be the case!
					</p>
					<br>
					<br>
					<h3 class="heading ml-4">A Deeper Look at Order of Evaluation</h3>
					<hr style="border-color: #002664;">
					<p class="text-justify ml-2 mr-2">
						Now, let's look at an example that involves addition where both operands are variables and 
						both operands are incremented.
					</p>
					<div class="exBoxPurple">
						<figure class="code">
							<pre><table class="table borderless my-auto">
<!--                     --><tr>
<!--                         --><td><pre class="co-o">1
<!--	                       -->2
<!--	                       -->3
<!--	                     --></pre></td>
<!--	                     --><td><pre class="co-g"><span class="co-c">int</span> lhs = <span class="co-m">1</span>, rhs = <span class="co-m">2</span>;
<!--	                         --><span class="co-c">int</span> output = <span class="co-y">++</span>lhs <span class="co-y">+</span> rhs<span class="co-y">++</span>;
<!--	     	                 -->std::cout &lt;&lt; output;
<!--	     	                 --></pre></td>
<!--	      	           --></tr></table></pre>
							<p class="ml-2 mb-2">OUTPUT: 4</p>
						</figure>
					</div>
					<p class="text-justify ml-2 mr-2 mt-3">
						So, the postfix increment operator <span class="co-y">(level 2)</span> has a higher priority than the prefix increment operator 
						<span class="co-y">(level 3)</span>. 
						Since the unary operators are separated by addition, our expression can be written as 
						<span class="green highlight">(<span class="co-y">++</span>lhs) 
						<span class="co-y">+</span> (rhs<span class="co-y">++</span>)</span>.
						I have compiled this code snippet down to the assembly version (no optimizations) with 
						<span class="green highlight">g++ (Debian 8.3.0-6) 8.3.0</span>. On a terminal, the command looks like 
						<span class="green highlight">g++ -S program.cpp</span>. This produces a .s file with the same name as your program, 
						so in this case it will produce 
						<span class="green highlight">program.s</span>. 
					</p>
					<ul class="indent-list">
						<li><span class="co-y">Note</span>: The assembly syntax is AT&amp;T, 
							<span class="green highlight">mnemonic source, destination</span>.
						</li>
					</ul>
					<p class="text-justify ml-2 mr-2">
						Inspecting this file in a text editor, you'll come across the assembly code below.
						Don't worry if you can't understand assembly as I wrote comments for each line.
					</p>
					<div class="exBoxPurple">
						<figure class="code">
							<pre><table class="table borderless my-auto">
<!--	                 --><tr>
<!--	                     --><td><pre class="co-o">1
<!--        	                 -->2
<!--            	             -->3
<!--                	         -->4
<!--	                         -->5
<!--    	                     -->6
<!--        	                 -->7
<!--            	             -->8
<!--                	         -->9
<!--    	                 --></pre></td>
<!--        	             --><td><pre class="co-g">movl  <span class="co-c">$</span><span class="co-m">1</span>, -<span class="co-m">4</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>    <span class="co-w">/* Assign <span class="co-g">lhs</span> to <span class="co-m">1</span> on the stack */</span>
<!--                	         -->movl  <span class="co-c">$</span><span class="co-m">2</span>, -<span class="co-m">8</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>    <span class="co-w">/* Assign <span class="co-g">rhs</span> to <span class="co-m">2</span> on the stack */</span>
<!--	                         -->addl  <span class="co-c">$</span><span class="co-m">1</span>, -<span class="co-m">4</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>    <span class="co-w">/* Increment <span class="co-g">lhs</span> */</span>
<!--    	                     -->movl  -<span class="co-m">8</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>, <span class="co-c">%</span>eax  <span class="co-w">/* Put <span class="co-g">rhs</span> into register eax */</span>
<!--        	                 -->leal  <span class="co-m">1</span><span class="co-c">(%</span>rax<span class="co-c">)</span>, <span class="co-c">%</span>edx   <span class="co-w">/* Increment register rax (eax) and place result into register edx */</span>
<!--            	             -->movl  <span class="co-c">%</span>edx, -<span class="co-m">8</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>  <span class="co-w">/* Store register edx's value into <span class="co-g">rhs</span> on the stack */</span>
<!--                	         -->movl  -<span class="co-m">4</span><span class="co-c">(%</span>rbp<span class="co-c">)</span>, <span class="co-c">%</span>edx  <span class="co-w">/* Put <span class="co-g">lhs</span> into register edx */</span>
<!--                    	     -->addl  <span class="co-c">%</span>edx, <span class="co-c">%</span>eax      <span class="co-w">/* Add registers edx and eax and store result into eax */</span>
<!--                        	 -->movl  <span class="co-c">%</span>eax, -<span class="co-m">12</span><span class="co-c">(%</span>rbp<span class="co-c">)</span> <span class="co-w">/* Store register eax into <span class="co-g">output</span> on the stack */</span>
<!-- 	                        --></pre></td>
<!--	                 --></tr></table></pre>
						</figure>
					</div>
					<p class="text-justify ml-2 mr-2 mt-3">
					Look at line 3. The left-hand side was incremented before the right-hand side
					even though the right-hand side has the postfix operator. The right-hand side
					doesn't get incremented and placed back onto the stack until lines 5 and 6.  
					</p>
					<br>
					<br>
					<h3 class="heading ml-4">So, Why Did This Happen?</h3>
					<hr style="border-color: #002664;">
					<p class="text-justify ml-2 mr-2">
						Essentially, the purpose of operator precedence is to couple operators with operands. 
						Programmers do this when they surround expressions with parenthesis. They want an expression's
						operators and operands to be grouped together and calculated before being applied to other operators.
						However, there's no guarantee which operand is evaluated first.
						C++ does not have any specified order of evaluation when evaluating operands to mathematical operators.
						For example, an expression such as 
						<span class="green highlight"><span class="co-y">++</span>x 
						<span class="co-y">-</span> <span class="co-y">++</span>y 
						<span class="co-y">+</span> <span class="co-y">++</span>z</span>
						doesn't guarantee 
						<span class="green highlight"><span class="co-y">++</span>x</span>
						to be evaluated first despite the prefix increment operator being left-to-right associative
						(read the next section to see when associativity is meaningful).
						In fact, 
						<span class="green highlight"><span class="co-y">++</span>x</span>,
						<span class="green highlight"><span class="co-y">++</span>y</span>, or
						<span class="green highlight"><span class="co-y">++</span>z</span> could be evaluated first. However,
						the value of
						<span class="green highlight">(<span class="co-y">++</span>x 
						<span class="co-y">-</span> <span class="co-y">++</span>y)</span> 
						will be computed before being added to the value of 
						<span class="green highlight"><span class="co-y">++</span>z</span> due to the subtraction and 
						addition being on the same precedence level and having left-to-right associativity.
					</p>
					<ul class="indent-list">
						<li class="text-justify"><span class="co-y">Summary</span>: The operands of the subtraction and addition operators have no 
						specified order of evaluation at runtime, but the subtraction and addition operators adhear to left-to-right
						associativity during compile-time since subtraction and addition have the same precedence level
						</li>
					</ul>
					<br>
					<br>
					<h3 class="heading ml-4">Okay, Here's A Complex Example</h3>
					<hr style="border-color: #002664;">
					<p class="text-justify ml-2 mr-2">
						Let's combine several operators and really see operator precedence and associativity at work!
					</p>
					<div class="exBoxPurple">
						<figure class="code">
							<pre><table table class="table borderless my-auto">
<!--	                 --><tr>
<!--    	                 --><td><pre class="co-o">1
<!--        	                 -->2
<!--            	             -->3
<!--                	         -->4
<!--                    	     -->5
<!--	                     --></pre></td>
<!--    	                 --><td><pre class="co-g"><span class="co-c">int</span> lhs = <span class="co-m">1</span>, rhs = <span class="co-m">0</span>;
<!--        	                 --><span class="co-c">int</span> *ptr = <span class="co-y">&amp;</span>lhs;
<!--            	             --><span class="co-r">if</span>( lhs <span class="co-y">||</span> <span class="co-y">++*</span>ptr <span class="co-y">&amp;&amp; ++</span>rhs ) {
<!--                	         -->    std::cout &lt;&lt; <span class="co-m">&quot;lhs: &quot;</span> &lt;&lt; lhs &lt;&lt; <span class="co-m">&quot;, rhs: &quot;</span> &lt;&lt; rhs;
<!--                    	     -->}
<!-- 	                        --></pre></td>
<!--	                 --></tr></table></pre>
							<p class="ml-2 mb-2">OUTPUT: lhs: 1, rhs: 0</p>
						</figure>
					</div>
					<p class="text-justify ml-2 mr-2 mt-3">
						Maybe this isn't the output you expect. Let's parse the expression
						<span class="green highlight">lhs <span class="co-y">|| ++*</span>ptr 
						<span class="co-y">&amp;&amp; ++</span>rhs</span> using operator precedence and associativity to
						clarify what associativity really is.
					</p>
					<ul class="indent-list exFont">
						<li><span class="co-y">Level 3</span>: Prefix increment, Dereference (right-to-left)
							<ul>
								<li><span class="green highlight">lhs <span class="co-y">|| </span>
									(<span class="co-y">++</span>(<span class="co-y">*</span>ptr))
									<span class="co-y">&amp;&amp;</span> 
									(<span class="co-y">++</span>rhs)</span>
								</li>
							</ul>
						</li>
					</ul>
					<p class="text-justify ml-2 mr-2">
						I want to stress that right-to-left associativity does not mean that 
						<span class="green highlight"><span class="co-y">++</span>rhs</span> 
						is evaluated first. These operators are unary and associativity is important
						if a variable or object contains more than one unary operator. We see that with
						<span class="green highlight"><span class="co-y">++*</span>ptr</span>. Therefore, 
						<span class="green highlight">ptr</span> is dereferenced producing the value of 
						<span class="green highlight">lhs</span> followed by incrementing 
						<span class="green highlight">lhs</span>. The dereference operator is further right than
						the prefix increment operator and both of said operators are attached to the same variable.
					</p>
					<ul class="indent-list exFont">
						<li><span class="co-y">Level 14</span>: Logical AND (left-to-right)
							<ul>
								<li><span class="green highlight">lhs <span class="co-y">|| </span>
									((<span class="co-y">++</span>(<span class="co-y">*</span>ptr))
									<span class="co-y">&amp;&amp;</span> 
									(<span class="co-y">++</span>rhs))</span>
								</li>
							</ul>
						</li>
						<li><span class="co-y">Level 15</span>: Logical OR (left-to-right)
							<ul>
								<li><span class="green highlight">(lhs <span class="co-y">|| </span>
									((<span class="co-y">++</span>(<span class="co-y">*</span>ptr))
									<span class="co-y">&amp;&amp;</span> 
									(<span class="co-y">++</span>rhs)))</span>
								</li>
							</ul>
						</li>
					</ul>
					<p class="text-justify ml-2 mr-2">
						Take a look at the parenthesis when the logical AND is evaluated. This step makes 
						the logical AND expression the right-hand side of the logical OR expression! We now 
						must recall that logical AND and logical OR use short-circuit evaluation.
						Therefore, if
						<span class="green highlight">lhs</span> evaluates to true, then the right-hand side of the 
						logical OR expression isn't evaluated. In this example, 
						<span class="green highlight">lhs</span> is <span class="highlight co-m">1</span> and 
						<span class="highlight co-m">1</span> equates to <span class="highlight co-m">true</span>. 
						This is why no variable 
						has a change of state. Even though logical AND has a higher priority, that only means the 
						logical AND operator and its two operands are bound by parenthesis resuling in the aforementioned.
					</p>
					<br>
					<br>
					<div class="exBoxGreen">
						<p class="green exBoxTitle text-center mt-3">Key Points</p>
						<ul>
							<li>
								Operator Precedence does not affect Order of Evaluation
							</li>
							<li>
								Order of Evaluation of operands is largly unspecified and is a runtime concept.
								There are exceptions, such as the LHS of logical || and logical AND operators will
								be evaluated before the RHS (concept of short-circuit evalation)
							</li>
							<li>
								Operator Precedence is a compile-time concept and determines how the expression will be parsed.
								That is, the higher the priority (the lower the level number) the 
								closer its operands are bound to the operator
							</li>
							<li>
								Unary operators' associativity is used when at least two unary operators of the 
								same precedence level are attached to a single operand
							</li>
							<li>
								Binary operators' associativity is used when at least two binary operators of 
								the same precedence level are in the same expression
							</li>
						</ul>
					</div>
					<br>
					<br>
					<br>
					<h3 class="heading ml-4">Quiz</h3>
					<hr style="border-color: #002664;">
					<br>
					<br>
					<br>
					<h3 class="heading ml-4">Comments</h3>
					<hr style="border-color: #002664;">
					
					<?php
                        require_once("../inc/comments.inc.php");
						if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE) 
                        { 
							if($headerData['ArticleID'] != NULL)
								$actionString = "OP_OOE.php?ID=$headerData[ArticleID]";
							else
								$actionString = "OP_OOE.php"; 
					?>
							<form id="actionString" action="<?php echo $actionString; ?>" method="POST">
								<textarea class="form-control col-12 col-md-8 col-lg-6 commentEntry comment" name="comment"  placeholder="Enter Comment... 4096 max chars" maxlength="4096"></textarea>
								<input type="hidden" name="parentNum" value="NULL">
								<button type="submit" class="btn btnBlue btn-block col-3 col-lg-1 mt-2">Submit</button>
							</form>
					<?php
						}
						else 
							echo "<p style='font-size: 1.5rem;' class='kentYellow text-center'>Please sign in to comment. Thank you.</p>";
                        
                        /* Display comments */
                        if($headerData['ArticleID'] != NULL)
                            originalComments($headerData['ArticleID']);
					?>
					

					<br>
					<br>
					<br>
				</div> <!-- End Article -->
			</div>
		</div>
	</div>
	
	<?php
		require_once("../inc/footer.inc.php"); 
	?>
		
</body>
</html>

<script>
	$(document).ready(function() {
        $('.lasc').css('color','rgb(245, 239, 66)');
		$('.rasc').css('color','rgb(255, 255, 255)');
    });
</script>
<script src="../inc/comments.js"></script> 		