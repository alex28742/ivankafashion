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
$firstSize = 0;
$lastSize = 0;
foreach ($arParams['SKU_PROPS'] as $skuProperty)
{
	$propertyId = $skuProperty['ID'];
	$skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
	if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
		continue;

	uasort($skuProperty["VALUES"], 'cmp_function');
	foreach ($skuProperty['VALUES'] as $value)
	{
		if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
			continue;

		if($firstSize==0) $firstSize = htmlspecialcharsbx($value['NAME']);
		$lastSize = htmlspecialcharsbx($value['NAME']);
	}




	/*uasort($skuProperty["VALUES"], 'cmp_function');
	foreach($skuProperty["VALUES"] as $value){
		$propertyId = $skuProperty['ID'];
		if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))continue;
		if($value['ID']>0){
			$firstSize = $value["NAME"];
			break;
		}
	}
	$lastSize = end($skuProperty["VALUES"])["NAME"];*/
}

?>
<!-- // Unit -->
<div class="catalog_unit">
	<div class="catalog_unit_inner">

		<!-- // Unit Gallery -->
		<div class="gallery-preview">
			<ul>
				<?foreach ($morePhoto as $key => $photo)
				{
					$file = CFile::ResizeImageGet($photo['ID'], array('width'=>240, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					?>
					<li<?if($key==0){?> class="active"<?}?>><img src="<?=$file['src']?>" alt="" class="prev-img" data-src="<?=$photo['SRC']?>"></li>
					<?
				}
				?>
			</ul>
		</div>
		<!-- Unit Gallery // -->

		<!-- // Unit Info -->
		<div class="info-preview">

			<a class="unit_link" href="<?=$item['DETAIL_PAGE_URL']?>">
				<span class="thumb">
					<div class="shilds">
						<?if($item["PROPERTIES"]["NOVINKA"]["VALUE"]=="Да"){?>
							<div class="label new"></div><!-- Novinka -->
						<?}
						if($item["PROPERTIES"]["AKTSIYA"]["VALUE"]=="Да"){?>
							<div class="label act"></div><!-- Novinka -->
						<?}
						if($item["PROPERTIES"]["SKORO_V_PRODAZHE"]["VALUE"]=="Да"){?>
							<div class="label soon"></div><!-- Novinka -->
						<?}
						if($item["PROPERTIES"]["SKIDKA"]["VALUE"]=="Да"){?>
							<div class="label discount"></div><!-- Novinka -->
						<?}?>
					</div>

					<?$file = CFile::ResizeImageGet($morePhoto[0]['ID'], array('width'=>240, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
					<span style="background-image:url(<?=$file["src"]?>)"></span>
					<button class="submit" data-href="<?=$item['DETAIL_PAGE_URL']?>?ajaxCatalog=Y&SECTIONS_ID=<?=$item["IBLOCK_SECTION_ID"]?>">Быстрый просмотр</button>
				</span>
				<span class="unit-name"><?=$productTitle?></span>
				<span class="fabric-name"><?=$item["PROPERTIES"]["MATERIAL"]["VALUE"][0]?></span>
			</a>
<?/*?>
			<pre>
			<?//print_r($arParams['SKU_PROPS']);?>
			</pre>
<?*/?>
			<div class="block-info table_box">
				<div class="price">от <?=round($price['RATIO_PRICE']*0.95)?> <i class="fa fa-rub" aria-hidden="true"></i></div>
				<div class="size">Разм: <?=$firstSize?>-<?=$lastSize?></div>
				<div class="add_basket tooltip"><a href="#" data-id="<?=$item["ID"]?>"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Отложить на потом</span></a></div>
				<div class="add_favorit tooltip"><a data-id="<?=$item["ID"]?>" data-href="<?=$item['DETAIL_PAGE_URL']?>?ajaxCatalog=Y&SECTIONS_ID=<?=$item["IBLOCK_SECTION_ID"]?>" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Добавить в корзину</span></a></div>
			</div>

		</div>
		<!-- Unit Info // -->
		<div class="clearfix"></div>

		<div class="block-dop-info clearfix" >
			<form id="formQuantity_<?=$item["ID"]?>">
			<?if($lastSize!="0"){?>
			<label>
				<input autocomplete="off" name="quantity_all" value="0" readonly="" class="quantity-text" type="text">
				<span class="buttons">
					<button class="button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
					<button class="button" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
				</span>
				<span class="size">Все</span>
			</label>
			<?}?>
			<?foreach ($arParams['SKU_PROPS'] as $skuProperty)
			{
				$propertyId = $skuProperty['ID'];
				$skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
				if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
					continue;
				?>
				<?
				uasort($skuProperty["VALUES"], 'cmp_function');
				foreach ($skuProperty['VALUES'] as $value)
				{
					if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
						continue;

					$value['NAME'] = htmlspecialcharsbx($value['NAME']);


				?>

					<label data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>">
						<input autocomplete="off" name="quantity[<?=$item["ID"]?>][<?=$propertyId?>][<?=$value['ID']?>]" value="0" readonly="" class="quantity-text quantity_<?=$item["ID"]?>" type="text">
						<span class="buttons">
							<button class="button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
							<button class="button" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
						</span>
						<span class="size"><?=$value['NAME']?></span>
					</label>
				<?}
				?>

			<?}?>
			</form>
		</div>
	</div>
	<?/*
	<?if($item["PROPERTIES"]["NOVINKA"]["VALUE"]=="Да"){?>
		<div class="label new"></div><!-- Novinka -->
	<?}
	if($item["PROPERTIES"]["AKTSIYA"]["VALUE"]=="Да"){?>
		<div class="label act"></div><!-- Novinka -->
	<?}
	if($item["PROPERTIES"]["SKORO_V_PRODAZHE"]["VALUE"]=="Да"){?>
		<div class="label soon"></div><!-- Novinka -->
	<?}
	if($item["PROPERTIES"]["SKIDKA"]["VALUE"]=="Да"){?>
		<div class="label discount"></div><!-- Novinka -->
	<?}?>
*/?>
</div>
<!-- Unit // -->
