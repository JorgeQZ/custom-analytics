$ = jQuery;

/**
 * Bucle de IDs de videos de youtube
 * Descripcion: Para hacer el track del tiempo en vistas de videos, se debe obtener los
 * minutos de reproducción de cada video
 */
let videos_loaded = $('.expo-video');
let videos_items = [];
let item_data;

videos_loaded.each(function (index, item) {
    item_data = { 'yt_ID': $(item).attr('data-yt-id'), 'vid_ID': $(item).attr('id') }
    videos_items.push(item_data)
});

let player_videos = [];
function onYouTubeIframeAPIReady() {
    videos_items.forEach(function (item, index) {
        player_videos[item.yt_ID] = new YT.Player(item.vid_ID, {
            height: '350',
            videoId: item.yt_ID,
            autoplay: 0,
            color: 'white',
            rel: 0,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        })
    });
}

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