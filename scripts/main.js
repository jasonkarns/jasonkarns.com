jQuery(function($){
  $('a.email').text(function(index, text){
    return text.replace(/\[at\]/gi, '@').replace(/\[dot\]/gi, '.');
  });
});
