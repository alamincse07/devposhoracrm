<?php

namespace common\components;

use yii\base\Component;


class ApuComponent extends Component
{
    public function adminpath()
    {
        return "/poshoracrm/admin";
    }
	public function downloadpath()
    {
        return "https://proedge-asso.com/poshoracrm/frontend";
    }
	
	
 
	public function sesdata($sesfield)
    {
        return \Yii::$app->session->get('user.'.$sesfield);
    }
	
	
	public function formatTextToHTML($text)
	{
		return str_replace("\n", "<br>", $text); // add &nbsp; to allow html multi-line breaks
	}

	public function formatHTMLToText($html)
	{
		return str_replace("<br>", "\n", $html);
	}
	
}



?>