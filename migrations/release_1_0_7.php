<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\migrations;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

class release_1_0_7 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.7', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_0_6');
	}		
		
	public function update_data()
	{
		return array(	
			array('config.add', array('vkbb_top_on_c', 0)),
			array('config.add', array('vkbb_top_p_c', 0)),
			array('config.add', array('vkbb_top_on_l', 0)),
			array('config.add', array('vkbb_top_p_l', 0)),
			array('config.add', array('vkbb_top_d_l', '')),
			array('config.add', array('vkbb_top_k_l', '')),
			array('config.add', array('vkbb_top_d_c', '')),
			array('config.add', array('vkbb_top_k_c', '')),		
			
			array('config.add', array('vk_version', '1.0.7')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.7', '<')),
				array('config.update', array('vk_version', '1.0.7')),
			)),
			
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('vkbb_top_on_c')),
			array('config.remove', array('vkbb_top_p_c')),
			array('config.remove', array('vkbb_top_on_l')),
			array('config.remove', array('vkbb_top_p_l')),
			array('config.remove', array('vkbb_top_d_l')),
			array('config.remove', array('vkbb_top_k_l')),
			array('config.remove', array('vkbb_top_d_c')),
			array('config.remove', array('vkbb_top_k_c')),

		);
	}
}