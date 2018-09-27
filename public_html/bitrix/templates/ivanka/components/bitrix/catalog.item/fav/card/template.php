<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
if($morePhoto[0]['ID']){
	$pic = $morePhoto[0]['ID'];
}else{
	$pic = $item["PREVIEW_PICTURE"]['ID'];
}
?>
<div class="item">
	<!-- // Unit -->
	<div class="catalog_unit">
		<!-- // Unit Info -->
		<div class="info-preview">
			<a href="#" class="delFav" data-id="<?=$item['ID']?>">X</a>
			<a class="unit_link" href="<?=$item['DETAIL_PAGE_URL']?>">
				<span class="thumb">
					<?$file = CFile::ResizeImageGet($pic, array('width'=>141, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
					<img  src="<?=$file["src"]?>" alt="<?=$item['NAME']?>">
				</span>
				<span class="unit-name"><?=$item['NAME']?></span>
			</a>

			<div class="block-info table_box">
				<div class="price">от <?=round($price['RATIO_PRICE']*0.95)?> <i class="fa fa-rub" aria-hidden="true"></i></div>
			</div>

			<div class="block-info params">
				<span class="fabric-name">Размер: <?=$item["PROPERTIES"]["RAZMER"]["VALUE"]?></span>
				<span class="fabric-name"><?=$item["PROPERTIES"]["SOSTAV"]["VALUE"]?></span>
				<span class="fabric-name">Цвет: <?=$item["PROPERTIES"]["TSVET"]["VALUE"]?></span>
			</div>

			<a href="<?=$item['DETAIL_PAGE_URL']?>" class="bttn_basket noAdd">добавить в корзину</a>

		</div>
		<!-- Unit Info // -->
	</div>
	<!-- Unit // -->
</div>
<!-- // Unit -->