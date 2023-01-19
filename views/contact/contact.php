<?php

$errors = getErrorContact($_POST);
if (empty($errors) && !empty($_POST)) {
    $send = sendMail(
        $_POST['email'],
        "formulaire de contact",
        $_POST['message']
    );
    if ($send) {
        setFlash('success', "votre message a été envoyé.", generate('contact'));
    } else {
        setFlash('danger', "votre message n'a pu être envoyé, merci de réessayer.", generate('contact'));
    }

    redirect(generate('contact'));
}
?>
<main class="main">
        <!-- contact -->
        <div class="container">
            <div class="section">
                <div class="section-title">
                    <h2>Nous contacter</h2>
                </div>
                <?= flash() ?>
                <div class="contact">
                    <form 
                    action="" 
                    class="form" method="post">
                        <?php require inc("contact/_form.php") ?>
                    </form>
                </div>
            </div>
        </div>
    </main>

   
    <a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
    