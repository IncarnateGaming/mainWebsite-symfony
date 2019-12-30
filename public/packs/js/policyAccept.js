var cookiePath = "";
class IncarnatePolicyAccept{
    static setup(){
        const twigVariables = document.getElementById('incarnate-twig-variables');
        cookiePath=twigVariables.getAttribute('data-cookies');
    }
    static setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + '; path=/';
    }
     static getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
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
        IncarnatePolicyAccept.setCookie('policyAccept','true',30);
        const policyBanners = document.getElementsByClassName('incarnate-policy-banner');
        [].forEach.call(policyBanners, banner=>{
            banner.remove();
        });
    }
    static rejectPolicy(){
        window.location.href='/policy/reject';
    }
    static goPolicy(){
        window.location.href='/policy/website';
    }
}
IncarnatePolicyAccept.setup();
if(IncarnatePolicyAccept.getCookie('policyAccept')!== 'true'){
    const body = document.getElementsByTagName('body')[0];
    body.append(IncarnatePolicyAccept.makeBanner());
}
