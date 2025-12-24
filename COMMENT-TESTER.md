#  COMMENT TESTER test-email.php

##  Méthode 1 : Si votre site est en ligne (hébergement web)

### Étapes :

1. **Uploadez le fichier** `test-email.php` sur votre serveur (si pas déjà fait)

2. **Accédez au fichier via votre navigateur** :
   ```
   http://votre-domaine.com/test-email.php
   ```
   ou
   ```
   https://votre-domaine.com/test-email.php
   ```

3. **Remplacez `votre-domaine.com`** par votre vrai nom de domaine

4. **Vous verrez** :
   -  Un message vert si la fonction mail() est disponible
   -  Un message de confirmation si l'email est envoyé
   -  Un message d'erreur rouge si quelque chose ne va pas

5. **Vérifiez votre boîte email** :
   - Regardez dans votre boîte de réception
   - **IMPORTANT :** Vérifiez aussi le dossier **SPAM / Courrier indésirable**
   - L'email peut prendre quelques minutes à arriver

---

##  Méthode 2 : Si vous testez en local (XAMPP, WAMP, MAMP)

### Étapes :

1. **Démarrez votre serveur local** (XAMPP, WAMP, etc.)

2. **Placez le fichier** dans le dossier `htdocs` (XAMPP) ou `www` (WAMP)

3. **Accédez au fichier** :
   ```
   http://localhost/test-email.php
   ```
   ou
   ```
   http://localhost/votre-dossier/test-email.php
   ```

4. **ATTENTION : ATTENTION** : En local, la fonction `mail()` ne fonctionne généralement PAS
   - Vous verrez probablement une erreur
   - C'est normal ! Il faudra utiliser PHPMailer avec SMTP

---

##  Méthode 3 : Via la ligne de commande (terminal)

### Si vous avez accès SSH :

```bash
cd /home/michael/Images/pożyczka prywatna.com
php test-email.php
```

Cela affichera le résultat dans le terminal.

---

##  CE QUE VOUS DEVEZ VOIR SI ÇA FONCTIONNE

### Résultat attendu :

```
 La fonction mail() est disponible.
Envoi d'un email de test à : sagbomichaelmahulicajenus@gmail.com
 Email envoyé avec succès !
Vérifiez votre boîte de réception (et les spams) dans quelques instants.
```

### Informations du serveur :
- Version PHP : 7.x ou 8.x
- Serveur : Apache/2.x ou Nginx

---

##  CE QUE VOUS VERREZ SI ÇA NE FONCTIONNE PAS

### Erreur 1 : Fonction mail() non disponible
```
 ERREUR : La fonction mail() n'est pas disponible sur ce serveur.
```
**Solution :** Utiliser PHPMailer avec SMTP

### Erreur 2 : Email non envoyé
```
 ERREUR : L'email n'a pas pu être envoyé.
```
**Solutions possibles :**
- Vérifier la configuration PHP
- Utiliser PHPMailer avec SMTP
- Contacter votre hébergeur

---

##  VÉRIFIER VOTRE EMAIL

1. **Ouvrez votre boîte email** : sagbomichaelmahulicajenus@gmail.com

2. **Cherchez un email avec le sujet** : "Test d'envoi email - pożyczka prywatna"

3. **Vérifiez aussi** :
   - 📁 Dossier **SPAM / Courrier indésirable**
   - 📁 Dossier **Promotions** (Gmail)
   - ⏰ Attendez 2-3 minutes (les emails peuvent être retardés)

---

## 🔧 SI L'EMAIL N'ARRIVE PAS

### Vérifications :

1.  L'adresse email est correcte dans `test-email.php`
2.  Le fichier est bien sur le serveur
3.  Vous avez accédé au fichier via le navigateur
4.  Vous avez vérifié le dossier SPAM

### Solutions :

**Option A : Utiliser PHPMailer avec SMTP**
- Plus fiable que la fonction mail()
- Fonctionne même en local
- Nécessite Gmail, Outlook, ou autre service SMTP

**Option B : Contacter votre hébergeur**
- Demander si la fonction mail() est activée
- Demander la configuration SMTP

---

##  PROCHAINES ÉTAPES APRÈS LE TEST

### Si le test fonctionne  :
1. Configurez les emails dans `sendmail.php` et `sendmail-contact.php`
2. Testez les formulaires sur le site
3. C'est bon ! 

### Si le test ne fonctionne pas  :
1. Installez PHPMailer
2. Configurez SMTP (Gmail, Outlook, etc.)
3. Modifiez les scripts PHP pour utiliser PHPMailer

---

##  ASTUCE

**Pour tester rapidement** :
1. Ouvrez votre navigateur
2. Tapez : `http://votre-domaine.com/test-email.php`
3. Appuyez sur Entrée
4. Regardez le résultat à l'écran
5. Vérifiez votre email

C'est tout ! 






