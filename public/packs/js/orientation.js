const htmlTop = document.getElementById('inc-top-html');
const incLogo = document.getElementById('incarnate-logo');
class IncarnateOrientation{
    static async orientationChange(){
        await IncarnateReference.incarnateDelay(50);
        if(window.innerHeight > window.innerWidth){
            IncarnateOrientation.orientVertical();
        }else if(window.innerHeight < window.innerWidth){
            IncarnateOrientation.orientHorizontal();
        }
    }
    static orientHorizontal(){
        incLogo.style.display='block';
        if(screen.orientation.angle === 90 || screen.orientation.angle === 270){
            htmlTop.style.fontSize='4vh';
        }
        [].forEach.call(IncarnateOrientation.getBanners(), banner=>{
            banner.classList.add('flex-row');
            banner.classList.remove('flex-column');
        });
    }
    static orientVertical(){
        incLogo.style.display = 'none';
        if(screen.orientation.angle ===0 || screen.orientation.angle===180) {
            htmlTop.style.fontSize = '2vh';
        }
        [].forEach.call(IncarnateOrientation.getBanners(), banner=>{
            banner.classList.add('flex-column');
            banner.classList.remove('flex-row');
        });
    }
    static getBanners(){
        return document.getElementsByClassName('incarnate-policy-banner');
    }
}
window.addEventListener('orientationchange',IncarnateOrientation.orientationChange);
IncarnateOrientation.orientationChange();
