<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<div class="table_box notfound_info">
	<div>
		<p><b style="font-size:24px;">К сожалению, страница, которую Вы запросили, не существует!</b></p>
		<p>Возможные причины: </p>
		<ul>
			<li>Страница была удалена с сервера;</li>
			<li>Страница временно недоступна;</li>
		</ul>
		<p>Если вы набрали адрес вручную, проверьте, пожалуста, правильно ли он набран.</p>
		<p><a href="/" class="bttn">вернуться на главную страницу</a></p>
	</div>
	<div><img src="/images/404.jpg" alt="" /></div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>