
<?php include_once 'header.html.php'; ?>
<?php include_once 'sideber.html.php'; ?>
<?php include_once 'footer.html.php'; ?>
<?php if ($view['slots']->has('header'))  ?>
<?php $view['slots']->output('header') ?>
<?php if ($view['slots']->has('sideber'))  ?>
<?php $view['slots']->output('sideber') ?>
<?php if ($view['slots']->has('body'))  ?>
<?php $view['slots']->output('body') ?>

<?php if ($view['slots']->has('footer'))  ?>
<?php $view['slots']->output('footer') ?>