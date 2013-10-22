
<?
$title = '<tr>
            <td style="width:730px;vertical-align: top;" colspan="2">
                <h1 style="font-family:helvetica;text-align: center;color:#b5afab;font-size: 40px;">' . $this->_model['name'] . '</h1>
            </td>
        </tr>';
$footer = '<table style="text-align: center;margin:auto;margin-top: 0px;">
    <tr style="font-size: 13px;color:#b5afab;text-align: center;font-weight:bold;text-transform: capitalize;">';

require $_SERVER['DOCUMENT_ROOT'] . '/lang/ES/default.php';
if ($this->SIU) {
    $SIU = new SIU();
    $SIU->setLang('ES');
    $SIUATTR = $SIU->getSiu($this->_model);
    foreach ($SIU->getListAttr() as $value)
        $footer.=($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
}

$footer.='</tr>
</table>
<table style="text-align: center;margin:auto;margin-top: 0px;">
    <tr style="font-size: 13px;color:#b5afab;text-align: center;font-weight:bold;text-transform: capitalize;">';

require $_SERVER['DOCUMENT_ROOT'] . '/lang/EN/default.php';
if ($this->SIU) {
    $SIU = new SIU();
    $SIU->setLang('EN');
    $SIUATTR = $SIU->getSiu($this->_model);
    foreach ($SIU->getListAttr() as $value)
        $footer.=($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
}
$footer.='</tr></table>
<table style="text-align: center;margin:auto;margin-top: 10px;">
    <tr style="font-size: 20px;color:#b5afab;text-align: center;">
        <td>PH +34 93 272 24 34 / FAX +34 93 487 25 51</td>
    </tr>
    <tr style="font-size: 20px;color:#b5afab;text-align: center;">
        <td>PASEO DE GRACIA 37 - 2º2 08007 BARCELONA</td>
    </tr>
    <tr style="font-size: 20px;color:#b5afab;text-align: center;">
        <td>WWW.SIGHT-MANAGEMENT.COM</td>
    </tr>
</table>';
$closeNum=0;
for ($i = 0; $i < sizeof($photos); $i++) {
    if ($closeNum == 0) {
        echo '<div style="height:99.9%;padding-left: 30px;background:url(http://sight-management.com/public/images/vertLogo.jpg) repeat-y left top transparent"> 
            <table style="width: 750px; border-collapse: collapse" align="center" cellspacing="50">' . $title;
        $closed = false;
        $closeNum=4;
    }
    $value1 = $photos[$i];
    $value2 = $photos[$i + 1];
    list($ancho1, $alto1) = getimagesize(UPLOAD . 'models/' . Model::idToRute($value1['photo_id']) . $value1['file_file_name']);
    list($ancho2, $alto2) = getimagesize(UPLOAD . 'models/' . Model::idToRute($value1['photo_id']) . $value1['file_file_name']);

    $width = ($ancho1 > $alto1) ? 'width:100%;' : 'width:50%;';
    $colspan = ($ancho1 > $alto1) ? '2' : '';
    $closeNum--;
    ?>
    <tr>
        <td colspan='<?= $colspan; ?>' style='<?= $width ?>;height: 450px;text-align: center;overflow:hidden;'> <img style="height:100%;width: 100%;" src="<?= UPLOAD . 'models/' . Model::idToRute($value1['photo_id']) . $value1['file_file_name']; ?>"/></td>
        <?
        if ($ancho1 > $alto1 || $ancho2 > $alto2) {
            $closeNum--;
            echo '</tr>';
            if ($closeNum == 0) {
                echo '</table>' . $footer . '</div>';
                $closed = true;
            }
        } else {
            $closeNum--;
            if ($value2['photo_id']) {
                ?>
                <td style='<?= $width ?>;height: 450px;text-align: center;overflow:hidden;'><img style="height:100%;width: 100%;" src="<?php echo UPLOAD . 'models/' . Model::idToRute($value2['photo_id']) . $value2['file_file_name']; ?>"></td>
                    <?
                } else {
                    echo '<td style="' . $width . '"></td>';
                }
                ?>
        </tr>
        <?
        $i++;
        if ($closeNum == 0) {
            echo ' </table>' . $footer . '</div>';
            $closed = true;
        }
    }
}
if (!$closed)
    echo ' </table>' . $footer . '</div>';




