<main>
    <div class="resetPassword">
        <div class="mail">
        <div class="reset">
        <p>Entrez votre adresse mail</p>
        </div>
        <form method="POST" id="form">
        <div class="error"><?=$error['errorMail'] ?? ''?></div>
            <input
                class="email"
                type="email" 
                id="mail" 
                name="mail" 
                placeholder="E-mail" required>  
         <div class="buton">
            <button class="btn" type="submit">Envoyer</button>
        </div>
        </div> 
    </div>
</main>