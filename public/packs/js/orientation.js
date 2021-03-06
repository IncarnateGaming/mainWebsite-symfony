const htmlTop = document.getElementById('inc-top-html');
var incarnateVertical = true;
class IncarnateOrientation{
    static sequentialOreientationChange(){
        htmlTop.classList.add('mobile');
        IncarnateOrientation.orientationChange();
    }
    static async orientationChange(){
        await IncarnateReference.incarnateDelay(200);
        if(window.innerHeight > window.innerWidth){
            IncarnateOrientation.orientVertical();
        }else if(window.innerHeight < window.innerWidth){
            IncarnateOrientation.orientHorizontal();
        }
    }
    static orientHorizontal(){
        incarnateVertical = false;
        htmlTop.classList.add('horizontal');
        htmlTop.classList.remove('vertical');
        if(screen.orientation.angle === 90 || screen.orientation.angle === 270){
            // htmlTop.style.fontSize='3vh';
        }
        [].forEach.call(IncarnateOrientation.getBanners(), banner=>{
            banner.classList.add('flex-row');
            banner.classList.remove('flex-column');
        });
    }
    static orientVertical(){
        incarnateVertical = true;
        htmlTop.classList.add('mobile');
        htmlTop.classList.remove('horizontal');
        htmlTop.classList.add('vertical');
        if(screen.orientation.angle ===0 || screen.orientation.angle===180) {
            // htmlTop.style.fontSize = '1.7vh';
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
window.addEventListener('orientationchange',IncarnateOrientation.sequentialOreientationChange);
window.addEventListener('resize',IncarnateOrientation.sequentialOreientationChange);
IncarnateOrientation.orientationChange();
