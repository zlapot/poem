(function(){

	var modal = $('#myModal');
    var page = 2;
    /*
    $('#poem-form').submit(function(e){
        e.preventDefault();
        var str = $(this).serialize();
        console.log(str);
        $.ajax({
            type: "POST",
            url: "/poem/web/index.php?r=site%2Faddpoem",
            data: str,
            success: function(html){
                $('#ajaxreq').html(html);
            }
        });
        return false;
    });
    */

    var app = {
        init: function(){
            this.modalShow();
            this.showMore();
        },

        modalShow: function(){
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
        },

        showMore: function(){
            $('#btn-more').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/index.php?r=site%2Fpoemajax&page="+page;
                $.ajax({
                    type: "POST",
                    url: (url),
                    data: url,
                    success: function(html){
                        var json = jQuery.parseJSON(html);
                        var row = app.buildTree(json);

                        $('#main-container').append(row[0], row[1], row[2]);
                        
                        page++;
                        //TODO
                        if(json.lenght===9){
                            jthis.removeAttr('disabled');
                        }
                    }
                });
            });
        },

        createElem: function(tag, className, data){
            var el = document.createElement('div');
            if(data.lenght > 1){
                $(el).addClass(className)
                    .append(data);
            }else{
                $(el).addClass(className)
                    .html(data);
            }
            return el;
        },

        buildTree: function(jsonOb){
            var cont, row = [], col = [],
                createEl = app.createElem;
            console.log(jsonOb[0].autor);
            for(var i=0; i < jsonOb.length ;i++){
                col[i] = createEl('div', 'col-md-4 bl-post', 
                                        createEl('div', 'bl-poem', [
                                            createEl('div', 'poem-title', jsonOb[i].title),
                                            createEl('div', 'poem', jsonOb[i].poem),
                                            createEl('div', 'poem-autor', jsonOb[i].autor)]));
                                       
            }
            for(var i=0; i < jsonOb.length/3; i++ ){
                row[i] = createEl('div', 'row', [col[i*3+0], col[i*3+1], col[i*3+2]])
            }

            return row;            
        },

    };

    app.init();
}());