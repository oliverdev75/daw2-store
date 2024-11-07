<?php $this->meta(compact('title')) ?>

<?php $this->header(compact('user')) ?>

<?php $this->component($bodyContent, $bodyData, 'body') ?>

<?php $this->component('bootstrap_script', [], 'layout') ?>

<?php $this->footer() ?>