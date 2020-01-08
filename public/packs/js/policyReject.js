class IncarnatePolicyReject{
     static deleteCookies(cookies,response){
        Object.keys(cookies).forEach(cookie=>{
            document.cookie = cookie + '=; path=/; Domain=.incarnategamingllc.com; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
        });
        //TODO remove following line after february 7, 2020 that removes old policy accept cookie;
         document.cookie = 'policyAccept; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
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
    static checkCookies(){
         const response = document.createElement('p');
         if (document.cookie === ''){
             response.innerHTML = 'There are currently no Incarnate Cookies.';
         }else{
             response.innerHTML = '<strong>Your Incarnate Cookies are: </strong>' + document.cookie;
         }
         document.getElementById('check-cookie-results').innerHTML = response.outerHTML;
    }
}
document.getElementById('incarnate-remove-cookies').addEventListener('click',IncarnatePolicyReject.removeCookies);
document.getElementById('incarnate-check-cookies').addEventListener('click',IncarnatePolicyReject.checkCookies);
