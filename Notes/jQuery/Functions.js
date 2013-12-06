

FUNCTION DECLARATION
--------------------
function foo() { ... }

Because of FUNCTION HOISTING, 
the function declared this way can be called both 
after and before the definition.

FUNCTION EXPRESSION
-------------------


1 NAMED FUNCTION EXPRESSION

var foo = function bar() { ... }


2 ANONYMOUS FUNCTION EXPRESSION

var foo = function() { ... }

foo() can be called only after creation.

IMMEDIATELY-INVOKED FUNCTION EXPRESSION (IIFE)
-----------------------------------------------
(function() { ... }());

Conclusion?

Crockford recommends to use function expression 
because it makes it clear that foo is a variable 
containing a function value. 

Well, personally, I prefer to use Declaration 
unless there is a reason for Expression.