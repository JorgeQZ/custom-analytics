$ = jQuery;

// The API will call this function when the video player is ready.
function onPlayerReady(event) {
    // console.log(event.target);
}

// The API calls this function when the player's state changes.
// The function indicates that when playing a video (state=1),
// the player should play for six seconds and then stop.
var done = false;
let currentYtID;
function onPlayerStateChange(event) {
    console.log('cambio de estado');
    currentYtID = $(event.target.g).attr('id');
    if (!isVideoOnLocalStorage(currentYtID) || isVideoOnLocalStorage(currentYtID) === null) {
        // createLocalStorageItem(currentYtID)
    }

    if (event.data == YT.PlayerState.PLAYING) {
        console.log('init', performance.now());

    }

    if (event.data == YT.PlayerState.PAUSED) {
        console.log('end', performance.now());

    }
}
function recordingVideo(init) {
    console.log(init + 1000);
}

/**
 * Local Storage para guardar la reproducción de un video
 */

function isVideoOnLocalStorage(video_id) {
    return localStorage.getItem(video_id);
}

function createLocalStorageItem(video_id, time) {
    localStorage.setItem(video_id, time);
}

function labnolIframe(div) {

    console.log(div);
    var iframe = document.createElement('iframe');
    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + $(div).attr('data-yt-id') + '?autoplay=0&rel=0&enablejsapi=1&color=white');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '1');
    iframe.setAttribute('allow', 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture');
    div.parentNode.replaceChild(iframe, div);

    let player = new YT.Player($(div).attr('data-video-id'), {
        height: '350',
        videoId: $(div).attr('data-yt-id'),
        autoplay: 0,
        color: 'white',
        rel: 0,
        events: {
            // 'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    })
}

function initYouTubeVideos() {
    var playerElements = document.getElementsByClassName('expo-video');
    for (var n = 0; n < playerElements.length; n++) {
        var ytID = $(playerElements[n]).attr('data-yt-id');
        var videoId = $(playerElements[n]).attr('id');
        var div = document.createElement('div');
        div.setAttribute('data-yt-id', ytID);
        div.setAttribute('data-video-id', videoId);
        var thumbNode = document.createElement('img');
        thumbNode.src = '//i.ytimg.com/vi/ID/maxresdefault.jpg'.replace('ID', ytID);
        div.appendChild(thumbNode);
        var playButton = document.createElement('div');
        playButton.setAttribute('class', 'play');
        div.appendChild(playButton);
        div.onclick = function () {
            labnolIframe(this);
        };
        playerElements[n].appendChild(div);
    }
}

document.addEventListener('DOMContentLoaded', initYouTubeVideos);