class IncarnateSwipeHooks{
    static setup(){
        window.addEventListener('touchstart',IncarnateSwipeHooks.touchStart);
        window.addEventListener('touchend',IncarnateSwipeHooks.touchEnd);
    }
    static touchStart(ev){
        const touch = ev.targetTouches[0];
        IncarnateSwipeHooks.swipeXstart=touch.screenX;
        IncarnateSwipeHooks.swipeYstart=touch.screenY;
    }
    static touchEnd(ev){
        const touch = ev.changedTouches[0];
        if(touch.screenX > IncarnateSwipeHooks.swipeXstart){
            IncarnateHooks.callAll('swipeRight');
        }else if (touch.screenX < IncarnateSwipeHooks.swipeXstart){
            IncarnateHooks.callAll('swipeLeft');
        }
        if(touch.screenY > IncarnateSwipeHooks.swipeYstart){
            IncarnateHooks.callAll('swipeDown');
        }else if (touch.screenY < IncarnateSwipeHooks.swipeYstart){
            IncarnateHooks.callAll('swipeUp');
        }
    }
}
IncarnateSwipeHooks.swipeXstart=0;
IncarnateSwipeHooks.swipeYstart=0;
IncarnateSwipeHooks.setup();