/**
 * Paymerch Figma theme: mobile menu + transfer calculator.
 */
( function () {
	'use strict';

	/* Mobile menu */
	var toggle = document.querySelector( '[data-pm-menu-toggle]' );
	var menu = document.getElementById( 'pm-menu' );
	if ( toggle && menu ) {
		toggle.addEventListener( 'click', function () {
			var open = toggle.getAttribute( 'aria-expanded' ) !== 'true';
			toggle.setAttribute( 'aria-expanded', String( open ) );
			menu.classList.toggle( 'is-open', open );
		} );
		menu.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a' ) ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
				menu.classList.remove( 'is-open' );
			}
		} );
	}

	/* Calculator */
	function parse( value ) {
		var n = parseFloat( String( value ).replace( /[^0-9.]/g, '' ) );
		return isFinite( n ) ? n : 0;
	}

	function format( n, decimals ) {
		return n.toLocaleString( 'en-US', {
			minimumFractionDigits: decimals,
			maximumFractionDigits: decimals
		} );
	}

	document.querySelectorAll( '[data-pm-calc]' ).forEach( function ( form ) {
		var corridors = JSON.parse( form.getAttribute( 'data-corridors' ) || '{}' );
		var codes = Object.keys( corridors );
		var fee = parseFloat( form.getAttribute( 'data-fee' ) ) || 0;
		var current = corridors[ form.getAttribute( 'data-corridor' ) ] ? form.getAttribute( 'data-corridor' ) : codes[ 0 ];
		var send = form.querySelector( '[data-pm-send]' );
		var receive = form.querySelector( '[data-pm-receive]' );
		var rateEl = form.querySelector( '[data-pm-rate]' );
		var flag = form.querySelector( '[data-pm-flag]' );
		var ccy = form.querySelector( '[data-pm-ccy]' );
		var delivery = form.querySelector( '[data-pm-delivery]' );
		var swap = form.querySelector( '[data-pm-toggle]' );

		function rate() {
			return corridors[ current ].rate;
		}

		function fromSend() {
			receive.value = format( Math.max( 0, parse( send.value ) - fee ) * rate(), 2 );
		}

		function fromReceive() {
			var r = parse( receive.value );
			send.value = format( r > 0 ? r / rate() + fee : 0, 2 );
		}

		function render() {
			var c = corridors[ current ];
			rateEl.textContent = '1 USD = ' + format( c.rate, 2 ) + ' ' + current;
			flag.src = c.flag;
			ccy.textContent = current;
			delivery.textContent = 'ϟ  ' + c.delivery;
			fromSend();
		}

		form.addEventListener( 'submit', function ( e ) {
			e.preventDefault();
		} );
		send.addEventListener( 'input', fromSend );
		receive.addEventListener( 'input', fromReceive );
		send.addEventListener( 'blur', function () {
			send.value = format( parse( send.value ), parse( send.value ) % 1 ? 2 : 0 );
		} );
		receive.addEventListener( 'blur', function () {
			receive.value = format( parse( receive.value ), 2 );
		} );

		if ( swap && codes.length > 1 ) {
			swap.addEventListener( 'click', function () {
				current = codes[ ( codes.indexOf( current ) + 1 ) % codes.length ];
				swap.classList.toggle( 'is-flipped' );
				render();
			} );
		}
	} );

	/* Bank logo carousel (country pages) */
	document.querySelectorAll( '[data-pm-carousel]' ).forEach( function ( wrap ) {
		var track = wrap.querySelector( '[data-pm-track]' );
		var prev = wrap.querySelector( '[data-pm-prev]' );
		var next = wrap.querySelector( '[data-pm-next]' );

		function update() {
			var max = track.scrollWidth - track.clientWidth;
			prev.disabled = track.scrollLeft <= 1;
			next.disabled = track.scrollLeft >= max - 1;
		}

		prev.addEventListener( 'click', function () {
			track.scrollBy( { left: -track.clientWidth * 0.6 } );
		} );
		next.addEventListener( 'click', function () {
			track.scrollBy( { left: track.clientWidth * 0.6 } );
		} );
		track.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	} );

	/* Benefits / How it works tabs */
	document.querySelectorAll( '[data-pm-tabs]' ).forEach( function ( list ) {
		var tabs = Array.prototype.slice.call( list.querySelectorAll( '[role="tab"]' ) );

		function select( tab ) {
			tabs.forEach( function ( t ) {
				var on = t === tab;
				t.setAttribute( 'aria-selected', String( on ) );
				t.tabIndex = on ? 0 : -1;
				document.getElementById( t.getAttribute( 'aria-controls' ) ).hidden = ! on;
			} );
		}

		tabs.forEach( function ( tab, i ) {
			tab.addEventListener( 'click', function () {
				select( tab );
			} );
			tab.addEventListener( 'keydown', function ( e ) {
				var dir = { ArrowRight: 1, ArrowLeft: -1 }[ e.key ];
				if ( dir ) {
					var target = tabs[ ( i + dir + tabs.length ) % tabs.length ];
					select( target );
					target.focus();
				}
			} );
		} );
	} );

	/* "Calculate your transfer" next to a calculator focuses its amount */
	document.querySelectorAll( '[data-pm-focus-calc]' ).forEach( function ( link ) {
		link.addEventListener( 'click', function ( e ) {
			var input = document.querySelector( '#calculator [data-pm-send]' );
			if ( input ) {
				e.preventDefault();
				input.focus();
				input.select();
			}
		} );
	} );
}() );
