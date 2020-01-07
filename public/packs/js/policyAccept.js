var cookiePath = "";
class IncarnatePolicyAccept{
    static setup(){
        const twigVariables = document.getElementById('incarnate-twig-variables');
        cookiePath=twigVariables.getAttribute('data-cookies');
    }
    static makeBanner(){
        var banner = document.createElement('div');
        banner.setAttribute('class','incarnate-policy-banner d-flex flex-column');
        banner.innerHTML = `
            <p>We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.</p>
            <div class="d-flex flex-row">
                <button class="accept btn btn-secondary pb-1 m-1 inc-flex-grow">Ok</button>
                <button class="reject btn btn-secondary pb-1 m-1 inc-flex-grow">No</button>
            </div>
            <button class="policy btn btn-secondary pb-1 m-1">Privacy Policy</button>
        `;
        banner.getElementsByClassName('accept')[0].addEventListener('click',this.acceptPolicy);
        banner.getElementsByClassName('reject')[0].addEventListener('click',this.rejectPolicy);
        banner.getElementsByClassName('policy')[0].addEventListener('click',this.goPolicy);
        return banner;
    }
    static acceptPolicy(){
        const policyBanners = document.getElementsByClassName('incarnate-policy-banner');
        [].forEach.call(policyBanners, banner=>{
            banner.remove();
        });
        IncarnateCookies.setCookie('policyAccept','true',30);
        IncarnateHooks.callAll('policyAccept');
    }
    static rejectPolicy(){
        window.location.href='/policy/reject';
    }
    static goPolicy(){
        window.location.href='/policy/website';
    }
}
IncarnatePolicyAccept.setup();
if(IncarnateCookies.getCookie('policyAccept')!== 'true'){
    const body = document.getElementsByTagName('body')[0];
    body.append(IncarnatePolicyAccept.makeBanner());
}
