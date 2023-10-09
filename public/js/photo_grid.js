	$('.gallery > div > img').each(function(){
		$('img[src="' + $(this).attr('src') + '"]').click( 
			function(){
				path = $(this).attr('src');
				if ($('.fingers')[0]===undefined){
					var imgNum = path.split('/')[path.split('/').length-1].split('.')[0];
					var imgInfo = $('<div>').text(imgNum + ' фото из ' + $('.gallery img').length);
					var fingerPrev = $('<div>')
						.text('👈')
						.click(function(){ 
							if (imgNum > 1) {
								imgNum--;
								$('.img-window img')
									.animate({opacity:0},500,'linear',
										function(){
											$(this).replaceWith($($('.gallery img').get(imgNum-1)).clone());

											imgInfo.text(imgNum + ' фото из ' + $('.gallery img').length);
							
											if (imgNum >= $('.gallery img').length) fingerNext.fadeTo(0, 0.5);
											else fingerNext.removeAttr('style');
											if (imgNum <= 1) fingerPrev.fadeTo(0, 0.5);
											else fingerPrev.removeAttr('style');	

											$('.img-window').css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
										});
							}
						});
					var fingerNext = $('<div>')
						.text('👉')
						.click(function(){
							if (imgNum < $('.gallery img').length) { 
								imgNum++;
								$('.img-window img')
									.animate({opacity:0},500,'linear',
										function(){
											$(this).replaceWith($($('.gallery img').get(imgNum-1)).clone());

											imgInfo.text(imgNum + ' фото из ' + $('.gallery img').length);
							
											if (imgNum >= $('.gallery img').length) fingerNext.fadeTo(0, 0.5);
											else fingerNext.removeAttr('style');
											if (imgNum <= 1) fingerPrev.fadeTo(0, 0.5);
											else fingerPrev.removeAttr('style');	

											$('.img-window').css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
										});
							}
						});

					if (imgNum <= 1)
						fingerPrev.fadeTo(0, 0.5);
					else if (imgNum >= $('.gallery img').length) 
						fingerNext.fadeTo(0, 0.5);

					$('<div>')
					.append(
						$(this).clone(),
						$('<div>').attr('class','fingers')
							.append(fingerPrev, imgInfo, fingerNext)
						)
					.appendTo($('body'))
					.click(function(event){
						if(event.target!==fingerNext[0] &&
						 event.target!==fingerPrev[0] && 
						 event.target!==imgInfo[0] &&
						 event.target !== $('.fingers')[0]
						 )
							$(this).remove();
						})
					.attr('class', 'img-window')
					.css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
				}
			}
		);
	});