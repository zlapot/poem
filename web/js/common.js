(function(){

	var modal = $('#myModal');

    $('.bl-post').on('click', function(e){
    	var title,
    		poem,
    		autor;

    	var jthis = $(this);
    	title = jthis.find('.poem-title').text();
    	poem = jthis.find('.poem').html();
    	autor = jthis.find('.poem-autor').text();
    		 
    	modal.find('.modal-title').text(title);
    	modal.find('.modal-poem').html(poem);
    	modal.find('.modal-autor').text(autor);
    	console.log(title);
    	modal.modal('show');
    });
}());