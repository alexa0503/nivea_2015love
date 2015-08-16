function Lottery(id, cover, coverType, width, height, drawPercentCallback) {
    this.conId = id;
    this.conNode = document.getElementById(this.conId);
    this.cover = cover;
    this.coverType = coverType;
    this.background = null;
    this.backCtx = null;
    this.mask = null;
    this.maskCtx = null;
    this.lottery = null;
    this.lotteryType = 'image';
    this.width = width || 100;
    this.height = height || 300;
    this.clientRect = null;
    this.drawPercentCallback = drawPercentCallback;

    this.total = 10;
    this.score = 0;
}

Lottery.prototype = {
    createElement: function (tagName, attributes) {
        var ele = document.createElement(tagName);
        for (var key in attributes) {
            ele.setAttribute(key, attributes[key]);
        }
        return ele;
    },
    getTransparentPercent: function(ctx, width, height) {
        var imgData = ctx.getImageData(0, 0, width, height),
            pixles = imgData.data,
            transPixs = [];
        for (var i = 0, j = pixles.length; i < j; i += 4) {
            var a = pixles[i + 3];
            if (a < 128) {
                transPixs.push(i);
            }
        }
        return (transPixs.length / (pixles.length / 4) * 100).toFixed(2);
    },
    resizeCanvas: function (canvas, width, height) {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').clearRect(0, 0, width, height);
    },
    drawPoint: function (x, y) {
        
            this.maskCtx.beginPath();
            /*var radgrad = this.maskCtx.createRadialGradient(x, y, 0, x, y, 90);
            radgrad.addColorStop(0, 'rgba(0,0,0,0.6)');
            radgrad.addColorStop(1, 'rgba(255, 255, 255, 0)');*/
            this.maskCtx.fillStyle = '#fff';
            this.maskCtx.arc(x, y, 40, 40, Math.PI * 2, true);
            this.maskCtx.fill();
            if (!this.conNode.innerHTML.replace(/[\w\W]| /g, '')) {
                this.conNode.appendChild(this.background);
                this.conNode.appendChild(this.mask);
                this.clientRect = this.conNode ? this.conNode.getBoundingClientRect() : null;
            }
            if (this.drawPercentCallback) {
                this.drawPercentCallback.call(null, this.getTransparentPercent(this.maskCtx, this.width, this.height));
                //this.drawPercentCallback.call(null, this.getTransparentPercent(this.maskCtx, this.width, this.height),this.score);
            }
    },
    bindEvent: function () {
        var _this = this;
        var device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
        var clickEvtName = device ? 'touchstart' : 'mousedown';
        var moveEvtName = device? 'touchmove': 'mousemove';
        if (!device) {
            var isMouseDown = false;
            document.addEventListener('mouseup', function(e) {
                isMouseDown = false;
                document.getElementById('audio-razor').pause()
                if(_this.getTransparentPercent(_this.maskCtx, _this.width, _this.height)>90){
                    _this.refresh();
                }
            }, false);
        } else {
            document.addEventListener("touchmove", function(e) {
                if (isMouseDown) {
                    e.preventDefault();
                }
            }, false);
            document.addEventListener('touchend', function(e) {
                isMouseDown = false;
                document.getElementById('audio-razor').pause()
                if(_this.getTransparentPercent(_this.maskCtx, _this.width, _this.height)>90){
                    _this.refresh();
                }
                
            }, false);
        }
        this.mask.addEventListener(clickEvtName, function (e) {
            isMouseDown = true;
            var docEle = document.documentElement;
            if (!_this.clientRect) {
                _this.clientRect = {
                    left: 0,
                    top:0
                };
            }
            var x = (device ? e.touches[0].clientX : e.clientX) - _this.clientRect.left + docEle.scrollLeft - docEle.clientLeft;
            var y = (device ? e.touches[0].clientY : e.clientY) - _this.clientRect.top + docEle.scrollTop - docEle.clientTop;
            _this.drawPoint(x, y);
            document.getElementById('audio-razor').play()
        }, false);

        this.mask.addEventListener(moveEvtName, function (e) {
            if (!device && !isMouseDown) {
                return false;
            }
            var docEle = document.documentElement;
            if (!_this.clientRect) {
                _this.clientRect = {
                    left: 0,
                    top:0
                };
            }
            var x = (device ? e.touches[0].clientX : e.clientX) - _this.clientRect.left + docEle.scrollLeft - docEle.clientLeft;
            var y = (device ? e.touches[0].clientY : e.clientY) - _this.clientRect.top + docEle.scrollTop - docEle.clientTop;
            _this.drawPoint(x, y);
        }, false);
    },
    drawLottery: function () {
        console.log('start')
        this.background = this.background || this.createElement('canvas', {
            style: 'position:absolute;left:0;top:0;'
        });
        this.mask = this.mask || this.createElement('canvas', {
            style: 'position:absolute;left:0;top:0;'
        });

        //if (!this.conNode.innerHTML.replace(/[\w\W]| /g, '')) {
        if (this.conNode.innerHTML.length==0) {
            this.conNode.appendChild(this.background);
            this.conNode.appendChild(this.mask);
            this.clientRect = this.conNode ? this.conNode.getBoundingClientRect() : null;
            this.bindEvent();
        }

        this.backCtx = this.backCtx || this.background.getContext('2d');
        this.maskCtx = this.maskCtx || this.mask.getContext('2d');

        if (this.lotteryType == 'image') {
            var image = new Image(),
                _this = this;
            image.onload = function () {
                _this.width = this.width;
                _this.height = this.height;
                _this.resizeCanvas(_this.background, this.width, this.height);
                _this.backCtx.drawImage(this, 0, 0);
                _this.drawMask();
            }
            image.src = this.lottery;console.log('end')
        } else if (this.lotteryType == 'text') {
            this.width = this.width;
            this.height = this.height;
            this.resizeCanvas(this.background, this.width, this.height);
            this.backCtx.save();
            this.backCtx.fillStyle = '#FFF';
            this.backCtx.fillRect(0, 0, this.width, this.height);
            this.backCtx.restore();
            this.backCtx.save();
            var fontSize = 30;
            this.backCtx.font = 'Bold ' + fontSize + 'px Arial';
            this.backCtx.textAlign = 'center';
            this.backCtx.fillStyle = '#F60';
            this.backCtx.fillText(this.lottery, this.width / 2, this.height / 2 + fontSize / 2);
            this.backCtx.restore();
            this.drawMask();
        }

    },
    drawMask: function() {
        this.resizeCanvas(this.mask, this.width, this.height);
        if (this.coverType == 'color') {
            this.maskCtx.fillStyle = this.cover;
            this.maskCtx.fillRect(0, 0, this.width, this.height);
            this.maskCtx.globalCompositeOperation = 'destination-out';
        } else if (this.coverType == 'image'){
            var image = new Image(),
                _this = this;
            image.onload = function () {
                _this.maskCtx.drawImage(this, 0, 0);
                _this.maskCtx.globalCompositeOperation = 'destination-out';
            }
            image.src = this.cover;
        }
    },
    init: function (lottery, lotteryType) {
        this.lottery = lottery;
        this.lotteryType = lotteryType || 'image';
        this.drawLottery();
    },
    refresh: function(){
        if(this.total>0){
            //console.log('refresh');
            $('.sheep-cut').hide();
            $('.sheepcut').addClass('sheepcut-out');
            var _this=this;
            setTimeout(function(){
                var _r=Math.round(Math.random()*2);
                _this.cover = sheep.covers[_r];
                _this.lottery = sheep.bg[_r];
                _this.drawLottery();
                _this.score++;
                _this.total--;

                $('.sheep-cut').fadeIn(20);
                $('.sheepcut').removeClass('sheepcut-out');
                $('#sheep-face').attr('class','sheep-cut sheep-face-'+_r)
                $('#score').attr('src','img/c'+ _this.score +'.png')
                $('.sp-out-ani').attr('src','img/out-'+Number(_r+1)+'.png')
            },300)
        }else{
            $('#timeup').show()
            sheep.timer=0;
        }
        
    }
}

function getResult(score){
    $('.pages').hide();
    $('.giftpage').show();
    var _score=score-1; 
     
    //$('.gift-id img:eq('+_score+')').removeClass('giftoff').addClass('gifton').on('click',function () {
    $('.gift-id img:eq('+_score+')').removeAttr('styel').slideDown(600).on('click',function () {
        $('.gift-yes').hide()
        $('.finalform').css('display','table-cell');
        $('.finalform form').slideDown(600)
    })
}

function getRandomStr(len) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < len; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}