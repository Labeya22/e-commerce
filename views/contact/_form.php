

<div class="group-form">
    <label for="name">nom</label>
    <?=  inputField('nom', [
        'class' => 'input-form',
        'type' => 'text'
    ], $_POST, $errors) ?>
</div>

<div class="group-form">
    <label for="name">email</label>
    <?=  inputField('email', [
        'class' => 'input-form',
        'type' => 'email'
    ], $_POST, $errors) ?>
</div>
<div class="group-form">
    <label for="message">message</label>
    <?=  textarea('message',$_POST, $errors) ?>
</div>
<button class="button button-primary" id="send-contact"><i class="fa fa-telegram"></i> Envoyer</button>
