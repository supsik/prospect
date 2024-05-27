<header class="{% if headerClass is defined %}{{ headerClass }}{% endif %}">
	<div class="container">
		<div class="header__main">
			<a class="header__logo" href="/">
				<img src="/front/pages/img/logo.svg" alt="Logo">
			</a>
			<ul class="header__menu">
				<a href="/articles/news/"><li class="header__item">Новости</li></a>
				<a href="/archive/"><li class="header__item">Архив номеров</li></a>
				<a href="/articles/interview/"><li class="header__item">Интервью</li></a>
				<a href="/articles/person/"><li class="header__item">Персона</li></a>
				<a href="/articles/photoprojects/"><li class="header__item">Фотопроекты</li></a>
				<a href="/rubric/"><li class="header__item">Рубрики</li></a>
				<a href="/contacts/"><li class="header__item header__item-flex">Контакты</li></a>
			</ul>
			<div onclick="o2.mobileMenu.toggle()" class="header__burger _mobile-burger">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<div class="_overlay _mobile-menu-popup">
		<div class="_popup-content mobile-menu">
			<div class="mobile-menu__title">Разделы</div>
			<ul class="mobile-menu__list">
				<li><a href="/articles/news/" class="mobile-menu__item">Новости</a></li>
				<li><a href="/archive/" class="mobile-menu__item">Архив номеров</a></li>
				<li><a href="/articles/interview/" class="mobile-menu__item">Интервью</a></li>
				<li><a href="/articles/person/" class="mobile-menu__item">Персона</a></li>
				<li><a href="/articles/photoprojects/" class="mobile-menu__item">Фотопроекты</a></li>
				<li><a href="/rubric/" class="mobile-menu__item">Рубрики</a></li>
				<li><a href="/contacts/" class="mobile-menu__item">Контакты</a></li>
			</ul>
		</div>
	</div>
</header>
