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
class rec_module
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
		$this->tpl_name = 'acp_rec';
		$this->page_title = $this->user->lang('VK_REC');

		$form_key = 'acp_rec';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			$vkbb_rec_on = $this->request->variable('vkbb_rec_on', 0);
			$this->config->set('vkbb_rec_on', $vkbb_rec_on);
			$vkbb_rec_p = $this->request->variable('vkbb_rec_p', 0);
			$this->config->set('vkbb_rec_p', $vkbb_rec_p);
			$vkbb_rec_mp = $this->request->variable('vkbb_rec_mp', '');
			$this->config->set('vkbb_rec_mp', $vkbb_rec_mp);
			$vkbb_rec_mpm = $this->request->variable('vkbb_rec_mpm', '');
			$this->config->set('vkbb_rec_mpm', $vkbb_rec_mpm);
			$vkbb_rec_per = $this->request->variable('vkbb_rec_per', '');
			$this->config->set('vkbb_rec_per', $vkbb_rec_per);
			$vkbb_rec_ver = $this->request->variable('vkbb_rec_ver', 0);
			$this->config->set('vkbb_rec_ver', $vkbb_rec_ver);
			$vkbb_rec_targ = $this->request->variable('vkbb_rec_targ', '');
			$this->config->set('vkbb_rec_targ', $vkbb_rec_targ);
					
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
							
			'VKBB_REC_ON'				=> isset($this->config['vkbb_rec_on']) ? $this->config['vkbb_rec_on'] : '',
			'VKBB_REC_P'				=> isset($this->config['vkbb_rec_p']) ? $this->config['vkbb_rec_p'] : '',
			'VKBB_REC_MP'				=> isset($this->config['vkbb_rec_mp']) ? $this->config['vkbb_rec_mp'] : '',
			'VKBB_REC_MPM'				=> isset($this->config['vkbb_rec_mpm']) ? $this->config['vkbb_rec_mpm'] : '',
			'VKBB_REC_PER'				=> isset($this->config['vkbb_rec_per']) ? $this->config['vkbb_rec_per'] : '',
			'VKBB_REC_VER'				=> isset($this->config['vkbb_rec_ver']) ? $this->config['vkbb_rec_ver'] : '',
			'VKBB_REC_TARG'				=> isset($this->config['vkbb_rec_targ']) ? $this->config['vkbb_rec_targ'] : '',
						
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>