const htmlTop = document.getElementById('inc-top-html');
const incLogo = document.getElementById('incarnate-logo');
class IncarnateMobile{
    static orientationChange(){
        // console.log(screen.orientation.angle);
        if(screen.orientation.angle ===0 || screen.orientation.angle===180){
            IncarnateMobile.orientVertical();
        }else if(screen.orientation.angle ===90 || screen.orientation.angle === 270){
            IncarnateMobile.orientHorizontal();
        }
    }
    static orientHorizontal(){
        htmlTop.style.fontSize='4vh';
        incLogo.style.display='block';
        [].forEach.call(IncarnateMobile.getBanners(), banner=>{
            banner.classList.add('flex-row');
            banner.classList.remove('flex-column');
        });
    }
    static orientVertical(){
        htmlTop.style.fontSize = '2vh';
        incLogo.style.display='none';
        [].forEach.call(IncarnateMobile.getBanners(), banner=>{
            banner.classList.add('flex-column');
            banner.classList.remove('flex-row');
        });
    }
    static getBanners(){
        return document.getElementsByClassName('incarnate-policy-banner');
    }
}
window.addEventListener('orientationchange',IncarnateMobile.orientationChange);
if(screen.orientation.angle ===0 || screen.orientation.angle===180) {
    IncarnateMobile.orientVertical();
}
