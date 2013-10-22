<div style="padding-left: 60px;height:99%;background:url(http://sight-management.com/public/images/vertLogo.jpg) repeat-y left top transparent">
        <table style="width: 100%; border-collapse: collapse; " align="center" >
                <tbody>
                    <tr>
                        <td  colspan="2">
                            <h1 style="font-family:helvetica;text-align: center;color:#b5afab;font-size: 40px;">MODEL FAVOURITES</h1>
                        </td>
                    </tr>
                    <? 
                    foreach ($photos as $key=>$model) { ?>
                        <tr>
                            <td style="width: 20%; text-align: left; overflow: hidden;padding: 10px" cellspacing="10">
                                <img style="width:100%" src="<?= $urlImage . '/uploads/models/' . Model::idToRute($model['photo_id']) . $model['file_file_name']; ?>">
                            </td>
                            <td  style="text-align: left;width: 80%;font-size:15px">
                                <h2  style="text-align: left;font-size:30px;color:#b5afab;"><?= $model['name'] ?></h2>
                                <table style="text-align: left">
                                    <tr style="color:#b5afab;font-weight:bold;text-transform: capitalize;">
                                        <?
                                        require 'lang/ES/default.php';
                                        if ($model['category_id'] != 2 && $model['category_id'] != 3) {
                                            $SIU = new SIU();
                                            $SIU->setLang('ES');
                                            $SIUATTR = $SIU->getSiu($model);
                                            foreach ($SIU->getListAttr() as $value)
                                                echo ($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
                                        }else{
                                            
                                        }
                                        ?>
                                    </tr>
                                    <tr style="color:#b5afab;font-weight:bold;text-transform: capitalize;">
                                        <?
                                        require 'lang/EN/default.php';
                                        if ($model['category_id'] != 2 && $model['category_id'] != 3) {
                                            $SIU = new SIU();
                                            $SIU->setLang('EN');
                                            $SIUATTR = $SIU->getSiu($model);
                                            foreach ($SIU->getListAttr() as $value)
                                                echo ($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
                                        }else{
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <? } ?> 
                </tbody>
            </table>
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
            </table>


    </div>