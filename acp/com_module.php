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
class com_module
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
		$this->tpl_name = 'acp_com';
		$this->page_title = $this->user->lang('VK_COM');

		$form_key = 'acp_com';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			
			$vkbb_com_on = $this->request->variable('vkbb_com_on', 0);
			$this->config->set('vkbb_com_on', $vkbb_com_on);		
			$vkbb_com_on_i = $this->request->variable('vkbb_com_on_i', 0);
			$this->config->set('vkbb_com_on_i', $vkbb_com_on_i);
			$vkbb_com_i_p = $this->request->variable('vkbb_com_i_p', 0);
			$this->config->set('vkbb_com_i_p', $vkbb_com_i_p);
			$vkbb_com_h = $this->request->variable('vkbb_com_h', '');
			$this->config->set('vkbb_com_h', $vkbb_com_h);
			$vkbb_com_k = $this->request->variable('vkbb_com_k', '');
			$this->config->set('vkbb_com_k', $vkbb_com_k);
			
			$vkbb_top_on_c = $this->request->variable('vkbb_top_on_c', 0);
			$this->config->set('vkbb_top_on_c', $vkbb_top_on_c);
			$vkbb_top_p_c = $this->request->variable('vkbb_top_p_c', 0);
			$this->config->set('vkbb_top_p_c', $vkbb_top_p_c);
			$vkbb_top_d_c = $this->request->variable('vkbb_top_d_c', '');
			$this->config->set('vkbb_top_d_c', $vkbb_top_d_c);
			$vkbb_top_k_c = $this->request->variable('vkbb_top_k_c', '');
			$this->config->set('vkbb_top_k_c', $vkbb_top_k_c);
				
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
			
			'VKBB_COM_ON'				=> isset($this->config['vkbb_com_on']) ? $this->config['vkbb_com_on'] : '',
			'VKBB_COM_ON_I'				=> isset($this->config['vkbb_com_on_i']) ? $this->config['vkbb_com_on_i'] : '',
			'VKBB_COM_I_P'				=> isset($this->config['vkbb_com_i_p']) ? $this->config['vkbb_com_i_p'] : '',
			'VKBB_COM_H'				=> isset($this->config['vkbb_com_h']) ? $this->config['vkbb_com_h'] : '',
			'VKBB_COM_K'				=> isset($this->config['vkbb_com_k']) ? $this->config['vkbb_com_k'] : '',
			
			'VKBB_TOP_ON_C'				=> isset($this->config['vkbb_top_on_c']) ? $this->config['vkbb_top_on_c'] : '',
			'VKBB_TOP_P_C'				=> isset($this->config['vkbb_top_p_c']) ? $this->config['vkbb_top_p_c'] : '',
			'VKBB_TOP_D_C'				=> isset($this->config['vkbb_top_d_c']) ? $this->config['vkbb_top_d_c'] : '',
			'VKBB_TOP_K_C'				=> isset($this->config['vkbb_top_k_c']) ? $this->config['vkbb_top_k_c'] : '',
			
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>