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
            this.checkImg();
            this.commentAdd();
            this.commentDelete();
            this.commentShowMore();
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
        showMoreAnk: function(){
            $('#btn-more-ank').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/api/anekdot-ajax-json?page="+pageA;                
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

        checkImg: function(){
            $('.body-image').on('click', function(e){
                var jthis = $(this),
                    url = "/poem/web/api/install-image",
                    data = new Object(),
                    path = '/poem/web/img/avatar/'+ $(e.target).data('image') +'.jpg';
                data.img = $(e.target).data('image');
                if(data.img){
                    $.ajax({
                        type: 'POST',                    
                        data: data,
                        url: url,
                    }).done(function(data){
                        console.log(data);
                        if(data === "ok"){
                            $('.checked-img').removeClass('checked-img');
                            $(e.target).addClass('checked-img');
                            $('#error').html('Аватар успешно установлен!')
                            $('.profile-img').attr('src', path);
                        }else{
                            $('#error').html('Что-то пошло не так...');
                        }
                    });
                }
                
            });
        },
        
        commentAdd: function(){
            $('#comment-form').on('submit', function(e){
                e.preventDefault();

                var contr = $('.comment-tab').attr('id'),
                    url;
                switch(contr){
                    case 'poem':
                        url = '/poem/web/api/comment-poem-ajax';
                        break;
                    case 'hokky':
                        url = '/poem/web/api/comment-hokky-ajax';
                        break;
                    case 'anekdot':
                        url = '/poem/web/api/comment-anekdot-ajax';
                        break;
                }

                console.log(url);
                var str = $(this).serialize(),
                    jthis = $(this),
                    idpost = jthis.data('id');                
                //jthis.find('#commentBtn').attr('disabled','disabled');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: str,
                    success: function(data){
                        if(data === 'fail'){
                            //$('.msg').html("Произошла ошибка");
                            $('#commentBtn').removeAttr('disabled');
                        }else{
                            console.log("добавил");
                            console.log(data);
                            $('#commentBtn').removeAttr('disabled');
                            var source   = $("#entry-template").html();
                            var template = Handlebars.compile(source);
                            var html    = template(data);

                            
                            jthis.find('textarea').val('');
                            app.changeCountComment(1);
                            $(html).insertAfter('#insert');

                            app.commentDelete();
                        }
                    }
                });

            });
        },

        commentDelete: function(){
            $('.daeleteBtn').on('click', function(e){
                e.preventDefault();

                var contr = $('.comment-tab').attr('id'),
                    url = '/poem/web/api/delete-comment-ajax',
                    category;
                switch(contr){
                    case 'poem':
                        category = 'poem';
                        break;
                    case 'hokky':
                        category = 'hokky';
                        break;
                    case 'anekdot':
                        category = 'anekdot';
                        break;
                }

                console.log(url);
                var jthis = $(this),
                    idpost = jthis.data('id');                
                $(e.target).attr('disabled','disabled');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'category':category, 'id':idpost},
                    success: function(data){
                        if(data == 'ok'){
                            str = 'article[id="'+idpost+'"]';
                            app.changeCountComment(-1);
                            console.log("Удаляю");
                            $(str).remove();
                        }else{
                            //$('.msg').html("Произошла ошибка");
                        }
                    }
                });

            });
        },

        commentShowMore: function(){
            $('#btn-comment').on('click', function(e){

                var contr = $('.comment-tab').attr('id'),
                    url = '/poem/web/api/show-comment-ajax',
                    category;
                switch(contr){
                    case 'poem':
                        category = 'poem';
                        break;
                    case 'hokky':
                        category = 'hokky';
                        break;
                    case 'anekdot':
                        category = 'anekdot';
                        break;
                }

                var current = +$('.current').text(),
                    currentObj = $('.current'),
                    all = +$('.count-all').text(),
                    idPost = $('#comment-form').data('id');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'category':category, 'offset': current, 'idPost': idPost },
                    success: function(data){
                        if(data == 'fail'){
                            console.log("fail");                            
                        }else{
                            obj = jQuery.parseJSON(data);
                            console.log(data);
                            if (all-current > 10){
                                currentObj.text(current+10);                         
                            }else{
                                currentObj.text(all);
                                $('#btn-comment').attr('disabled','disabled'); 
                            }  
                        }
                        $('#commentBtn').removeAttr('disabled');
                        var source   = $("#entry-template").html(),
                            template = Handlebars.compile(source),
                            html    = template(data);

                         $(html).insertAfter('#insertComment');
                    }

                });
            });
        },

        changeCountComment: function(inc){
            console.log('dsgsdg');

            var current = $('.current'),
                all = $('.count-all');

            current.text(+current.text()+inc);
            all.text(+all.text()+inc);
        },

    };

    app.init();
}());