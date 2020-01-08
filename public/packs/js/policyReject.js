class IncarnatePolicyReject{
     static deleteCookies(cookies,response){
        Object.keys(cookies).forEach(cookie=>{
            console.log(cookie);
            document.cookie = cookie + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        });
    }
    static async getCookieList(){
        // const rawFetch = await fetch('/packs/json/cookies.json');
        const cookies = 
            {
                "policyAccept":"Boolean",
                "REMEMBERME": "String",
                "PHPSESSID": "String",
                "_gat_gtag_UA_155417623_1": "Integer",
                "_gid": "String",
                "_ga": "String"
            };
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
