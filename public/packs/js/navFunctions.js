let incScrolling = false;
let incLastKnownScroll = 0;
class NavFunctions{
    static hideNav(){
        document.getElementById('navbar').style.top='-4rem';
    }
    static showNav(){
        document.getElementById('navbar').style.top='0';
    }
    static hideTop(){
        document.getElementById('topButton').style.display='none';
    }
    static showTop(){
        document.getElementById('topButton').style.display='inline-block';
    }
    static changeNavOnScroll(ev){
        if(incScrolling === true){
            return true;
        }
        incScrolling = true;
        if(incLastKnownScroll<window.scrollY){
            NavFunctions.hideNav();
        }else{
            NavFunctions.showNav();
            if(window.scrollY>2000){
                NavFunctions.showTop();
            }else{
                NavFunctions.hideTop();
            }
        }
        incLastKnownScroll = window.scrollY;
        IncarnateReference.incarnateDelay(300).then(result =>{incScrolling=false});
    }
    static toTop(){
        window.scrollTo(0,0);
    }
}
class IncarnateReference{
    static incarnateDelay(ms){
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    static crossReference(event){
        const parent = event.srcElement.getAttribute('data-fidparent');
        const reference = event.srcElement.getAttribute('data-fid');
        const crossReference = parent !== '' ? parent+'#' + reference : reference;
        window.location.href = '/content/fid/'+crossReference;
    }
}
window.addEventListener('scroll',NavFunctions.changeNavOnScroll);
document.getElementById('topButton').addEventListener('click',NavFunctions.toTop);
NavFunctions.hideTop();
const crossReferences = document.getElementsByClassName('crossReference');
[].forEach.call(crossReferences,reference=>{
    reference.addEventListener('click',IncarnateReference.crossReference);
});