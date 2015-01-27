Hello <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>

<hr />

<a href="<?php echo $generator->generate('hello', array('name' => 'Fabien')); ?>">
    say hello to Fabien
</a>
