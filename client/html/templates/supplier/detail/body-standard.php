<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2020
 */

/* Available data:
 * - detailSupplierItem : Supplier item incl. referenced items
 */


$enc = $this->encoder();


?>
<section class="aimeos supplier-detail" itemscope="" itemtype="http://schema.org/Organization" data-jsonurl="<?= $enc->attr( $this->link( 'client/jsonapi/url' ) ); ?>">

	<?php if( isset( $this->detailErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->detailErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>


	<?php if( isset( $this->detailSupplierItem ) ) : ?>

		<article class="supplier row">

			<div class="supplier-detail-image col-sm-6">
				<div class="image-single">

					<?php foreach( $this->detailSupplierItem->getRefItems( 'media', 'default', 'default' ) as $id => $mediaItem ) : ?>
						<div id="image-<?= $enc->attr( $id ); ?>" class="media-item">
							<?= $this->image( $mediaItem ) ?>
						</div>
					<?php endforeach; ?>

				</div>
			</div>

			<div class="col-sm-6">

				<div class="supplier-detail-basic">
					<h1 class="name" itemprop="name"><?= $enc->html( $this->detailSupplierItem->getName(), $enc::TRUST ); ?></h1>

					<?php foreach( $this->detailSupplierItem->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
						<p class="short" itemprop="description"><?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></p>
					<?php endforeach; ?>
				</div>

			</div>


			<div class="col-sm-12">

				<div class="supplier-detail-additional">

					<?php if( !( $textItems = $this->detailSupplierItem->getRefItems( 'text', 'long' ) )->isEmpty() ) : ?>

						<div class="additional-box">
							<h2 class="header description"><?= $enc->html( $this->translate( 'client', 'Description' ), $enc::TRUST ); ?></h2>
							<div class="content description">

								<?php foreach( $textItems as $textItem ) : ?>
									<div class="long item"><?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></div>
								<?php endforeach; ?>

							</div>
						</div>

					<?php endif; ?>

				</div>

			</div>

		</article>

	<?php endif; ?>

</section>
