document.ontouchmove = function(event){
    event.preventDefault();
    event.stopPropagation();
}
var sheep = {
    covers:['img/sheep-cut-cover.png',
            'img/sheep-2-cut-cover.png',
            'img/sheep-3-cut-cover.png'],
    bg:['img/sheep-cut-body.png','img/sheep-2-cut-body.png','img/sheep-3-cut-body.png'],
    total:10,
    timer:60,
    score:0        
}            
window.onload = function () {
    var lottery = new Lottery('lotteryContainer', sheep.covers[0], 'image', 300, 100, drawResult);
    lottery.init(sheep.bg[0], 'image');
    
    
    //var drawPercentNode = document.getElementById('drawPercent');
    //var scoreNode = document.getElementById('score');

    function drawResult(percent,score) {
        //drawPercentNode.innerHTML = percent + '%';
        //scoreNode.innerHTML=lottery.score;
        if(percent>40){$('#sheep-face').addClass('sheep-face-40')}
        if(percent>80){$('#sheep-face').addClass('sheep-face-80')}
    }
    



    $('.sheep-stand').click(function(){
        
        $('#countdown-ani>div').addClass('countdown-ani-innerwrapper');
        $('#countdown-ani').show(1).delay(2200).hide(1,function(){
            document.getElementById('countdown').innerHTML='59';
            sheep.timer=59;
            var countDownInterval = setInterval(function(){
                if(sheep.timer>0 && sheep.total>0){
                    sheep.timer=sheep.timer-1;
                    document.getElementById('countdown').innerHTML=sheep.timer;
                    
                }else{
                    clearTimeout(countDownInterval);
                    $('#timeup').show()
                    

                }
            
            },1000);
            $('.sheep-stand').hide();
            $('.sheep-cut').show();
        })
            
    })
    $('#timeup').click(function(){
        getResult(lottery.score)
    })
}