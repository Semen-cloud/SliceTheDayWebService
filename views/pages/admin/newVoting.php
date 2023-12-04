<?php
/**
 * @var \App\kernel\View\View $view 
 */
?>

<?php $view->component('start')?>

<h1>Create new voting</h1>

<form action="/admin/newVoting" method="post">
    <p>Name</p>
    <div>
        <input type="text" name="name">
    </div>
    <div>
        <button>Create</button>
    </div>
</form>

<?php $view->component('end')?>
