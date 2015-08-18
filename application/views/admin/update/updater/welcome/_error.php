<?php
/**
 * This view display any error encoutered while getting the welcome message. Most of those errors are returned by the update server, and concern the update key. 
 * @var obj $serverAnswer the object return by the server (can also be build by the update controler itself.)   
 */

// TODO : move to the controler
$urlNew = Yii::app()->createUrl("admin/globalsettings", array("update"=>'newKey'));

// We first build the error message.
// View is right place to do this, so it's easy for further integrators to change messages.
switch ($serverAnswer->error) 
{
    case 'out_of_updates':
        $title = "Your update key is out of update !";
        $message = "you should first renew this key before using it, or try to enter a new one !";
        $buttons = 1;
        break;
    
    case 'expired':
        $title = "Your update key is expired !";
        $message = "you should first renew this key before using it, or try to enter a new one !";
        $buttons = 1;       
        break;

    case 'not_found':
        $title = "Unknown update key !";
        $message = "Your key is unkown by the update server.";
        $buttons = 3;
        break;      
    
    case 'key_null':
        $title = "key can't be null !";
        $message = "";
        $buttons = 3;
        break;
    
    case 'unkown_destination_build':
        $title = "Unkown destination build !";
        $message = "It seems that the ComfortUpdate doesn't know to which version you're trying to update. Please, restart the process.";
        break;
    
    case 'file_locked':
        $title = 'Update server busy';
        $message = 'The update server is currently busy. This usually happens when the update files for a new version are being prepared <br/> Please be patient and try again in about 10 minutes.';
        break;

    case 'zip_error':
        $title = gT('Error while creating zip file');
        $message = "An error occured while creating the backup of your files. Check your local system (permission, available space, etc.)";
        break; 
            
    default:
        $title = $serverAnswer->error;
        $message = "Unknown error. Please, contact LimeSurvey team.";
        break;
}
?>


<h2 class="maintitle" style="color: red;"><?php echo $title;?></h2>
<?php 
    if( isset($serverAnswer->html) )
        echo $serverAnswer->html;
?>
<div style="padding: 10px">
    <?php eT($message); ?>
</div>

<div>

<?php if( $buttons == 1 ): ?>
        <a class="button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only limebutton" href="https://www.limesurvey.org/en/" role="button" aria-disabled="false" target="_blank">
            <span class="ui-button-text"><?php eT("Renew this key"); ?></span>
        </a>
    
        <a class="button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only limebutton" href="<?php echo $urlNew;?>" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php eT("Enter a new key"); ?></span>
        </a>
<?php endif; ?> 
<?php if( $buttons == 3 ): ?>   
        <a class="button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only limebutton" href="<?php echo $urlNew;?>" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php eT("Enter a new key"); ?></span>
        </a>
<?php endif;?>
<a class="button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only limebutton" href="<?php echo Yii::app()->createUrl("admin/globalsettings"); ?>" role="button" aria-disabled="false">
    <span class="ui-button-text"><?php eT("Cancel"); ?></span>
</a>
</div>
