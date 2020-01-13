class IncarnateAnalytics{
    static setup(){
        var tag = document.createElement('script');
        tag.src = "https://www.googletagmanager.com/gtag/js?id=" + IncarnateAnalyticsTag;
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        var tag2 = document.createElement('script');
        tag2.innerHTML = `
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '${IncarnateAnalyticsTag}');
        `;
        firstScriptTag.parentNode.insertBefore(tag2, firstScriptTag);
    }
}
if(IncarnateCookies.getCookie('policyAccept')=== 'true'){
    IncarnateAnalytics.setup();
}else{
    IncarnateHooks.on('policyAccept',IncarnateAnalytics.setup);
}
