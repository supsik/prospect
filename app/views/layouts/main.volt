<!DOCTYPE html>
<html>
<head>
    <!--[if IE 6]>		<html id="section-reco_main" class="nojs ie6 ieb7 ieb8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 7]>		<html id="section-reco_main" class="nojs iea6 ie7 ieb8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 8]>		<html id="section-reco_main" class="nojs iea6 iea7 ie8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 9]>		<html id="section-reco_main" class="nojs iea6 iea7 iea8 ie9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<meta name="viewport" content="width=device-width">
	<meta name="MobileOptimized" content="320"/>
	<meta name="HandheldFriendly" content="true"/>
	<meta charset="utf-8">
	<meta name="viewport min-width=320px" content="min-width=320, initial-scale=1.0" />
	<link rel="stylesheet" preload="auto" type="text/css" href="/front/pages/style.css?v=1">
	<link rel="shortcut icon" href="/public/upload/small_9d8d744de7fd5a7dd9794cd29568e007.png">
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->
	<title>{{ title }}</title>
	<!-- TODO: add prod script -->
	<!-- WHATSAPP WIDGET -->
	<script>(function () { var widget = document.createElement('script'); widget.dataset.pfId = 'c0911108-91c6-433d-b843-589ea517dfb0'; widget.src = 'https://widget.yourgood.app/script/widget.js?id=c0911108-91c6-433d-b843-589ea517dfb0&now='+Date.now(); document.head.appendChild(widget); })()</script>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
		(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(82836607, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true
		});
	</script>
	<script>
		window.addEventListener('popstate', function(){
			location.reload();
		});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/82836607" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
	{% if metaDescription is defined %}
		<meta name="description" content="{{ metaDescription }}">
	{% endif %}
	{% if metaKeywords is defined %}
		<meta name="keywords" content="{{ metaKeywords }}">
	{% endif %}
</head>
<body>
	{% include "inc/header.volt" %}
	<main>
	{% block page %}{% endblock %}
	</main>
	{% include "inc/footer.volt" %}
	<script type="text/javascript" src="/front/pages/main.min.js" defer="" async=""></script>
</body>
</html>
