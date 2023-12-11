<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
if(!$session->has('Auth')) $redirect('/default');
?>

<?php $view->component('start')?>
<h1>personal area of 
    <?php 
        if($session->has('loginAuth')) 
            echo $session->get('loginAuth') . " with " . $session->get('idAuth') . "id.";
    ?>
</h1>
<?php $view->component('end')?>