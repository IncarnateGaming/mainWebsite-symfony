class IncarnateAnalytics{
    static setup(){
        fetchInject([
            'https://www.googletagmanager.com/gtag/js?id=UA-155417623-1'
        ]).then(() => {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-155417623-1');
        })
    }
}
if(IncarnateCookies.getCookie('policyAccept')!== 'true'){
    IncarnateAnalytics.setup();
}else{
    //TODO add policy accept hook
}
