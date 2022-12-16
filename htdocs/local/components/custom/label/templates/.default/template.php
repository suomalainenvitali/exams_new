<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?if (!empty($arResult["LABELS"])):?>						
    <div class="label-container">
        <?foreach ($arResult["LABELS"] as $label):?>
            <a href="" class="label-container-link" style="background:rgb(<?=$label["COLOR"]?>);"><?=$label["NAME"]?></a>
        <?endforeach;?>
    </div>
<?endif;?>