<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\acp;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

class soc_info
{
	function module()
	{
		return array(
			'filename'	=> '\deadromeo\vkfull\soc_module',
			'title'		=> 'VK_SOC',
			'modes'		=> array(
				'vkfull_soc' => array('title' => 'VK_SOC', 'auth' => 'ext_deadromeo/vkfull && acl_a_board', 'cat' => array('VK_BB')),
			),
		);
	}
}

?>