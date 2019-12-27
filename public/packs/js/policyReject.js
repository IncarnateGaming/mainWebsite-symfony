class IncarnatePolicyReject{
     static deleteCookies(cookies,response){
        Object.keys(cookies).forEach(cookie=>{
            document.cookie = cookie + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        });
    }
    static async getCookieList(){
        const rawFetch = await fetch('/packs/json/cookies.json');
        const cookies = await rawFetch.json();
        return cookies;
    }
    static async removeCookies(){
        var response = document.createElement('div');
        if(document.cookie === ''){
            response.innerHTML = '<p>There are currently no Incarnate Cookies to delete.</p>';
        }else{
            response.innerHTML = '<p>At the start of this script the current Incarnate Cookies were: ' + document.cookie + '</p>';
            const cookieList = await IncarnatePolicyReject.getCookieList();
            IncarnatePolicyReject.deleteCookies(cookieList);
            if(document.cookie===''){
                response.innerHTML+= '<p>At the end of this script their were no Incarnate Cookies left.</p>';
            }else{
                response.innerHTML+= '<p>At the end of this script the Incarnate Cookies were: ' + document.cookie + '</p>';
            }
        }
        document.getElementById('postScriptInsert').innerHTML = response.innerHTML;
    }
}
var buttons = document.getElementsByClassName('incarnate-remove-cookies');
[].forEach.call(buttons, button=>{
    button.addEventListener('click',IncarnatePolicyReject.removeCookies);
})
