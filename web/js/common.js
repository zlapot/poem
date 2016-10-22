(function(){

	var modal = $('#myModal');
    var pageP = 2,
        pageA = 2,
        pageH = 2;
    

    var app = {
        init: function(){
            this.modalShow();
            this.showMore();
            this.showMoreAnk();
            this.showMoreHok();
            this.initStyle();
            this.returnLink();
            this.switchStyle();
        },

        modalShow: function(){
            $('.bl-post').on('click', function(e){
                var title,
                    poem,
                    autor;

                var jthis = $(this);

                var url = jthis.find('.btn-comment').attr('href');

                title = jthis.find('.poem-title').text();
                poem = jthis.find('.poem-poem').html();
                autor = jthis.find('.poem-autor').text();
                     
                modal.find('.modal-title').text(title);
                modal.find('.modal-poem').html(poem);
                modal.find('.modal-autor').text(autor);
                modal.find('.modal-link').attr('href', url);
                console.log(url);
                app.changeLink(url);
                modal.modal('show');
            });
        },

        showMore: function(){
            $('#btn-more').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/api/poem-ajax-json?page="+pageP;
                data: url,
                $.ajax({
                    type: 'POST',
                    url: url,
                }).done(function(data){
                    //console.log(data);

                    var source   = $("#entry-template").html();
                    var template = Handlebars.compile(source);
                    var html    = template(data);

                     $(html).insertBefore('#insert');
                });
                
            });
        },
        showMoreAnk: function(){
            $('#btn-more-ank').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/api/anekdot-ajax-json?page="+pageA;
                data: url,
                $.ajax({
                    type: 'POST',
                    url: url,
                }).done(function(data){
                    console.log(data);

                    var source   = $("#entry-template").html();
                    var template = Handlebars.compile(source);
                    var html    = template(data);

                     $(html).insertBefore('#btn-more-ank');
                });
                
            });
        },
        showMoreHok: function(){
            $('#btn-more-hokky').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/api/hokky-ajax-json?page="+pageH;
                data: url,
                $.ajax({
                    type: 'POST',
                    url: url,
                }).done(function(data){
                    console.log(data);

                    var source   = $("#entry-template").html();
                    var template = Handlebars.compile(source);
                    var html    = template(data);

                     $(html).insertBefore('#insert');
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

        

        initStyle: function(){
            var title = $('title').text();
            console.log(title);
            switch (title){
                case 'Хокку':
                    $('body').addClass('jap-theme');
                    break;
                case 'Login':
                    $('body').addClass('login-theme');
                    break;
                default:
                    break;
            }
        },

        changeLink: function(url){
            if(url != window.location){
                window.history.pushState(null, null, url);
            }
        },

        returnLink: function(){
            $(modal).on('hidden.bs.modal', function (e) {
                window.history.replaceState(null, null, modal.data('link'));
                console.log("bugagaga");
            });
        },

        switchStyle: function(){
            $('#cssCheched').on('click', function(e){
                $('link[href*="common"]').attr('href', $(e.target).data('css'));                
            });
        },
        
    };

    app.init();
}());