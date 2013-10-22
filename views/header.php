<body class="bp two-col">
    <div id="header_wrapper">
        <div id="header">
            <a class="logo" href="/<?= LANG ?>"></a>

            <div class="clr"></div>
            <div id="language_switcher">
                <ul>
                    <li><span><?= $this->lang['select_lang']; ?></span>
                        <ul>
                            <a href="<?= URL . 'EN' . PATH ?>"><li>English</li></a>
                            <a href="<?= URL . 'ES' . PATH ?>"><li>Español</li></a>
                            <a href="<?= URL . 'CH' . PATH ?>"><li>中文</li></a>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </div> 
    <input type="checkbox" id="menuCheck">
<label for="menuCheck" onclick></label>
            <nav id="menu" role="off-canvas">
                <ul>
                    <li class="first"><a href='/<?= LANG ?>/models/men' ><span><?= $this->lang['men'] ?></span></a></li>                                                                                                                                                                                                  
                    <li><a href='/<?= LANG ?>/models/women' ><span><?= $this->lang['women'] ?></span></a></li>               
                    <li><a href='/<?= LANG ?>/models/development' ><span><?= $this->lang['development'] ?></span></a>
                        <ul>
                            <li><a href='/<?= LANG ?>/models/development/men' ><span><?= $this->lang['men'] ?></span></a></li>
                            <li><a href='/<?= LANG ?>/models/development/women' ><span><?= $this->lang['women'] ?></span></a></li>
                        </ul>
                    </li>   
                    <li><a href='/<?= LANG ?>/models/special_bookings'><span><?= $this->lang['special_bookings'] ?></span></a>
                        <ul>
                            <li><a href='/<?= LANG ?>/models/special_bookings/men'><span><?= $this->lang['men'] ?></span></a></li>
                            <li><a href='/<?= LANG ?>/models/special_bookings/women'><span><?= $this->lang['women'] ?></span></a></li>
                        </ul>
                    </li>
                    <li><a href='/<?= LANG ?>/models/sports' ><span><?= $this->lang['sports'] ?></span></a></li>             
                    <li><a href="http://blog.sight-management.com/" target="_blank"><span><?= $this->lang['blog'] ?></span></a></li>
                    <li class="last"><a href='/<?= LANG ?>/contact'><span><?= $this->lang['contact'] ?></span></a></li>      
                </ul>
            </nav>
<div id="container" >
    <a class="logoMobile logo" href="/<?= LANG ?>"></a>