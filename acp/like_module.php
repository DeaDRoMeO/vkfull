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
class like_module
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
		$this->tpl_name = 'acp_like';
		$this->page_title = $this->user->lang('VK_LIKE');

		$form_key = 'acp_like';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			$vkbb_like_on = $this->request->variable('vkbb_like_on', 0);
			$this->config->set('vkbb_like_on', $vkbb_like_on);

			$vkbb_like_h = $this->request->variable('vkbb_like_h', '');
			$this->config->set('vkbb_like_h', $vkbb_like_h);
			$vkbb_like_t = $this->request->variable('vkbb_like_t', '');
			$this->config->set('vkbb_like_t', $vkbb_like_t);
			$vkbb_like_f = $this->request->variable('vkbb_like_f', 0);
			$this->config->set('vkbb_like_f', $vkbb_like_f);
	
			
			$vkbb_top_on_l = $this->request->variable('vkbb_top_on_l', 0);
			$this->config->set('vkbb_top_on_l', $vkbb_top_on_l);
			$vkbb_top_p_l = $this->request->variable('vkbb_top_p_l', 0);
			$this->config->set('vkbb_top_p_l', $vkbb_top_p_l);
			$vkbb_top_d_l = $this->request->variable('vkbb_top_d_l', '');
			$this->config->set('vkbb_top_d_l', $vkbb_top_d_l);
			$vkbb_top_k_l = $this->request->variable('vkbb_top_k_l', '');
			$this->config->set('vkbb_top_k_l', $vkbb_top_k_l);
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
						
			'VKBB_LIKE_ON'				=> isset($this->config['vkbb_like_on']) ? $this->config['vkbb_like_on'] : '',
			'VKBB_LIKE_H'				=> isset($this->config['vkbb_like_h']) ? $this->config['vkbb_like_h'] : '',
			'VKBB_LIKE_T'				=> isset($this->config['vkbb_like_t']) ? $this->config['vkbb_like_t'] : '',
			'VKBB_LIKE_F'				=> isset($this->config['vkbb_like_f']) ? $this->config['vkbb_like_f'] : '',
			
			'VKBB_TOP_ON_L'				=> isset($this->config['vkbb_top_on_l']) ? $this->config['vkbb_top_on_l'] : '',
			'VKBB_TOP_P_L'				=> isset($this->config['vkbb_top_p_l']) ? $this->config['vkbb_top_p_l'] : '',
			'VKBB_TOP_D_L'				=> isset($this->config['vkbb_top_d_l']) ? $this->config['vkbb_top_d_l'] : '',
			'VKBB_TOP_K_L'				=> isset($this->config['vkbb_top_k_l']) ? $this->config['vkbb_top_k_l'] : '',
			
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>