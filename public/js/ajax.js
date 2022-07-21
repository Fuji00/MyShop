$(function() {
        /*
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        
        
        $('.like_button').on('click', function(event){
            //console.log('testjs');
            let id=$(event.target).data('id');//アイテムのIDを引っ張ってきて入れたい
            //let $do_like0=event.target.id;//$('#star6')
            //let $do_like=`$('#${event.target.id}')`;
            console.log(id);
            //console.log($do_like);
            console.log(`/items/${id}`);
            $.ajax({
                url:`/items/${id}`,//`${location.protocol}//${location.host}/${$(event.target).data('id')}`,// `"/items/${id}"`,
                type: 'post',
                async: true,     
                dataType: 'json',
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //data: {このデータをデータベースに入れたりも出来る
                //  uid: 100,
                //  subject: "テストタイトル",
                //  from: "テストfrom",
                //  body: "テストbody",
                //   
                //},
            }).done(function(res) {
                console.log(res);
                if (res.liked) {
                    console.log('ue');
                    //$do_like.html('★');
                    $(event.target).html('★');
                    message = 'いいねしました';
                } else {
                    console.log('sita');
                    //$do_like.html('☆');
                    $(event.target).html('☆');
                    message = 'いいねを取り消しました';
                }
                
                if ($('.container').find('.success').length) {
                    $('.container .success').html(message);
                } else {
                    $('.container').prepend(`<div class="success">${message}</div>`);
                }
                
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown.message);
                console.log("URL            : " . url);
            });
            
        });
    
    
    
    
    
    
    
    /*
        function ajatest(ids){
            //console.log('testjs');
            let id=ids;//アイテムのID
            let $do_like=$('#star');
            console.log(id);
            $.ajax({
                url: "/items/"+id,
                type: 'post',
                async: true,     
                dataType: 'json',
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //data: {このデータをデータベースに入れたりも出来る
                //  uid: 100,
                //  subject: "テストタイトル",
                //  from: "テストfrom",
                //  body: "テストbody",
                //   
                //},
            }).done(function(res) {
                console.log(res);
                if (res.liked) {
                    console.log('ue');
                    $do_like.html('★');
                } else {
                    console.log('sita');
                    $do_like.html('☆');
                }
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown.message);
                //console.log("URL            : " + url);
            });
            
        }
        
        */
        
    
});