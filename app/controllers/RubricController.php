<?php
class RubricController extends ControllerBase
{
	public function indexAction()
	{
		$rubric = Posts::find([
			"(category = 'headings')  AND is_active != 0",
			"order" => "post_date DESC",
		]);

		if (count($rubric) > 0)
		{
			$this->view->setVar('rubric', $rubric);
		}
		$staticBlocks = StaticBlocks::find("code='rubric_title' OR code='rubric_description'");
		$this->view->setVar('rubricTitle', '');
		$this->view->setVar('rubricDescription', '');
		foreach($staticBlocks as $block)
		{
			$content = json_decode($block->content);
			if(empty($content->blocks[0]->data->text))
				continue;
			if($block->code == 'rubric_title')
			{
				$this->view->setVar('rubricTitle', $content->blocks[0]->data->text);
			}
			else
			{
				$this->view->setVar('rubricDescription', $content->blocks[0]->data->text);
			}
		}
	}
}
