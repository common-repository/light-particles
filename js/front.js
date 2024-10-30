
var intervals = [];
var nb = 0;

jQuery(document).ready(function(){

	console.log(settings_wpp);

	if(settings_wpp.quantity == 0)
		settings_wpp.quantity = 1+Math.random()*100;

	/*if(settings_wpp.speed == 0)
		settings_wpp.speed = 1+parseInt(Math.random()*4);

	settings_wpp.speed = parseInt(settings_wpp.speed)*2;*/

	var i = 0;
	
	setInterval(function(){
		
		if(nb < settings_wpp.quantity)
		{
			//var pos_x = Math.random()*window.innerWidth;
			var width = 2+Math.random()*30;
			var r = Math.random()*255;
			var g = Math.random()*255;
			var b = Math.random()*255;
			var color = 'rgba('+r+', '+g+', '+b+', '+settings_wpp.opacity+')';
			var angle = Math.random()*Math.PI*2;
			if(angle >= Math.PI/4 && angle <= 3*Math.PI/4)
			{
				var top = window.innerHeight;
				var left = Math.random()*window.innerWidth;
				//var left = -width;
			}
			else if(angle > 3*Math.PI/4 && angle <= 5*Math.PI/4)
			{
				var top = Math.random()*window.innerHeight;
				var left = window.innerWidth;
			}
			else if(angle > 5*Math.PI/4 && angle <= 7*Math.PI/4)
			{
				var top = -width;
				var left = Math.random()*window.innerWidth;
			}
			else
			{
				var top =  Math.random()*window.innerHeight;
				var left = -width;
				//var left = Math.random()*window.innerWidth;
			}

			//var i = Math.floor((Math.random() * (settings_ft.images.length))); 
			jQuery('body').append('<div class="particle" rel="'+angle+'" data-speed="'+(1+parseInt(Math.random()*9))+'" style="left: '+left+'px; top: '+top+'px; width: '+width+'px; height: '+width+'px; background: radial-gradient('+color+', transparent)"></div>');
			//set_anim_particle(jQuery('body .particle:last-child'), i++);
			nb++;
		}
	}, 1000-(15*settings_wpp.quantity));

	setInterval(function(){

		jQuery('.particle').each(function(){

			var angle = parseFloat(jQuery(this).attr('rel'));
			var width = parseFloat(jQuery(this).css('width'));
			var pos_left = parseFloat(jQuery(this).css('left'));
			var pos_top = parseFloat(jQuery(this).css('top'));
			var offset_x = 100;
			
			if(settings_wpp.speed > 0)
			{
				pos_top -= Math.sin(angle)*settings_wpp.speed;
				pos_left += Math.cos(angle)*settings_wpp.speed;
			}
			else
			{
				var speed = jQuery(this).data('speed');
				pos_top -= Math.sin(angle)*speed;
				pos_left += Math.cos(angle)*speed;
			}
			//console.log(Math.sin(angle)*settings_wpp.speed/2);
			//console.log('Cos: '+Math.cos(angle)+' Sin: '+Math.sin(angle));

			if(pos_top < -width || pos_top > window.innerHeight || pos_left < -width || pos_left > window.innerWidth)
			{	
				jQuery(this).remove();
				nb--;
				//console.log('Particle out of screen! (width: '+width+', angle: '+angle+', w: '+window.innerWidth+', h: '+window.innerHeight+', x: '+pos_left+', y:'+pos_top+')');
			}
			else
				jQuery(this).css({left: pos_left, top: pos_top});

		});

	}, 30);
});