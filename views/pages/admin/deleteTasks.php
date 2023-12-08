<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */

 var_dump($session);
?>

<?php $view->component('start')?>

<h1>Create new voting</h1>

<form action="/admin/newVoting" method="post">
    <p>Name</p>
    <div>
        <input type="text" name="name">
    </div>
    <?php if($session->has('name')) { ?>
        <ul>
            <?php foreach ($session->getFlash('name') as $error) {?>
                <li style = "color: red;"><?php echo $error ?></li>
            <?php } ?>
        </ul>
    <?php }?>
    
    <div>
        <button>Create</button>
    </div>
</form>

<?php $view->component('end')?>
