<section class="author">
	<div class="container author__container">
		<div class="author__block">
			<img src="{{ article.author.getAvatar() }}" alt="{{ article.author.name }}" class="author__img">
			<div class="author__data">
				<h2 class="author__title">Автор материала</h1>
				<h3 class="author__name">{{ article.author.name }}</h2>
			</div>
			<div class="author__tags">
				<div href="#" class="author__tag">{{ article.author.name }}</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="author__border"></div>
	</div>
</section>
