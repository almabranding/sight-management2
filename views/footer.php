</div>
<div id="footer_wrapper">
    <div id="footer">
      <a href="<?=URL?>"><img src="<?=URL?>public/images/logo.png"  alt='Footer image' /></a>
      <p>PH +34 93 272 24 34 | FAX +34 93 487 25 51<br/>
      PASEO DE GRACIA 37 2º 2ª 08007 BARCELONA <br/>
      <a href="<?=URL?>">WWW.SIGHT-MANAGEMENT.COM</a></p><br>
    </div>
</div>  

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="<?php echo URL;?>public/js/custom.js"></script>
    <script src="<?php echo URL;?>public/js/mobile.js"></script>
<?php
    if (isset($this->js)) 
        foreach ($this->js as $js)
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
?>
</body>
</html>