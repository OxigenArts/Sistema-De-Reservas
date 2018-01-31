<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<span class="mdl-chip mdl-chip--contact" onclick="this.classList.add('hidden');">
        <span class="mdl-chip__contact mdl-color--yellow mdl-color-text--white">!</span>
        <span class="mdl-chip__text">
            <?= $message ?>
        </span>
    </span>
