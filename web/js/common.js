(function(){

	var modal = $('#myModal'),
        pageP = 2,
        pageA = 2,
        pageH = 2,
        baseUrl = "/poem/web/";
    

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
            this.preventDef();
        },

        modalShow: function(){
            $('.bl-post').on('click', function(e){
                
                var jthis = $(this),
                    url = jthis.find('.btn-comment-poem').attr('href'),
                    id = jthis.find('.btn-comment-poem').data('id');
                    title = jthis.find('.poem-title').text(),
                    autor = jthis.find('.poem-autor').text(),
                    poem = null;
                
                $.ajax({
                    type: 'POST',
                    data: {'id': id},
                    url: baseUrl + 'api/show-poem',
                }).done(function(data){                    poem = data;

                    modal.find('.modal-title').text(title);
                    modal.find('.modal-poem').html(poem);
                    modal.find('.modal-autor').text(autor);
                    modal.find('.modal-link').attr('href', url);
                    app.changeLink(url);
                    modal.modal('show');
                });               
            });
        },

        showMore: function(){
            $('#btn-more').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = baseUrl + "api/poem-ajax-json?page="+pageP;
                $.ajax({
                    type: 'POST',
                    url: url,
                }).done(function(data){
                    console.log(data);

                    var source   = $("#entry-template").html();
                    var template = Handlebars.compile(source);
                    var html    = template(data);

                     $(html).insertBefore('#insert');
                     app.preventDef();
                });
                
            });
        },
        showMoreAnk: function(){
            $('#btn-more-ank').on('click', function(e){
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = baseUrl + "api/anekdot-ajax-json?page="+pageA;                
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
                var url = baseUrl +"api/hokky-ajax-json?page="+pageH;
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
                    url = baseUrl +"api/install-image",
                    data = new Object(),
                    path = baseUrl +'img/avatar/'+ $(e.target).data('image') +'.jpg';
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
                        url = baseUrl +'api/comment-poem-ajax';
                        break;
                    case 'hokky':
                        url = baseUrl +'api/comment-hokky-ajax';
                        break;
                    case 'anekdot':
                        url = baseUrl +'api/comment-anekdot-ajax';
                        break;
                }

                //console.log(url);
                var str = $(this).serialize(),
                    jthis = $(this),
                    idpost = jthis.data('id');                
                jthis.find('#commentBtn').attr('disabled','disabled');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: str,
                    success: function(data){
                        if(data === 'fail'){
                            //$('.msg').html("Произошла ошибка");
                            console.log('fail');
                            //jthis.find('#commentBtn').removeAttr('disabled');
                        }else{
                            console.log("добавил");
                            console.log(data);
                            //jthis.find('#commentBtn').removeAttr('disabled');
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

                setTimeout(function(){ jthis.find('#commentBtn').removeAttr('disabled'); }, 1000);
                //jthis.find('#commentBtn').removeAttr('disabled');
            });
        },

        commentDelete: function(){
            $('.daeleteBtn').on('click', function(e){
                e.preventDefault();

                var contr = $('.comment-tab').attr('id'),
                    url = baseUrl +'api/delete-comment-ajax',
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
                    url = baseUrl +'api/show-comment-ajax',
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
                            //obj = jQuery.parseJSON(data);
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

                         $(html).insertBefore('#insertComment');

                         app.commentDelete();
                    }

                });
            });
        },

        changeCountComment: function(inc){
            //console.log('dsgsdg');

            var current = $('.current'),
                all = $('.count-all');

            current.text(+current.text()+inc);
            all.text(+all.text()+inc);
        },

        preventDef: function(){
            $('.btn-comment-poem').on('click', function(e){
                e.preventDefault();
            });
        },

    };



    app.init();
}());