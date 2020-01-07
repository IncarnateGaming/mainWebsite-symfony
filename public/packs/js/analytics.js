class IncarnateAnalytics{
    static setup(){
        var tag = document.createElement('script');
        tag.src = "https://www.googletagmanager.com/gtag/js?id=UA-155417623-1";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        var tag2 = document.createElement('script');
        tag2.innerHTML = `
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-155417623-1');
        `;
        firstScriptTag.parentNode.insertBefore(tag2, firstScriptTag);
        // fetchInject([
        //     'https://www.googletagmanager.com/gtag/js?id=UA-155417623-1'
        // ]).then(() => {
        //     window.dataLayer = window.dataLayer || [];
        //     function gtag(){dataLayer.push(arguments);}
        //     gtag('js', new Date());
        //
        //     gtag('config', 'UA-155417623-1');
        // })
    }
}
if(IncarnateCookies.getCookie('policyAccept')=== 'true'){
    IncarnateAnalytics.setup();
}else{
    IncarnateHooks.on('policyAccept',IncarnateAnalytics.setup);
}
