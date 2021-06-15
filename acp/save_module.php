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

/**
* @package acp
*/
class save_module
{
	protected $config;
	protected $request;
	protected $template;
	protected $user;

	public $u_action;

	function main($id, $mode)
	{
		global $config, $request, $template, $user;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;

		$this->user->add_lang('acp/common');
		$this->tpl_name = 'acp_save';
		$this->page_title = $this->user->lang('VK_SAVE');

		$form_key = 'acp_save';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			
			$vkbb_save_on = $this->request->variable('vkbb_save_on', 0);
			$this->config->set('vkbb_save_on', $vkbb_save_on);
			$vkbb_save_p = $this->request->variable('vkbb_save_p', 0);
			$this->config->set('vkbb_save_p', $vkbb_save_p);
			$vkbb_save_l = $this->request->variable('vkbb_save_l', 0);
			$this->config->set('vkbb_save_l', $vkbb_save_l);
			
			$vkbb_save_lt = $this->request->variable('vkbb_save_lt', '');
			$this->config->set('vkbb_save_lt', $vkbb_save_lt);
			$save_style = $this->request->variable('save_style', '');
			$this->config->set('save_style', $save_style);
			$save_text = utf8_normalize_nfc(request_var('save_text', '', true));
			$this->config->set('save_text', $save_text);
				
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
			
			'VKBB_SAVE_ON'				=> isset($this->config['vkbb_save_on']) ? $this->config['vkbb_save_on'] : '',
			'VKBB_SAVE_P'				=> isset($this->config['vkbb_save_p']) ? $this->config['vkbb_save_p'] : '',
			'VKBB_SAVE_L'				=> isset($this->config['vkbb_save_l']) ? $this->config['vkbb_save_l'] : '',
			'VKBB_SAVE_LT'				=> isset($this->config['vkbb_save_lt']) ? $this->config['vkbb_save_lt'] : '',
			'SAVE_STYLE'				=> isset($this->config['save_style']) ? $this->config['save_style'] : '',
			'SAVE_TEXT'				=> isset($this->config['save_text']) ? $this->config['save_text'] : '',
			
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>