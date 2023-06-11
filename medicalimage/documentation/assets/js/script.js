/*!
 * Documenter 2.0
 * http://rxa.li/documenter
 *
 * Copyright 2011, Xaver Birsak
 * http://revaxarts.com
 *
 */
 
$(document).ready(function() {
	var timeout,
		sections = new Array(),
		sectionscount = 0,
		win = $(window),
		sidebar = $('#documenter_sidebar'),
		nav = $('#documenter_nav'),
		logo = $('#documenter_logo'),
		navanchors = nav.find('a'),
		timeoffset = 50,
		hash = location.hash || null;
		iDeviceNotOS4 = (navigator.userAgent.match(/iphone|ipod|ipad/i) && !navigator.userAgent.match(/OS 5/i)) || false,
		badIE = $('html').prop('class').match(/ie(6|7|8)/)|| false;
		
	//handle external links (new window)
	$('a[href^=http]').bind('click',function(){
		window.open($(this).attr('href'));
		return false;
	});
	
	
	//We need the position of each section until the full page with all images is loaded
	win.bind('load',function(){
		
		var sectionselector = 'section';
		
		//Documentation has subcategories		
		if(nav.find('ol').length){
			sectionselector = 'section, h4';
		}
		//saving some information
		$(sectionselector).each(function(i,e){
			var _this = $(this);
			var p = {
				id: this.id,
				pos: _this.offset().top
			};
			sections.push(p);
		});

		//how many sections
		sectionscount = sections.length;
		
		//bind the handler to the scroll event
		win.bind('scroll',function(event){
			clearInterval(timeout);
			//should occur with a delay
			timeout = setTimeout(function(){
				//get the position from the very top in all browsers
				pos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
				
				//iDeviceNotOS4s don't know the fixed property so we fake it
				if(iDeviceNotOS4){
					sidebar.css({height:document.height});
					logo.css({'margin-top':pos});
				}
				//activate Nav element at the current position
				activateNav(pos);
			},timeoffset);
		}).trigger('scroll');

	});
	
	//activate current nav element
	function activateNav(pos){
		var offset = 100,
		current, next, parent, isSub, hasSub;
		for(var i=sectionscount;i>0;i--){
			if(sections[i-1].pos <= pos+offset){
				navanchors.removeClass('current');
				current = navanchors.eq(i-1);
				current.addClass('current');
				
				parent = current.parent().parent();
				next = current.next();
				
				hasSub = next.is('ul');
				isSub = !parent.is('#documenter_nav');
				
				nav.find('ol:visible').not(parent).slideUp('fast');
				if(isSub){
					parent.prev().addClass('current');
					parent.stop().slideDown('fast');
				}else if(hasSub){
					next.stop().slideDown('fast');
				}
				break;
			};
		}	
	}
	
    // make code pretty
    window.prettyPrint && prettyPrint();
	
});