const htmlTop = document.getElementById('inc-top-html');
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
        [].forEach.call(IncarnateMobile.getBanners(), banner=>{
            banner.style.flexDirection='row';
        });
    }
    static orientVertical(){
        htmlTop.style.fontSize = '2vh';
        [].forEach.call(IncarnateMobile.getBanners(), banner=>{
            banner.style.flexDirection='column';
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
