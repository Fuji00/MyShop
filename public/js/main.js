window.addEventListener('load',function(){

    var dialog=document.getElementById('dialog');
    var yes=document.getElementById('yes');
    var no=document.getElementById('no');
    var dialog_flg=document.getElementById('flg');

    var delete_confirm=document.getElementById('delete_confirm');

    /*お知らせやエラー内容を表示する*/
    dialog_flg.addEventListener('click',function(){
        dialog.style.display='block';
    })

    /*削除するのかの確認*/
    delete_confirm.addEventListener('click',function(){
        delete_confirm.style.display="block";
    })

    yes.addEventListener('click',function(){
        delete_confirm.style.display='none';

    });
    no.addEventListener('click',function(){
        delete_confirm.style.display='none';

    });



/////////////////////////////////////////////

    function delete_alert(e){
        if(!window.confirm('本当に削除しますか？')){
            window.alert('キャンセルされました'); 
            return false;
        }
        document.deleteform.submit();

    }




    ////////////////////////////////////////////
    $('.show').click(()=>{
        $('.show').modaal({
            content_source: '#modal', // モーダルコンテンツのセレクタを指定
            fullscreen: true ,// フルスクリーンオプションを指定,
            is_locked: true,
        });
    })
   
    $('#confirm').click(() => {
        $('.show').modaal('close'); // モーダルを閉じる
    })
    
});