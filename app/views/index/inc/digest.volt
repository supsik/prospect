<section class="digest">
	<div class="container">
		<div class="digest__flex">
			<div class="digest__block">
				{% if lastBlock|length != 0 %}
					<a href="{{ lastBlock[0].getUrl() }}">
						<div class="digest__block-image">
							<picture class="digest__img">
								<img src="{{ lastBlock[0].getImagePath() }}" alt="{{lastBlock[0].post_title}}">
							</picture>
						</div>
					</a>
					<div class="digest__desc">{{lastBlock[0].description}}</div>
				{% endif %}
			</div>
			<a href="{{ staticBlocks[1].url }}" class="digest__interview">
				<div class="digest__block-flex">
					{{ renderer.render(staticBlocks[1].getContent()) }}
				</div>
			</a>
		</div>
		{% if staticBlocks|length >= 5 %}
			<div class="digest__tablet">
				<a href="{{ randomBlock[0].url }}" class="digest__mini" onclick="o2.info.getUrl(this, event)">
					<div class="digest__block-image-flex" data-get="1">
						<picture class="digest__img-flex">
							<img src="{{ randomBlock[0].getImagePath() }}" alt="{{ randomBlock[0].post_title }}">
						</picture>
					</div>
					<p class="digest__description">
						{{ randomBlock[0].post_title }}.
						{{ randomBlock[0].description }}
					</p>
				</a>
				<a href="{{ randomBlock[1].url }}" class="digest__mini" onclick="o2.info.getUrl(this, event)">
					<div class="digest__block-image-flex" data-get="1">
						<picture class="digest__img-flex">
							<img src="{{ randomBlock[1].getImagePath() }}" alt="{{ randomBlock[0].post_title }}">
						</picture>
					</div>
					<p class="digest__description">
						{{ randomBlock[1].post_title }}.
						{{ randomBlock[1].description }}
					</p>
				</a>
				<a href="{{ staticBlocks[2].url }}" class="digest__record digest__record-felx">
					<div class="digest__block-fullhd">
						{{ renderer.render(staticBlocks[2].getContent()) }}
					</div>
				</a>
			</div>
		{% endif %}
		<div class="digest__container">
			<div class="digest__border"></div>
		</div>
	</div>
</section>
