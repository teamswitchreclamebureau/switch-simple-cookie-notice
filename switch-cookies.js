jQuery(document).ready(function ($) {
	console.log('switch-cookies.js');
	const cookie = document.querySelector('.cookie-notice');
	const cookiebuttonAccept = document.querySelector('#cookiebuttonAccept');
	const cookiebuttonDecline = document.querySelector('#cookiebuttonDecline');

	cookiebuttonAccept.addEventListener('click', function () {
		consentGranted();
		dataLayer.push({"event": "cookie_consent_update"});
	});

	cookiebuttonDecline.addEventListener('click', function () {
		consentDenied();
		dataLayer.push({"event": "cookie_consent_update"});
	});
	

	if (!getCookie('cookies-ok') && !getCookie('cookies-denied')) {
        cookie.classList.remove('disabled');
    }

	function updateConsent() {
		gtag('consent', 'update', {
			ad_storage: 'granted',
			ad_user_data: 'granted',
			ad_personalization: 'granted',
			analytics_storage: 'granted',
			functionality_storage: 'granted',
			personalization_storage: 'granted',
			security_storage: 'granted',
		});
	}

	function consentGranted() {
		setCookie('cookies-ok', true, 30);
		cookie.classList.add('disabled');
		console.log('consentGranted');

		updateConsent();
	}

	function consentDenied() {
		setCookie('cookies-denied', true, 14);
		cookie.classList.add('disabled');
		console.log('consentDenied');
	}

	function setCookie(name, value, days) {
		var expires = '';
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
			expires = '; expires=' + date.toUTCString();
		}
		document.cookie = name + '=' + (value || '') + expires + '; path=/';
	}

	function getCookie(name) {
		var nameEQ = name + '=';
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0)
				return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		document.cookie =
			name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}
});
