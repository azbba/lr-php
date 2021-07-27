document.addEventListener("DOMContentLoaded", function(e) { 
	let counter = document.getElementById('refershCounter');
	if ( counter ) {
		$seconds = parseInt( counter.dataset.seconds );
		let countDown = setInterval(() => {
			counter.textContent = --$seconds;
			if ( $seconds == 0 ) {
				clearInterval( countDown );
			}
		}, 1000);
	}
});