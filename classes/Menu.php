<?php
/**
 * This file is part of the SetUI module.
 *
 * @license MIT License
 * @copyright 2015 Steve "uru" West
 * @author Steve "uru" West <steven.david.west@gmail.com>
 */

namespace SetUI;

use Arr;
use Orm\Model_Nestedset;
use Theme;
use Uri;
use View;

/**
 * Responsible for building the nested set menu.
 *
 * @package SetUI
 * @author Steve "uru" West <steven.david.west@gmail.com>
 */
class Menu
{

	/**
	 * Contains various settings for building the menu
	 * @var array
	 */
	protected $config = [
		// This is each leaf of the tree, by default it has a link and a list of children
		'leafView' => 'setui::setui/leaf',
		// This is the list of children for each leaf
		'listView' => 'setui::setui/list',
		// This is the top level container, it can be used for adding style around the list
		'containerView' => 'setui::setui/container',
		// If not set to null will be treated as an instance of Theme for loading views
		'themeInstance' => null,
		// Property name of the model to load the leaf name from
		'nameProperty' => 'name',
		// Set to true to display the root node of the tree
		'includeRoot' => false,
		// What to prepend to the URL before it is passed to Uri::create()
		'uriPrefix' => '',
	];

	public function __construct($config = [])
	{
		$this->config = array_merge($this->config, $config);
	}

	/**
	 * @param Model_Nestedset $tree
	 *
	 * @return View
	 */
	public function build(Model_Nestedset $tree)
	{
		if ($this->config['includeRoot'])
		{
			$content = $this->buildBranch($tree);
		}
		else
		{
			$content = [];
			foreach($tree->children()->get() as $child)
			{
				$content[] = $this->buildBranch($child);
			}
		}

		return $this->loadView(
			$this->config['containerView'],
			['content' => $content]
		);
	}

	/**
	 * Builds the view for a given node.
	 *
	 * @param Model_Nestedset $node
	 *
	 * @return View
	 */
	protected function buildBranch(Model_Nestedset $node)
	{
		$branches = [];
		$branchView = '';

		// Check if the node has children and add them too if needed
		if ($node->has_children())
		{
			foreach ($node->children()->get() as $child)
			{
				$branches[] = $this->buildBranch($child);
			}

			$branchView = $this->loadView(
				$this->config['listView'],
				['branches' => $branches]
			);
		}

		$nameProperty = $this->config['nameProperty'];

		$path = Uri::create(
			$this->config['uriPrefix'] . $node->path($this->config['includeRoot'])->get()
		);

		return $this->loadView(
			$this->config['leafView'],
			[
				'url' => $path,
				'name' => $node->{$nameProperty},
				'branches' => $branchView,
			]
		);
	}

	/**
	 * Constructs and returns a View object
	 *
	 * @param string $name Name of the view to load
	 * @param array  $data Data to pass to the view
	 *
	 * @return View
	 */
	protected function loadView($name, $data = [])
	{
		if (Arr::get($this->config, 'themeInstance') !== null)
		{
			// We have a theme instance so try and use that to load the view
			/** @var Theme $themeInstance */
			$themeInstance = $this->config['themeInstance'];
			return $themeInstance->view($name, $data);
		}

		return View::forge($name, $data);
	}

}
