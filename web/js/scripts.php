<?php header("Content-type: application/javascript"); ?>


    setInterval(function(){
        $.get('/time', function(time) {
            $('#elapsedTime').text(time)
        })
    },1000)
