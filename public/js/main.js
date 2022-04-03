    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var youtubePlayer = null;
    function onYouTubeIframeAPIReady() {
        youtubePlayer = new YT.Player('youtube', {
            videoId: '',
            fullsize: true,
            playerVars: {
                playsinline: 1,
                rel: 0,
                showinfo: 0
            },
            events: {



                'onStateChange': onPlayerStateChange
            }
        });
    }
    var playFlag = false;
    function onPlayerStateChange(event) {
        switch (event.data) {
        case YT.PlayerState.ENDED:
            if (playFlag) {
                playFlag = false;
                var index = $('.open-player').index($('.open-player.selected')) + 1;
                var next = $('.open-player').eq(index);
                $('.open-player').removeClass('selected');
                if ($('.auto-play input:checkbox').prop('checked') && next.length > 0) {
                    next.trigger('click');
                } else {
                    youtubePlayer.seekTo(youtubePlayer.getCurrentTime(), true);
                    youtubePlayer.playVideo();
                }
            }
            break;
        case YT.PlayerState.PLAYING:
            playFlag = true;
            break;
        case YT.PlayerState.PAUSED:
            break;
        case YT.PlayerState.BUFFERING:
            break;
        case YT.PlayerState.CUED:
            break;
        }
    }
    var recStart = null;
    var recList = {};
    var getYoutubeId = function(url) {
        var newval = '',
            videoId = '';
        if (newval = url.match(/(\?|&)v=([^&#]+)/)) {
            videoId = newval.pop();
        } else if (newval = url.match(/(\.be\/)+([^\/]+)/)) {
            videoId = newval.pop();
        } else if (newval = url.match(/(\embed\/)+([^\/]+)/)) {
            videoId = newval.pop().replace('?rel=0', '');
        }
        return videoId;
    };
    $(document).ready(function() {
        $(document)
        .on('click', '.open-player', function() {
            var buffer = 3;
            // var size = $('.video-size').val();
            var size = 'width=1280,height=720';
            var params = '';
            params = ($(this).attr('data-url') ? 'url=' + $(this).attr('data-url') + '&' : '') + params;
            params = ($(this).attr('data-fname') ? 'fname=' + $(this).attr('data-fname') + '&' : '') + params;
            params = ($(this).attr('data-end') ? 'end=' + $(this).attr('data-end') + '&' : '') + params;
            params = ($(this).attr('data-start') ? 'start=' + $(this).attr('data-start') + '&' : '') + params;
            youtubePlayer.loadVideoById({
                'videoId': getYoutubeId($(this).attr('data-url')),
                'startSeconds': Number($(this).attr('data-start')) - buffer,
                'endSeconds': Number($(this).attr('data-end')) + buffer
            });
            $('.player .iframe').show()
            .attr('data-src', '/capture-youtube?' + size.replace(',', '&') + '&' + params)
            .attr('data-url', $(this).attr('data-url'))
            .attr('data-fname', $(this).attr('data-fname'))
            .attr('data-start', $(this).attr('data-start'))
            .attr('data-end', $(this).attr('data-end'));
            $('.player').show();
            $('.open-player').removeClass('selected');
            $(this).addClass('selected');
            return false;
        })
        
        .on('click', '.close-player', function() {
            youtubePlayer.stopVideo();
            $('.player').hide();
            $('.open-player').removeClass('selected');
            return false;
        })

        $(window).on('load', function() {
            $('.open-player').removeClass('disabled');


        });
    });