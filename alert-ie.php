<?php 

/**
 * =================================================================================
 * @date : 15/01/2016
 * @version : 1.2
 * @company : Ice-Development
 * @see : www.ice-dev.com

 * edit jh 18/03/2016 : detection safari < 7
 * edit jh : test JS pour navigateur internet Android defaut
 
 * Alert-IE.php affiche un message d'alerte invitant les utilisateurs d'IE9 et inférieur + Nav. Android defaut à utiliser de préférence un navigateur à jour, tel que Chrome ou Firefox.
 * =================================================================================
 */


?>


<style>

	/**
	 * Conteneur qui sera supprimé au clic sur le bouton 'fermé'
	 */

	#alert-ie {
		display: none;
		position: fixed;
		top: 20%;
		left: 50%;
		 z-index: 99999;
	}

	/**
	 * 1. Centre la div enfant avec une position: fixed;
	 * 2. Ajout d'une largeur minimal pour éviter le retour à la ligne du lien 'Google Chrome'
	 */

	#alert-ie > div {
		position: relative; /* 1 */
		left: -50%; /* 1 */
		min-width: 800px; /* 2 */
		background: #F2DEDE;
		color: black;
		border: 5px solid rgb(238, 211, 215);
		border-radius: 4px;
		padding: 15px;
	}

	@media screen and (max-width: 640px) {

		#alert-ie > div {
			min-width: 100%;
			width:90%;
		}

		.link-download a {
			width: 100%;
		}
	}

	/**
	 * 1. Enlève le float: left; des titres 2
	 * 2. Enlève toutes les marges des titres 2
	 */

	#alert-ie h2 {
		font-size: 20px;
		float: none; /* 1 */
		margin: 0; /* 2 */
	}

	#alert-ie a {
		vertical-align: middle;
		text-decoration: none;
		color: black;
	}

	#alert-ie a:hover { text-decoration: underline; }

	/**
	 * Conteneur du bouton et des liens de téléchargements
	 */ 

	.link-download {
		text-align: center;
		margin-top: 10px;
	}

	/**
	 * Lien de téléchargement Mozilla et G. Chrome
	 */

	.link-download a {
		display: inline-block;
		background-color: white;
		background-repeat: no-repeat;
		background-position: 20px center;
		text-align: left;
		margin-left: 1.8%;
		margin-top: 30px;
		margin-bottom: 30px;
		padding: 17px 20px 15px 70px;
	}

	/**
	 * Icône des boutons de téléchargement navigateurs
	 * 1. Mozilla
	 * 2. Google Chrome
	 */

	.dl-mozilla { /* 1 */
		background-image: url('data:image/png;base64,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');
		}
	.dl-chrome { /* 2 */
		background-image: url('data:image/png;base64,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');
	}

	/**
	 * Bouton de fermeture du message d'alerte
	 */ 

	.link-download button {
		vertical-align: middle;
		width: 168px;
		background: #B94D48;
		color: white;
		font: bold 14px Arial;
		text-align: left;
		border: 0;
		padding: 15px 10px;
		cursor: pointer;
	}

	.link-download button:hover { background: #BE5E58; }

</style>

<div id="alert-ie">
	<div>
		<h2>Attention, vous utilisez un navigateur obsol&egrave;te</h2> <br>
		<p>
			Pour votre s&eacute;curit&eacute; et votre confort, nous vous recommandons d'utiliser un navigateur plus r&eacute;cent et &agrave; jour.
			<br><br> Pour connaitre les derni&egrave;res versions des navigateurs internet, consultez : <a href="http://browsehappy.com/" target="_blank">www.browsehappy.com</a>
		</p>
		<div class="link-download">
			<button onclick="masque_div()">Je continue <br> malgr&eacute; les risques</button>
			<a href="http://www.mozilla.org/fr/firefox/new/" target="_blank" class="dl-mozilla">T&eacute;l&eacute;charger <br> Mozilla Firefox</a>
			<a href="http://www.google.fr/intl/fr/chrome/browser/" target="_blank" class="dl-chrome">T&eacute;l&eacute;charger <br> Google Chrome</a>
		</div> <!-- /end .link-download -->
	</div>
</div> <!-- /end #alert-ie -->

<script type="text/javascript">

/*------------------------------------*\
    $SUPPRESSION DU BLOC AU CLIC
\*------------------------------------*/

function masque_div () {

	// ID du conteneur
	var el2 = document.getElementById("alert-ie");
	
	el2.parentNode.removeChild(el2);

}



/*------------------------------------*\
    $DETECTION DU NAVIGATEUR
\*------------------------------------*/


	var navU = navigator.userAgent;

	// Android Mobile
	var isAndroidMobile = navU.indexOf('Android') > -1 && navU.indexOf('Mozilla/5.0') > -1 && navU.indexOf('AppleWebKit') > -1;

	// Apple webkit
	var regExAppleWebKit = new RegExp(/AppleWebKit\/([\d.]+)/);
	var resultAppleWebKitRegEx = regExAppleWebKit.exec(navU);
	var appleWebKitVersion = (resultAppleWebKitRegEx === null ? null : parseFloat(regExAppleWebKit.exec(navU)[1]));

	// Chrome
	var regExChrome = new RegExp(/Chrome\/([\d.]+)/);
	var resultChromeRegEx = regExChrome.exec(navU);
	var chromeVersion = (resultChromeRegEx === null ? null : parseFloat(regExChrome.exec(navU)[1]));


	// Native Android Browser
	var isAndroidBrowser = isAndroidMobile && (appleWebKitVersion !== null && appleWebKitVersion < 537) || (chromeVersion !== null && chromeVersion < 37);

	// si on est sur "internet" navigateur defaut android
	if(isAndroidBrowser){
		document.write(' <style>#alert-ie { display: block;} </style>');
	}

	function get_browser(){
		var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
		if(/trident/i.test(M[1])){
			tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
			return {name:'IE',version:(tem[1]||'')};
			}   
		if(M[1]==='Chrome'){
			tem=ua.match(/\bOPR\/(\d+)/)
			if(tem!=null)   {return {name:'Opera', version:tem[1]};}
			}   
		M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
		if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
		return {
		  name: M[0],
		  version: M[1]
		};
	 }
 
	var browser=get_browser();
	

	// Native Android Browser
	var isAndroidBrowser = isAndroidMobile && (appleWebKitVersion !== null && appleWebKitVersion < 537) || (chromeVersion !== null && chromeVersion < 37);

	if(browser.name == 'Safari' && browser.version < 7){
		oldSafariBrowser = true;
	}
	
	// si on est sur "safari 7-" 
	if(oldSafariBrowser){
		document.write(' <style>#alert-ie { display: block;} </style>');
	}
</script>

<!--[if (lte IE 9)]><style>#alert-ie{ display: block;} </style><![endif]-->
