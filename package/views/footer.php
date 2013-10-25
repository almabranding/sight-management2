<div id="footer_wrapper">
    <div id="container">
        <div id="footer">
            <div id="logoBoxFooter">
                <a target="_blank" href="http://sight-management.com"><img src="<?php echo URL; ?>public/images/logoFooter.png"></a>
            </div>
            <? if ($this->footerMenu) { ?>
                <div id="header">
                    <div id="menu">
                        <ul>
                            <? if ($this->menu['model-men']) { ?><li><a class="<?=(strstr(PATH,'selection/men') || strstr(PATH,'package/men'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/men' ><span><?= $this->lang['men'] ?></span></a></li> <? } ?>                                                                                                                                                                                                  
                            <? if ($this->menu['model-women']) { ?><li><a class="<?=(strstr(PATH,'selection/women') || strstr(PATH,'package/women'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/women' ><span><?= $this->lang['women'] ?></span></a></li>      <? } ?>       
                            <? if ($this->menu['special']) { ?><li><a class="<?=(strstr(PATH,'special_booking'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/special_booking'><span><?= $this->lang['special_bookings'] ?></span></a> <? } ?>   
                                <ul>
                                    <? if ($this->menu['special-men']) { ?><li class="<?=(strstr(PATH,'special_booking/men'))?'selected':''?>"><a class="<?=(strstr(PATH,'special_booking/men'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/special_booking/men'><span><?= $this->lang['men'] ?></span></a></li> <? } ?>   
                                    <? if ($this->menu['special-women']) { ?><li class="<?=(strstr(PATH,'special_booking/women'))?'selected':''?>"><a class="<?=(strstr(PATH,'special_booking/women'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/special_booking/women'><span><?= $this->lang['women'] ?></span></a></li> <? } ?>   
                                </ul>
                            </li>
                            <? if ($this->menu['sports']) { ?><li><a class="<?=(strstr(PATH,'sports'))?'selected':''?>" href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/sports' ><span><?= $this->lang['sports'] ?></span></a></li>       <? } ?>         
                        </ul>
                    </div>
                </div>
            <? } ?>
            <div id="footerContact">
                <ul>
                    <li>Pº de Gracia, 37, 2º 2ª 08007 Barcelona</li>
                    <li>Ph. +34 93 272 24 34 | Fax +34 93 487 25 51</li>
                    <li><a href="http://www.sight-management.com" target="_blank">www.sight-management.com</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?php echo URL; ?>public/js/custom.js"></script>
<script src="<?php echo URL; ?>public/js/mobile.js"></script>
<?php
if (isset($this->js))
    foreach ($this->js as $js)
        echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
?>
</body>
</html>