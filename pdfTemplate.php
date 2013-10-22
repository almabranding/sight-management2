<page>
    <table style="width: 100%; height:99%;vertical-align: top;" align="center">
        <tr>
            <td style="width:50px; height:100%; background:url(http://sight-management.com/public/images/vertLogo.jpg) repeat-y center center #bebebe"></td>
            <td style="width:730px;vertical-align: top;">
                <h1 style="font-family:helvetica;text-align: center;color:#b5afab;font-size: 40px;"><? echo $this->_model['name'];?></h1>
                <table style="width: auto; border-collapse: collapse" align="center" cellspacing="50">
                    <tbody>
                                <? 
                                $abierto=false;
                                    foreach($photos as $key=>$value){ 
                                        if($key==0 || $key==2) {
                                        echo '<tr>';
                                        $abierto=true;
                                        }
                                ?>
                                 <td style="width: 300px;height: 400px; text-align: left; overflow: hidden;padding: 10px" cellspacing="10">
                                    <img style="height:100%;width: 100%;" src="<?php echo UPLOAD.'models/'.Model::idToRute($value['photo_id']).$value['file_file_name'];?>">
                                </td>
                                <? 
                                    if($key==1 || $key==3) {
                                        $abierto=false;
                                        echo '</tr>';
                                    }
                                }
                                if($abierto) echo '</tr>';?>
                      
                        
                    </tbody>
                </table>
                <table style="text-align: center;margin:auto;margin-top: 0px;">
                    <tr style="font-size: 13px;color:#b5afab;text-align: center;font-weight:bold;text-transform: capitalize;">
                        <? 
                        require 'lang/ES/default.php';
                        if($this->SIU){
                            $SIU=new SIU();
                            $SIU->setLang('ES');
                            $SIUATTR=$SIU->getSiu($this->_model);
                            foreach($SIU->getListAttr() as $value)
                                echo ($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
                        }?>
                    </tr>
                </table>
                <table style="text-align: center;margin:auto;margin-top: 0px;">
                    <tr style="font-size: 13px;color:#b5afab;text-align: center;font-weight:bold;text-transform: capitalize;">
                       <? 
                        require 'lang/EN/default.php';
                        if($this->SIU){
                            $SIU=new SIU();
                            $SIU->setLang('EN');
                            $SIUATTR=$SIU->getSiu($this->_model);
                            foreach($SIU->getListAttr() as $value)
                                echo ($SIUATTR[$value]) ? '<td style="padding:0 5px;">' . $lang[$value] . '  <span style=";font-weight:normal;">' . $SIUATTR[$value] . '</span></td>' : '';
                        }?>
                    </tr>
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
                

            </td>
        </tr>
    </table>


</page>
