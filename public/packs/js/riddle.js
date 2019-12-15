class IncarnateRiddles{
    static showHide(elementId){
        const elem = document.getElementById(elementId);
        if (elem.style.display==='block'){
            elem.style.display = 'none';
        }else{
            elem.style.display = 'block';
        }
    }
    static showHideAnswer(){
        IncarnateRiddles.showHide('riddle-answer');
    }
    static redirectRandomRiddle(){
        window.location.href="/content/riddle/rand";
    }
}
document.getElementById('riddle-answer-button').addEventListener('click',IncarnateRiddles.showHideAnswer);
document.getElementById('random-riddle').addEventListener('click',IncarnateRiddles.redirectRandomRiddle);
