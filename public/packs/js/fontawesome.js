class IncarnateFontAwesome{
    static setup(){
        var tag = document.createElement('script');
        tag.src = "https://kit.fontawesome.com/6f58c46118.js";
        tag.setAttribute('crossorigin','anonymous')
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
}
if(IncarnateCookies.getCookie('policyAccept')=== 'true'){
    IncarnateFontAwesome.setup();
}else{
    IncarnateHooks.on('policyAccept',IncarnateFontAwesome.setup);
}
