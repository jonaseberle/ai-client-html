<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2017
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Checkout\Standard\Summary;


// Strings for translation
sprintf( 'summary' );


/**
 * Default implementation of checkout summary HTML client.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Summary\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/checkout/standard/summary/standard/subparts
	 * List of HTML sub-clients rendered within the checkout standard summary section
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
	private $subPartPath = 'client/html/checkout/standard/summary/standard/subparts';
	private $subPartNames = [];


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( $uid = '' )
	{
		$view = $this->getView();
		$step = $view->get( 'standardStepActive' );
		$onepage = $view->config( 'client/html/checkout/standard/onepage', [] );

		if( $step != 'summary' && !( in_array( 'summary', $onepage ) && in_array( $step, $onepage ) ) ) {
			return '';
		}

		$html = '';
		foreach( $this->getSubClients() as $subclient ) {
			$html .= $subclient->setView( $view )->getBody( $uid, $tags, $expire );
		}
		$view->summaryBody = $html;

		/** client/html/checkout/standard/summary/standard/template-body
		 * Relative path to the HTML body template of the checkout standard summary client.
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
		 * @see client/html/checkout/standard/summary/standard/template-header
		 */
		$tplconf = 'client/html/checkout/standard/summary/standard/template-body';
		$default = 'checkout/standard/summary-body-default.php';

		return $view->render( $view->config( $tplconf, $default ) );
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( $uid = '' )
	{
		$view = $this->getView();
		$step = $view->get( 'standardStepActive' );
		$onepage = $view->config( 'client/html/checkout/standard/onepage', [] );

		if( $step != 'summary' && !( in_array( 'summary', $onepage ) && in_array( $step, $onepage ) ) ) {
			return '';
		}

		return parent::getHeader( $uid );
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
		/** client/html/checkout/standard/summary/decorators/excludes
		 * Excludes decorators added by the "common" option from the checkout standard summary html client
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
		 *  client/html/checkout/standard/summary/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/summary/decorators/global
		 * @see client/html/checkout/standard/summary/decorators/local
		 */

		/** client/html/checkout/standard/summary/decorators/global
		 * Adds a list of globally available decorators only to the checkout standard summary html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/checkout/standard/summary/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/summary/decorators/excludes
		 * @see client/html/checkout/standard/summary/decorators/local
		 */

		/** client/html/checkout/standard/summary/decorators/local
		 * Adds a list of local decorators only to the checkout standard summary html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Checkout\Decorator\*") around the html client.
		 *
		 *  client/html/checkout/standard/summary/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Checkout\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/summary/decorators/excludes
		 * @see client/html/checkout/standard/summary/decorators/global
		 */

		return $this->createSubClient( 'checkout/standard/summary/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. store given values.
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables.
	 */
	public function process()
	{
		$view = $this->getView();

		try
		{
			if( $view->param( 'cs_order', null ) === null ) {
				return;
			}


			$controller = \Aimeos\Controller\Frontend\Factory::createController( $this->getContext(), 'basket' );

			if( ( $comment = $view->param( 'cs_comment' ) ) !== null )
			{
				$controller->get()->setComment( $comment );
				$controller->save();
			}


			// only start if there's something to do
			if( $view->param( 'cs_option_terms', null ) !== null
				&& ( $option = $view->param( 'cs_option_terms_value', 0 ) ) != 1
			) {
				$error = $view->translate( 'client', 'Please accept the terms and conditions' );
				$errors = $view->get( 'summaryErrorCodes', [] );
				$errors['option']['terms'] = $error;

				$view->summaryErrorCodes = $errors;
				$view->standardStepActive = 'summary';
				$view->standardErrorList = array( $error ) + $view->get( 'standardErrorList', [] );
			}


			parent::process();

			$controller->get()->check( \Aimeos\MShop\Order\Item\Base\Base::PARTS_ALL );
		}
		catch( \Exception $e )
		{
			$view->standardStepActive = 'summary';
			throw $e;
		}
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
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\MW\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\MW\View\Iface Modified view object
	 */
	public function addData( \Aimeos\MW\View\Iface $view, array &$tags = [], &$expire = null )
	{
		$context = $this->getContext();

		if( ( $view->summaryCustomerId = $context->getUserId() ) === null )
		{
			try
			{
				$addr = $view->standardBasket->getAddress( \Aimeos\MShop\Order\Item\Base\Address\Base::TYPE_PAYMENT );
				$controller = \Aimeos\Controller\Frontend\Factory::createController( $context, 'customer' );
				$view->summaryCustomerId = $controller->findItem( $addr->getEmail() )->getId();
			}
			catch( \Exception $e ) {}
		}

		$view->summaryTaxRates = $this->getTaxRates( $view->standardBasket );

		return parent::addData( $view, $tags, $expire );
	}
}
