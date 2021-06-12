function reload_js(src) 
{
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
}