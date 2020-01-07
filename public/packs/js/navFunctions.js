let incScrolling = false;
let incLastKnownScroll = 0;
class NavFunctions{
    static hideNav(){
        document.getElementById('navbar').style.top='-10rem';
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
        if(incLastKnownScroll<window.scrollY && window.scrollY>500){
            NavFunctions.hideNav();
        }else{
            NavFunctions.showNav();
            if(window.scrollY>500){
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
        console.log(event);
        const parent = event.target.getAttribute('data-fidparent');
        const reference = event.target.getAttribute('data-fid');
        console.log(reference);
        const crossReference = (parent !== null && parent !== "") ? parent+'#' + reference : reference;
        window.location.href = '/content/fid/'+crossReference;
    }
}
window.addEventListener('scroll',NavFunctions.changeNavOnScroll);
document.getElementById('topButton').addEventListener('click',NavFunctions.toTop);
NavFunctions.hideTop();
