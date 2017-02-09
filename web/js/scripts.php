<?php header("Content-type: application/javascript"); ?>

$.getJSON('/time', function(data) {
    $.each(data, function(key, val) {
            $("#"+key).html("<div class='progress-bar' role='progressbar'  style='width: "+val+"%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>");
    });
});

    setInterval(function(){
        $.getJSON('/time', function(data) {
            $.each(data, function(key, val) {
                $("#"+key).html("<div class='progress-bar' role='progressbar'  style='width: "+val+"%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>");
            });
        });
    },1000)
