app.service("circular", function () {

    this.canvas = document.createElement('canvas');
    this.span = document.createElement('span');
    this.canvas.setAttribute("id", "canvas-circular");
    this.span.setAttribute("id", "span-circular");

    this.percent = function (percentVal, percentNum) {
        $("#span-circular").text(percentVal);
        $("#circular").attr("data-percent", percentNum);
    };

    this.status = function (status) {
        $('#status').html(status);
    };

    this.statusEmpty = function () {
        $('#status').empty();
    };

    this.load = function () {

        var el = document.getElementById('circular'); // get canvas

        var options = {
            percent: el.getAttribute('data-percent') || 5,
            size: el.getAttribute('data-size') || 100,
            lineWidth: el.getAttribute('data-line') || 2,
            rotate: el.getAttribute('data-rotate') || 0
        };

        this.span.textContent = options.percent + '%';

        if (typeof(G_vmlCanvasManager) !== 'undefined') {
            G_vmlCanvasManager.initElement(this.canvas);
        }

        var ctx = this.canvas.getContext('2d');
        this.canvas.width = this.canvas.height = options.size;

        el.appendChild(this.span);
        el.appendChild(this.canvas);

        ctx.translate(options.size / 2, options.size / 2);      // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI);  // rotate -90 deg

        //imd = ctx.getImageData(0, 0, 240, 240);
        var radius = (options.size - options.lineWidth) / 2;

        var drawCircle = function (color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx.strokeStyle = color;
            ctx.lineCap = 'round'; // butt, round or square
            ctx.lineWidth = lineWidth;
            ctx.stroke();
        };

        drawCircle('#efefef', options.lineWidth, 100 / 100);
        if (options.percent > 0)
            drawCircle('#4CAF50', options.lineWidth, options.percent / 100);
    };

});