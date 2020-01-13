class IncaranteAjax{
    static setup(){
        if (typeof XMLHttpRequest === "undefined") {
            XMLHttpRequest = function () {
                try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
                catch (e) {}
                try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
                catch (e) {}
                try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                catch (e) {}
                throw new Error("This browser does not support XMLHttpRequest.");
            };
        }
    }
    static call(fileUrl){
        // Initialize the Ajax request
        var xhr = new XMLHttpRequest();
        xhr.open('get', fileUrl);

        // Track the state changes of the request
        xhr.onreadystatechange = function(){
            // Ready state 4 means the request is done
            if(xhr.readyState === 4){
                // 200 is a successful return
                if(xhr.status === 200){
                    return(xhr.responseText);
                }else{
                    console.warn('Error: '+xhr.status); // An error occurred during the request
                    return false;
                }
            }
        }
    }
}
IncaranteAjax.setup();