<?php
class SearchAdd extends CWidget 
{

	public $name = "default";
	public $action = ""; 
	public $model = array();
	public $id = 'id';
	public $fields = array();
	public $delimiter = " ";
	public $visible = true;
	
	public $json = null;

	public function run() 
	{
		if(!$this->visible)
			return false;
		
		$array = array();
		$fields = is_array($this->fields) ? $this->fields : array($this->fields);
		foreach($this->model as $m)
		{
			$arr['id']=$m->{$this->id};
			$arr['name'] = '';
			foreach($fields as $field) 
			{
				$arr['name'] .= $m->{$field};
				if($this->has_next($fields))
					$arr['name'] .= $this->delimiter;
			}
			$array[]=$arr;
		}
		
		$this->json = CJavaScript::jsonEncode($array);
		
		$cs = Yii::app()->clientScript;
		$baseUrl = Yii::app()->baseUrl;
		$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap.typeahead.objects.array.js');
		$cs->registerCssFile($baseUrl.'/css/fff-icons.css');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap.tootltip.popover.min.js');
		$cs->registerScript('fff-icon-tooltip',"$('.fff-icon').tooltip()");
		
		$this->render('searchAdd');
	}
	
	private function has_next($array) {
		return next($array);
	}

}
?>