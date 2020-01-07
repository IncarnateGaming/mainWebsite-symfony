//setup youtube api
//define players
class IncarnateHome{
    static setup(){
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
    static onYouTubeIframeAPIReady() {
        player1 = new YT.Player('player1', {
            height: '390',
            width: '640',
            videoId: 'QWkwKu_7YAE',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player2 = new YT.Player('player2', {
            height: '390',
            width: '640',
            videoId: 'gLFPZWzFSnU',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player3 = new YT.Player('player3', {
            height: '390',
            width: '640',
            videoId: 'NtStFEBmJSw',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player4 = new YT.Player('player4', {
            height: '390',
            width: '640',
            videoId: 'yQAI4n4fAFE',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player5 = new YT.Player('player5', {
            height: '390',
            width: '640',
            videoId: 'e2UENR7pj0o',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player6 = new YT.Player('player6', {
            height: '390',
            width: '640',
            videoId: 'Tpq6IbhbeJA',
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
        player7 = new YT.Player('player7', {
            height: '390',
            width: '640',
            videoId: 'zKocfReRPuY',
            playerVars: { 'autoplay': 0, 'autohide':1, 'controls': 0 },
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': IncarnateHome.onPlayerStateChange
            }
        });
    }
    static onPlayerStateChange(event) {
        if (event.data === 1 || event.data === 3){
            carousel.carousel('pause');
        }else{
            carousel.carousel('cycle');
        }
    }
}
var player1, player2, player3, player4, player5, player6, player7;
const carousel = $('.carousel');
function onYouTubeIframeAPIReady(){
    IncarnateHome.onYouTubeIframeAPIReady();
}
if(IncarnateCookies.getCookie('policyAccept')=== 'true'){
    IncarnateHome.setup();
}else{
    IncarnateHooks.on('policyAccept',IncarnateHome.setup);
}
