/**
 * OpenMU Aurora - the theme's only script (vanilla, deferred, no dependencies).
 *
 * What it does, in order of the sections below:
 *  1. Header: compact + frosted once the page is scrolled.
 *  2. Menu: mobile overlay, Server submenu (click/touch/keyboard; hover is CSS), Escape, focus trap.
 *  3. Scroll reveal for .au-reveal elements (class "js" on <html> is set in the head).
 *  4. Class showcase: selector rail with keyboard, swipe and pointer tilt.
 *  5. Stage: parallax scenery layers, northern-lights canvas (low-res, cheap), snow and sparkles.
 *
 * Motion rules: nothing animates with prefers-reduced-motion (the CSS shows a static poster),
 * the canvas loop stops while the tab is hidden, frame rate is capped (30 fps on the front
 * page, 20 fps elsewhere) and the particle count scales with the screen size.
 */
( function () {
	'use strict';

	var doc = document;
	var win = window;
	var reduce = win.matchMedia( '(prefers-reduced-motion: reduce)' );

	/** Shorthand for querySelectorAll returning a real array. */
	function all( selector, scope ) {
		return Array.prototype.slice.call( ( scope || doc ).querySelectorAll( selector ) );
	}

	/* ------------------------------------------------------------------ 1. Header */

	/** Marks the header as scrolled (compact and frosted) after a few pixels. */
	function initHeader() {
		var header = doc.querySelector( '.au-header' );
		if ( ! header ) {
			return;
		}
		var update = function () {
			header.classList.toggle( 'is-scrolled', ( win.scrollY || 0 ) > 24 );
		};
		update();
		win.addEventListener( 'scroll', update, { passive: true } );
	}

	/* ------------------------------------------------------------------ 2. Menu */

	/** Wires the mobile toggle, the Server submenu and the keyboard behaviour of both. */
	function initNav() {
		var nav = doc.querySelector( '[data-au-nav]' );
		var toggle = doc.querySelector( '[data-au-nav-toggle]' );
		if ( ! nav || ! toggle ) {
			return;
		}
		var body = doc.body;
		var mobile = win.matchMedia( '(max-width: 960px)' );
		var parents = all( '[data-au-parent]', nav );

		/** Closes every open submenu except the optional one given. */
		function closeSubs( except ) {
			parents.forEach( function ( item ) {
				if ( item !== except ) {
					item.classList.remove( 'is-open' );
					item.querySelector( '[data-au-sub-toggle]' ).setAttribute( 'aria-expanded', 'false' );
				}
			} );
		}

		/** Opens or closes the mobile overlay. */
		function setMenu( open ) {
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			body.classList.toggle( 'au-nav-open', open );
			if ( ! open ) {
				closeSubs( null );
			}
		}

		toggle.addEventListener( 'click', function () {
			setMenu( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
		} );

		parents.forEach( function ( item ) {
			var button = item.querySelector( '[data-au-sub-toggle]' );
			var links = all( '.au-nav__sub a', item );

			button.addEventListener( 'click', function () {
				var open = ! item.classList.contains( 'is-open' );
				closeSubs( item );
				item.classList.toggle( 'is-open', open );
				button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			} );

			// Arrow keys: Down on the button opens the list and enters it; Up/Down move inside it.
			button.addEventListener( 'keydown', function ( event ) {
				if ( event.key === 'ArrowDown' && links.length ) {
					event.preventDefault();
					closeSubs( item );
					item.classList.add( 'is-open' );
					button.setAttribute( 'aria-expanded', 'true' );
					links[ 0 ].focus();
				}
			} );
			links.forEach( function ( link, index ) {
				link.addEventListener( 'keydown', function ( event ) {
					if ( event.key === 'ArrowDown' ) {
						event.preventDefault();
						links[ ( index + 1 ) % links.length ].focus();
					} else if ( event.key === 'ArrowUp' ) {
						event.preventDefault();
						( index === 0 ? button : links[ index - 1 ] ).focus();
					}
				} );
			} );

			// A mouse leaving the dropdown closes a click-opened one (hover itself is CSS).
			item.addEventListener( 'pointerleave', function ( event ) {
				if ( event.pointerType === 'mouse' && ! mobile.matches ) {
					closeSubs( null );
				}
			} );
			// Keyboard focus leaving the submenu closes it.
			item.addEventListener( 'focusout', function ( event ) {
				if ( ! item.contains( event.relatedTarget ) && ! mobile.matches ) {
					closeSubs( null );
				}
			} );
		} );

		// Escape closes the submenu (focus back to its button) and the overlay (focus to the toggle).
		doc.addEventListener( 'keydown', function ( event ) {
			if ( event.key !== 'Escape' ) {
				return;
			}
			var openParent = parents.filter( function ( item ) {
				return item.classList.contains( 'is-open' );
			} )[ 0 ];
			if ( openParent && ! mobile.matches ) {
				closeSubs( null );
				openParent.querySelector( '[data-au-sub-toggle]' ).focus();
			} else if ( body.classList.contains( 'au-nav-open' ) ) {
				setMenu( false );
				toggle.focus();
			}
		} );

		// Clicking outside the open dropdown closes it; choosing a link closes the overlay.
		doc.addEventListener( 'click', function ( event ) {
			if ( ! nav.contains( event.target ) ) {
				closeSubs( null );
			}
		} );
		nav.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) {
				setMenu( false );
			}
		} );

		// Focus trap while the overlay is open: Tab cycles through the toggle and the menu links only.
		doc.addEventListener( 'keydown', function ( event ) {
			if ( event.key !== 'Tab' || ! body.classList.contains( 'au-nav-open' ) ) {
				return;
			}
			var focusable = all( 'a[href], button', nav ).filter( function ( el ) {
				return el.offsetParent !== null;
			} );
			focusable.push( toggle );
			var first = focusable[ 0 ];
			var last = focusable[ focusable.length - 1 ];
			if ( event.shiftKey && doc.activeElement === first ) {
				event.preventDefault();
				last.focus();
			} else if ( ! event.shiftKey && doc.activeElement === last ) {
				event.preventDefault();
				first.focus();
			}
		} );

		// Growing past the breakpoint resets the overlay.
		var onChange = function () {
			setMenu( false );
		};
		if ( mobile.addEventListener ) {
			mobile.addEventListener( 'change', onChange );
		}
	}

	/* ------------------------------------------------------------------ 3. Reveal */

	/** Fades sections in when they scroll into view; children of [data-au-stagger] come one after another. */
	function initReveal() {
		var items = all( '.au-reveal' );
		if ( ! items.length ) {
			return;
		}
		all( '[data-au-stagger]' ).forEach( function ( group ) {
			all( '.au-reveal', group ).forEach( function ( el, index ) {
				el.style.setProperty( '--au-delay', ( index * 0.09 ).toFixed( 2 ) + 's' );
			} );
		} );
		if ( ! ( 'IntersectionObserver' in win ) || reduce.matches ) {
			items.forEach( function ( el ) {
				el.classList.add( 'is-in' );
			} );
			return;
		}
		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-in' );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ rootMargin: '0px 0px -6% 0px', threshold: 0.08 }
		);
		items.forEach( function ( el ) {
			observer.observe( el );
		} );
	}

	/* ------------------------------------------------------------------ 4. Class showcase */

	/** Tabs of the class showcase: click, arrow keys, swipe, and a pointer tilt on the hero picture. */
	function initShowcase() {
		all( '[data-au-showcase]' ).forEach( function ( box ) {
			var tabs = all( '[role="tab"]', box );
			var panels = all( '[role="tabpanel"]', box );
			var figure = box.querySelector( '[data-au-tilt]' );
			var figs = all( '.au-fig', box );
			var rail = box.querySelector( '.au-showcase__tabs' );
			if ( ! tabs.length ) {
				return;
			}

			/** Shows the class at the given index. */
			function select( index, focus ) {
				index = ( index + tabs.length ) % tabs.length;
				tabs.forEach( function ( tab, i ) {
					var on = i === index;
					tab.setAttribute( 'aria-selected', on ? 'true' : 'false' );
					tab.tabIndex = on ? 0 : -1;
					tab.classList.toggle( 'is-active', on );
					panels[ i ].classList.toggle( 'is-active', on );
					if ( figs[ i ] ) {
						figs[ i ].classList.toggle( 'is-active', on );
					}
				} );
				// Keep the chosen card in view inside the sideways-scrolling rail (without scrolling the page).
				if ( rail && rail.scrollWidth > rail.clientWidth ) {
					var t = tabs[ index ];
					rail.scrollTo( { left: t.offsetLeft - ( rail.clientWidth - t.offsetWidth ) / 2, behavior: reduce.matches ? 'auto' : 'smooth' } );
				}
				box.setAttribute( 'data-active', tabs[ index ].getAttribute( 'data-class' ) );
				if ( focus ) {
					tabs[ index ].focus();
				}
			}

			box.classList.add( 'is-ready' );
			select( 0, false );

			tabs.forEach( function ( tab, index ) {
				tab.addEventListener( 'click', function () {
					select( index, false );
				} );
				tab.addEventListener( 'keydown', function ( event ) {
					var key = event.key;
					if ( key === 'ArrowRight' || key === 'ArrowDown' ) {
						event.preventDefault();
						select( index + 1, true );
					} else if ( key === 'ArrowLeft' || key === 'ArrowUp' ) {
						event.preventDefault();
						select( index - 1, true );
					} else if ( key === 'Home' ) {
						event.preventDefault();
						select( 0, true );
					} else if ( key === 'End' ) {
						event.preventDefault();
						select( tabs.length - 1, true );
					}
				} );
			} );

			// Swipe on touch screens: a horizontal move of 50px or more changes the class.
			var startX = null;
			var startY = 0;
			box.addEventListener( 'touchstart', function ( event ) {
				// A drag on the rail scrolls the rail; it must not also change the class.
				if ( rail && rail.contains( event.target ) ) {
					startX = null;
					return;
				}
				startX = event.touches[ 0 ].clientX;
				startY = event.touches[ 0 ].clientY;
			}, { passive: true } );
			box.addEventListener( 'touchend', function ( event ) {
				if ( startX === null ) {
					return;
				}
				var dx = event.changedTouches[ 0 ].clientX - startX;
				var dy = event.changedTouches[ 0 ].clientY - startY;
				startX = null;
				if ( Math.abs( dx ) > 50 && Math.abs( dx ) > Math.abs( dy ) * 1.5 ) {
					var current = tabs.findIndex( function ( tab ) {
						return tab.classList.contains( 'is-active' );
					} );
					select( current + ( dx < 0 ? 1 : -1 ), false );
				}
			}, { passive: true } );

			// Pointer tilt: the picture leans towards the mouse; skipped for reduced motion and touch.
			if ( figure && ! reduce.matches ) {
				var frame = 0;
				figure.addEventListener( 'pointermove', function ( event ) {
					if ( event.pointerType !== 'mouse' || frame ) {
						return;
					}
					frame = win.requestAnimationFrame( function () {
						frame = 0;
						var rect = figure.getBoundingClientRect();
						figure.style.setProperty( '--tx', ( ( event.clientX - rect.left ) / rect.width - 0.5 ).toFixed( 3 ) );
						figure.style.setProperty( '--ty', ( ( event.clientY - rect.top ) / rect.height - 0.5 ).toFixed( 3 ) );
					} );
				} );
				figure.addEventListener( 'pointerleave', function () {
					figure.style.setProperty( '--tx', '0' );
					figure.style.setProperty( '--ty', '0' );
				} );
			}
		} );
	}

	/* ------------------------------------------------------------------ 5. Stage */

	/** Builds a 1 x 64 vertical gradient used as a stamp for aurora curtains. */
	function makeStamp( bright, top ) {
		var canvas = doc.createElement( 'canvas' );
		canvas.width = 1;
		canvas.height = 64;
		var ctx = canvas.getContext( '2d' );
		var gradient = ctx.createLinearGradient( 0, 0, 0, 64 );
		// Faint upper veil in the second colour, bright lower edge in the first, then gone.
		gradient.addColorStop( 0, 'rgba(' + top + ',0)' );
		gradient.addColorStop( 0.45, 'rgba(' + top + ',0.22)' );
		gradient.addColorStop( 0.82, 'rgba(' + bright + ',0.85)' );
		gradient.addColorStop( 1, 'rgba(' + bright + ',0)' );
		ctx.fillStyle = gradient;
		ctx.fillRect( 0, 0, 1, 64 );
		return canvas;
	}

	/** Animates the stage: parallax layers, aurora curtains, snow and sparkles. */
	function initStage() {
		var stage = doc.querySelector( '[data-au-stage]' );
		if ( ! stage || reduce.matches ) {
			return;
		}
		var home = doc.body.classList.contains( 'au-home' );
		var layers = all( '.au-layer', stage ).map( function ( el ) {
			return { el: el, depth: parseFloat( el.getAttribute( 'data-depth' ) ) || 0 };
		} );
		var veilHost = stage;
		var auroraCanvas = stage.querySelector( '[data-au-aurora]' );
		var snowCanvas = stage.querySelector( '[data-au-snow]' );
		var aurora = auroraCanvas.getContext( '2d' );
		var snow = snowCanvas.getContext( '2d' );
		var phone = win.innerWidth < 700;

		/* ---- Parallax: scroll sinks the layers, the mouse shifts them sideways (front page only). ---- */
		var mouseX = 0;
		var mouseTargetX = 0;
		var mouseY = 0;
		var mouseTargetY = 0;
		var scheduled = false;
		var dim = -1;

		function apply() {
			scheduled = false;
			var y = Math.min( win.scrollY || 0, win.innerHeight );
			mouseX += ( mouseTargetX - mouseX ) * 0.08;
			mouseY += ( mouseTargetY - mouseY ) * 0.08;
			layers.forEach( function ( layer ) {
				var tx = home ? -mouseX * layer.depth * 70 : 0;
				var ty = ( home ? y * layer.depth * 0.9 : 0 ) + ( home ? mouseY * layer.depth * 24 : 0 );
				layer.el.style.transform = 'translate3d(' + tx.toFixed( 1 ) + 'px,' + ty.toFixed( 1 ) + 'px,0)';
			} );
			if ( home ) {
				var amount = Math.round( Math.min( y / ( win.innerHeight * 0.85 ), 1 ) * 100 ) / 100;
				if ( amount !== dim ) {
					dim = amount;
					veilHost.style.setProperty( '--au-dim', String( amount ) );
				}
			}
			// Keep easing while the mouse offset has not settled.
			if ( Math.abs( mouseTargetX - mouseX ) > 0.002 || Math.abs( mouseTargetY - mouseY ) > 0.002 ) {
				schedule();
			}
		}
		function schedule() {
			if ( ! scheduled ) {
				scheduled = true;
				win.requestAnimationFrame( apply );
			}
		}
		win.addEventListener( 'scroll', schedule, { passive: true } );
		if ( home ) {
			doc.addEventListener( 'pointermove', function ( event ) {
				if ( event.pointerType !== 'mouse' ) {
					return;
				}
				mouseTargetX = event.clientX / win.innerWidth - 0.5;
				mouseTargetY = event.clientY / win.innerHeight - 0.5;
				schedule();
			}, { passive: true } );
		}
		apply();

		/* ---- Canvases ---- */
		var AW = 0;
		var AH = 0;
		var SW = 0;
		var SH = 0;
		var flakes = [];
		var stars = [];
		var stamps = [
			makeStamp( '62,230,193', '138,108,255' ),
			makeStamp( '138,108,255', '255,111,174' ),
			makeStamp( '90,240,215', '62,150,255' )
		];
		// Per curtain: height of its base line, wave sizes/speeds, strength.
		var curtains = [
			{ base: 0.30, amp: 0.10, f: 2.3, s: 0.22, f2: 5.1, s2: 0.31, h: 0.34, a: 0.75, stamp: 0 },
			{ base: 0.22, amp: 0.08, f: 3.1, s: 0.17, f2: 6.4, s2: 0.26, h: 0.30, a: 0.55, stamp: 1 },
			{ base: 0.38, amp: 0.07, f: 1.7, s: 0.13, f2: 4.2, s2: 0.21, h: 0.26, a: 0.45, stamp: 2 }
		];

		function resize() {
			phone = win.innerWidth < 700;
			// The aurora is drawn at 1/6 of the screen size and scaled up by CSS: soft, and cheap to paint.
			AW = Math.max( 120, Math.round( win.innerWidth / 6 ) );
			AH = Math.max( 90, Math.round( win.innerHeight / 6 ) );
			auroraCanvas.width = AW;
			auroraCanvas.height = AH;
			// Snow stays at 1x resolution: crisp flakes, still few pixels to fill.
			SW = snowCanvas.width = win.innerWidth;
			SH = snowCanvas.height = win.innerHeight;
			var count = Math.max( 26, Math.min( 90, Math.round( SW / 22 ) ) );
			while ( flakes.length < count ) {
				flakes.push( spawnFlake( true ) );
			}
			flakes.length = count;
			stars = [];
			for ( var i = 0; i < ( phone ? 7 : 14 ); i++ ) {
				stars.push( { x: Math.random() * SW, y: Math.random() * SH * 0.55, r: 2 + Math.random() * 3, w: 0.4 + Math.random() * 0.9, p: Math.random() * 6.28 } );
			}
		}

		/** One snowflake: size sets speed and brightness so near flakes read as nearer. */
		function spawnFlake( anywhere ) {
			var r = 0.7 + Math.random() * 2.1;
			return {
				x: Math.random() * SW,
				y: anywhere ? Math.random() * SH : -6,
				r: r,
				vy: 10 + r * 14 + Math.random() * 12,
				sway: 8 + Math.random() * 22,
				phase: Math.random() * 6.28,
				a: 0.25 + r * 0.22
			};
		}

		function drawAurora( t ) {
			aurora.clearRect( 0, 0, AW, AH );
			aurora.globalCompositeOperation = 'lighter';
			var step = 2;
			curtains.forEach( function ( c ) {
				for ( var x = 0; x < AW; x += step ) {
					var u = x / AW;
					var wave = Math.sin( u * c.f * 6.28 + t * c.s * 6.28 ) * 0.6 + Math.sin( u * c.f2 * 6.28 - t * c.s2 * 6.28 ) * 0.4;
					var top = ( c.base + wave * c.amp ) * AH;
					var h = ( c.h + Math.sin( u * 9 + t * 0.6 ) * 0.06 ) * AH;
					// Brightness ripples along the curtain like drifting rays.
					var strength = c.a * ( 0.55 + 0.45 * Math.sin( u * 24 + t * 0.9 + c.f ) ) * ( 0.7 + 0.3 * Math.sin( u * 3.1 - t * 0.25 ) );
					aurora.globalAlpha = Math.max( 0, strength );
					aurora.drawImage( stamps[ c.stamp ], 0, 0, 1, 64, x, top, step + 0.5, h );
				}
			} );
			aurora.globalAlpha = 1;
			aurora.globalCompositeOperation = 'source-over';
		}

		function drawSnow( dt, t ) {
			snow.clearRect( 0, 0, SW, SH );
			snow.fillStyle = '#eaf2ff';
			for ( var i = 0; i < flakes.length; i++ ) {
				var f = flakes[ i ];
				f.y += f.vy * dt;
				var x = f.x + Math.sin( t * 0.6 + f.phase ) * f.sway;
				if ( f.y > SH + 6 ) {
					flakes[ i ] = spawnFlake( false );
					continue;
				}
				snow.globalAlpha = f.a;
				snow.beginPath();
				snow.arc( x, f.y, f.r, 0, 6.2832 );
				snow.fill();
			}
			// Sparkles: four-pointed glints that twinkle in the upper sky.
			snow.strokeStyle = '#cfe9ff';
			snow.lineWidth = 1;
			for ( var j = 0; j < stars.length; j++ ) {
				var s = stars[ j ];
				var tw = Math.pow( ( Math.sin( t * s.w + s.p ) + 1 ) / 2, 3 );
				if ( tw < 0.05 ) {
					continue;
				}
				snow.globalAlpha = tw * 0.9;
				var len = s.r * ( 1 + tw );
				snow.beginPath();
				snow.moveTo( s.x - len, s.y );
				snow.lineTo( s.x + len, s.y );
				snow.moveTo( s.x, s.y - len );
				snow.lineTo( s.x, s.y + len );
				snow.stroke();
			}
			snow.globalAlpha = 1;
		}

		/* ---- Frame loop: capped fps, stopped while the tab is hidden. ---- */
		var interval = home ? 1000 / 30 : 1000 / 20;
		var last = 0;
		var raf = 0;
		function frame( now ) {
			raf = win.requestAnimationFrame( frame );
			if ( now - last < interval ) {
				return;
			}
			var dt = Math.min( ( now - last ) / 1000, 0.1 );
			last = now;
			drawAurora( now / 1000 );
			drawSnow( dt, now / 1000 );
		}
		function start() {
			if ( ! raf && ! doc.hidden ) {
				last = 0;
				raf = win.requestAnimationFrame( frame );
			}
		}
		function stop() {
			if ( raf ) {
				win.cancelAnimationFrame( raf );
				raf = 0;
			}
		}
		doc.addEventListener( 'visibilitychange', function () {
			if ( doc.hidden ) {
				stop();
			} else {
				start();
			}
		} );
		var resizeTimer = 0;
		win.addEventListener( 'resize', function () {
			win.clearTimeout( resizeTimer );
			resizeTimer = win.setTimeout( function () {
				resize();
				schedule();
			}, 150 );
		} );
		// Reduced motion switched on while the page is open: stop everything.
		if ( reduce.addEventListener ) {
			reduce.addEventListener( 'change', function () {
				if ( reduce.matches ) {
					stop();
				} else {
					start();
				}
			} );
		}

		resize();
		start();
	}

	/* ------------------------------------------------------------------ Start */
	initHeader();
	initNav();
	initReveal();
	initShowcase();
	initStage();
}() );
