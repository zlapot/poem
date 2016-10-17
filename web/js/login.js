(function(){

	var modalReset = $('#modalReset');
    
    var app = {
        init: function(){
            console.log("INIT");
            this.reg();
            
        },        
        
        reg: function(){
            $('#resetBtn').on('submit', function(e){
                e.preventDefault();
                var str = $(this).serialize();
                var jthis = $(this);
                jthis.attr('disabled','disabled');
                var url = "/poem/web/user/send-email-ajax";
                
                $.ajax({
                    type: "POST",
                    url: (url),
                    data: str,
                    success: function(html){
                            $('.msg').text(html);                        
                    }
                });
                return false;                
            });
        },

    };

    if(modalReset)
        app.init();
}());