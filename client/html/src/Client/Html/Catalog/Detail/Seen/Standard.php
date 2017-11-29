<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2017
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Catalog\Detail\Seen;


/**
 * Default implementation for last seen products.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/catalog/detail/seen/standard/subparts
	 * List of HTML sub-clients rendered within the catalog detail seen section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartPath = 'client/html/catalog/detail/seen/standard/subparts';
	private $subPartNames = [];


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( $uid = '' )
	{
		return '';
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( $type, $name = null )
	{
		/** client/html/catalog/detail/seen/decorators/excludes
		 * Excludes decorators added by the "common" option from the catalog detail seen html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/catalog/detail/seen/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/detail/seen/decorators/global
		 * @see client/html/catalog/detail/seen/decorators/local
		 */

		/** client/html/catalog/detail/seen/decorators/global
		 * Adds a list of globally available decorators only to the catalog detail seen html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/detail/seen/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/detail/seen/decorators/excludes
		 * @see client/html/catalog/detail/seen/decorators/local
		 */

		/** client/html/catalog/detail/seen/decorators/local
		 * Adds a list of local decorators only to the catalog detail seen html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Catalog\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/detail/seen/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Catalog\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/detail/seen/decorators/excludes
		 * @see client/html/catalog/detail/seen/decorators/global
		 */

		return $this->createSubClient( 'catalog/detail/seen/' . $type, $name );
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames()
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Processes the input, e.g. store given values.
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables.
	 */
	public function process()
	{
		if( ( $id = $this->getView()->param( 'd_prodid' ) ) !== null )
		{
			$context = $this->getContext();
			$session = $context->getSession();
			$lastSeen = $session->get( 'aimeos/catalog/session/seen/list', [] );

			if( isset( $lastSeen[$id] ) )
			{
				$html = $lastSeen[$id];
				unset( $lastSeen[$id] );
				$lastSeen[$id] = $html;
			}
			else
			{
				/** client/html/catalog/session/seen/standard/maxitems
				 * Maximum number of products displayed in the "last seen" section
				 *
				 * This option limits the number of products that are shown in the
				 * "last seen" section after the user visited their detail pages. It
				 * must be a positive integer value greater than 0.
				 *
				 * @param integer Number of products
				 * @since 2014.03
				 * @category User
				 * @category Developer
				 */
				$max = $this->getContext()->getConfig()->get( 'client/html/catalog/session/seen/standard/maxitems', 6 );

				$lastSeen[$id] = $this->getHtml( $id );
				$lastSeen = array_slice( $lastSeen, -$max, $max, true );
			}

			$session->set( 'aimeos/catalog/session/seen/list', $lastSeen );

			foreach( $session->get( 'aimeos/catalog/session/seen/cache', [] ) as $key => $value ) {
				$session->set( $key, null );
			}
		}

		parent::process();
	}


	/**
	 * Returns the generated HTML for the given product ID.
	 *
	 * @param string $id Product ID
	 * @return string HTML of the last seen item for the given product ID
	 */
	protected function getHtml( $id )
	{
		$context = $this->getContext();
		$cache = $context->getCache();
		$key = md5( $id . 'product:detail-seen' );

		if( ( $html = $cache->get( $key ) ) === null )
		{
			$expire = null;
			$tags = [];
			$view = $this->getView();
			$config = $context->getConfig();

			$default = array( 'media', 'price', 'text' );
			$domains = $config->get( 'client/html/catalog/domains', $default );

			/** client/html/catalog/detail/seen/domains
			 * A list of domain names whose items should be available in the last seen view template for the product
			 *
			 * The templates rendering product details usually add the images,
			 * prices and texts, etc. associated to the product
			 * item. If you want to display additional or less content, you can
			 * configure your own list of domains (attribute, media, price, product,
			 * text, etc. are domains) whose items are fetched from the storage.
			 * Please keep in mind that the more domains you add to the configuration,
			 * the more time is required for fetching the content!
			 *
			 * @param array List of domain names
			 * @since 2014.07
			 * @category Developer
			 * @see client/html/catalog/domains
			 * @see client/html/catalog/lists/domains
			 * @see client/html/catalog/detail/domains
			 */
			$domains = $config->get( 'client/html/catalog/detail/seen/domains', $domains );

			$controller = \Aimeos\Controller\Frontend\Factory::createController( $context, 'product' );
			$view->seenProductItem = $controller->getItem( $id, $domains );
			$this->addMetaItems( $view->seenProductItem, $expire, $tags );

			$output = '';
			foreach( $this->getSubClients() as $subclient ) {
				$output .= $subclient->setView( $view )->getBody( '', $tags, $expire );
			}
			$view->seenBody = $output;

			/** client/html/catalog/detail/seen/standard/template-body
			 * Relative path to the HTML body template of the catalog detail seen client.
			 *
			 * The template file contains the HTML code and processing instructions
			 * to generate the result shown in the body of the frontend. The
			 * configuration string is the path to the template file relative
			 * to the templates directory (usually in client/html/templates).
			 *
			 * You can overwrite the template file configuration in extensions and
			 * provide alternative templates. These alternative templates should be
			 * named like the default one but with the string "standard" replaced by
			 * an unique name. You may use the name of your project for this. If
			 * you've implemented an alternative client class as well, "standard"
			 * should be replaced by the name of the new class.
			 *
			 * @param string Relative path to the template creating code for the HTML page body
			 * @since 2014.03
			 * @category Developer
			 * @see client/html/catalog/detail/seen/standard/template-header
			 */
			$tplconf = 'client/html/catalog/detail/seen/standard/template-body';
			$default = 'catalog/detail/seen-partial-default.php';

			$html = $view->render( $view->config( $tplconf, $default ) );

			$cache->set( $key, $html, $expire, $tags );
		}

		return $html;
	}
}