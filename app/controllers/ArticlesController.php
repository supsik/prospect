<?php
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ArticlesController extends ControllerBase
{
	public $limit = 9;
	public $categoryTitles = [
		'news'          => ['title'=>'Новости'],
		'interview'     => ['title'=>'Интервью'],
		'person'        => ['title'=>'Персона'],
		'photoprojects' => ['title'=>'Фотопроекты'],
	];
	public function indexAction($category = false)
	{
		if(empty($this->categoryTitles[$category]))
			return $this->pageNotFound();
		$title = $this->categoryTitles[$category]['title'];
		$staticBlocks = StaticBlocks::find("code='{$category}_title' OR code='{$category}_description'");
		$this->view->setVar('pageTitle', '');
		$this->view->setVar('pageDescription', '');
		foreach($staticBlocks as $block)
		{
			$content = json_decode($block->content);
			if(empty($content->blocks[0]->data->text))
				continue;
			if($block->code == "{$category}_title")
			{
				$this->view->setVar('pageTitle', $content->blocks[0]->data->text);
			}
			else
			{
				$this->view->setVar('pageDescription', $content->blocks[0]->data->text);
			}
		}
		$this->view->setVar('title',"{$title} | Проспект Северный Кавказ");
		$this->view->setVar('pageName',$title);
		$posts = Posts::find([
			'conditions' => 'category = ?0 AND is_active = 1',
			'bind'       => [$category],
			'limit'      => $this->limit,
			'order'      => 'post_date DESC',
		]);
		$this->view->setVar('posts',$posts);
	}

	/**
	 * постраничная навигация постов
	 */
	public function getNextPageAction()
	{
		$page     = intval($this->request->getPost('page', 'int', 1)) + 1;
		$category = $this->request->getPost('category', 'string', '');
		$find = ['conditions' => 'is_active = 1', 'order' => 'post_date DESC'];
		if (!empty($category))
		{
			$find['conditions'] .= ' AND category = ?0';
			$find['bind'] = [$category];
		}

		$posts = Posts::find($find);
		$posts = new PaginatorModel([
			'data'  => $posts,
			'model' => 'Posts',
			'limit' => $this->limit,
			'page'  => $page,
		]);
		$posts = $posts->getPaginate();
		if ($posts->last < $page)
			$posts->items = [];

		return $this->jsonResult(['success' => true, 'result' => $posts]);
	}

	public function detailAction($code)
	{
		$article = Posts::findFirstByPostName($code);
		$recommended = Posts::find([
			'conditions' => 'id != ?0 AND category = ?1 AND is_active = 1',
			'bind'       => [$article->id, $article->category],
			'limit'      => 3,
			'order'      => 'post_date DESC',
		]);
		$renderer = new CodexToHtml();
		$blocks = json_decode($article->post_content, true);
		if (empty($blocks['blocks']))
			$blocks = [];
		else
			$blocks = $blocks['blocks'];
		$this->view->setVar('title',"{$article->post_title} | {$article->categoryName}");
		$this->view->setVar('metaKeywords', $article->meta_keywords);
		$this->view->setVar('metaDescription', $article->description);
		if (empty($article)) return $this->pageNotFound();
		$ajax = $this->request->get('ajax');
		if($ajax == 1)
		{
			$template = $this->view->getPartial('articles/detail_inc',
				[
					'article' => $article,
					'recommended' => $recommended,
					'blocks' => $blocks,
					'renderer' => $renderer,
				]
			);
			$this->jsonResult(['data' => $template]);
		}

		$this->view->setVar('renderer', $renderer);
		$this->view->setVar('blocks', $blocks);
		$this->view->setVar('article', $article);
		$this->view->setVar('recommended', $recommended);
		$this->view->setVar('gallery', $article->getGallery());
		if (!$article->is_wide)
			$this->view->setVar('headerClass', 'header--dark');
	}
}
