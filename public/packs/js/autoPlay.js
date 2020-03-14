class IncarnateAutoplay{
    constructor(toggleClass) {
        this.autoplay = true;
        var items = [];
        const audio = document.getElementsByTagName('audio');
        items = items.concat(Array.from(audio));
        const video = document.getElementsByTagName('video');
        items = items.concat(Array.from(video));
        this.items = items;
        items.forEach(item=>{
            item.addEventListener('ended',this.endPlay);
            item.loop = false;
        });
        const toggles = document.getElementsByClassName(toggleClass);
        [].forEach.call(toggles, toggle=>{
            toggle.addEventListener('click',this.toggleAutoplay);
        })
    }
    async endPlay(ev){
        if (incarnateAutoplay.autoplay){
            const source = ev.target.getElementsByTagName('source')[0].getAttribute('src');
            const itemLen = incarnateAutoplay.items.length;
            for (var a=0; a<itemLen; a++){
                if(source === incarnateAutoplay.items[a].getElementsByTagName('source')[0].getAttribute('src')){
                    const nextElement = a < itemLen-1 ? a+1 : 0;
                    incarnateAutoplay.items[nextElement].play();
                    await IncarnateReference.incarnateDelay(100);
                    incarnateAutoplay.items[a].pause();
                    break;
                }
            }
        }
    }
    toggleAutoplay(ev){
        if(incarnateAutoplay.autoplay){
            incarnateAutoplay.autoplay = false;
            ev.target.innerHTML = 'Turn Next Song Autoplay On';
        }else{
            incarnateAutoplay.autoplay = true;
            ev.target.innerHTML = 'Turn Next Song Autoplay Off';
        }
    }
}
const incarnateAutoplay = new IncarnateAutoplay('inc-autoplay-toggle');
