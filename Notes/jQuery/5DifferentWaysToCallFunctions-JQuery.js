The Basic JavaScript Function

This is the simplest way to declare a function in JavaScript. 
Say for example, we want to write a simple function 
called multiply(x,y) which simply takes in two parameters x and y, 
does a simple x times y and returns the value. 
Here are a few ways you might go about doing exactly this

function multiply(x,y) {
     return (x * y);
}
console.log(multiply(2,2));
//output: 4

If you wanted a quick function to test something then maybe 
that’s the only occasion you would use this. 
It’s not good coding and doesn’t promote code reuse.

2. JavaScript functions for get/set 

If you need a private utility for getting/setting/deleting 
model values then you can declare a function as a 
variable like this. This could be useful for assigning 
a variable upon declaration calculated by a function.

function multiply(x,y) {
    return (x * y);
}
console.log(multiply(2,2));
//output: 4


3. Create your own jQuery function 

This is an awesome way to declare functions that can be used 
just like your regular jQuery functions, on your DOM elements! 
Rememeber jQuery.fn is just an alias for jQuery.prototype 
(which just saves us time when coding such jQuery.fn.init.prototype = jQuery.fn = $.fn as such).

jQuery.fn.extend({
    zigzag: function () {
        var text = $(this).text();
        var zigzagText = '';
        var toggle = true; //lower/uppper toggle
            $.each(text, function(i, nome) {
                zigzagText += (toggle) ? nome.toUpperCase() : nome.toLowerCase();
                toggle = (toggle) ? false : true;
            });
    return zigzagText;
    }
});

console.log($('#tagline').zigzag());
//output: #1 jQuErY BlOg fOr yOuR DaIlY NeWs, PlUgInS, tUtS/TiPs &amp; cOdE SnIpPeTs.

//chained example
console.log($('#tagline').zigzag().toLowerCase());
//output: #1 jquery blog for your daily news, plugins, tuts/tips &amp; code snippets

Don’t forget to return the element so that you can chain jQuery functions together.

4. Extend Existing jQuery Functions 

(or which either extend existing jQuery functions with extra 
functionality or creating your own functions that can 
be called using the jQuery namespace 
(usually, we use the $ sign to represent the jQuery namespace). 
In this example the $.fn.each function has been modified 
with custom behaviour.

(function($){

	// maintain a to the existing function
	var oldEachFn = $.fn.each;

	 $.fn.each = function() {

	     // original behavior - use function.apply to preserve context
	     var ret = oldEachFn.apply(this, arguments);
	     
	     // add custom behaviour
	     try {
	         // change background colour
	         $(this).css({'background-color':'orange'});
	         
	         // add a message
	         var msg = '<span style="float:left;font-size:24px;font-weight:bold">Danger high voltage!</span>';
	         $(this).prepend(msg);
	     }
	     catch(e) 
	     {
	         console.log(e);
	     }
	     
	     // preserve return value (probably the jQuery object...)
	     return ret;
	}

	// run the $.fn.each function as normal
	 $('p').each(function(i,v)
	{
	     console.log(i,v);
	});
	//output: all paragrahs on page now appear with orange background and high voltage!

	})(jQuery);


5. Functions in custom namespaces 

If your writing functions in a custom namespace you must 
declare them in this way. Extra functions can be added 
to the namespace you just need to add a comma after each 
one (except the last one!). If your unsure about 
namespacing see jQuery Function Namespacing in Plain English

JQUERY4U = {
	     multiply: function(x,y) {
	         return (x * y);
	     }
	}
	//function call
	 JQUERY4U.multiply(2,2);