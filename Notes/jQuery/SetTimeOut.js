
$(document).ready(function(){ 
    setTimeout(function(){ 
        $('#dvData').fadeOut();}, 2000); 
});


// call it on a button click

$(document).ready(function() { 
    $("#btnFade").bind("click",function() {
      setTimeout(function() { 
        $('#dvData').fadeOut();}, 2000); 
  });
});

You can also use below alternative that is create a function and call it on click of button.

$(document).ready(function() { 
    $('#btnFade').bind('click', function() {
      FadeOut();
  }); 
  function FadeOut()
  {
     setTimeout(function() { 
        $('#dvData').fadeOut();}, 2000); 
  } 
});

As I mentioned earlier that with setTimeout(), 
you can also make a call to another function. 
Till now, we were writing a piece of code and 
that is ideal if your code is one line but when 
lines of code is more then it is better to create a 
separate function and call it in setTimeout().


$(document).ready(function() { 
    $('#btnFade').bind('click', function() {
      FadeOut();
  });
    
  function FadeOut()
  {
      setTimeout(function () { FadeDiv(); }, 2000);
  }
    
  function FadeDiv()
  {
    $('#dvData').fadeOut();
  } 

