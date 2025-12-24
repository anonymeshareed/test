#  Installation de PHPMailer avec SMTP

## Pourquoi PHPMailer ?

La fonction `mail()` de PHP peut retourner `true` même si l'email n'est pas réellement envoyé. PHPMailer avec SMTP est **beaucoup plus fiable** et fonctionne avec Gmail, Outlook, etc.

---

##  Installation rapide

### Méthode 1 : Via Composer (recommandé)

```bash
cd /home/michael/Images/pożyczka prywatna.com
composer require phpmailer/phpmailer
```

### Méthode 2 : Téléchargement manuel

1. Téléchargez PHPMailer : https://github.com/PHPMailer/PHPMailer/releases
2. Extrayez dans un dossier `PHPMailer/` à la racine du projet

---

##  Configuration avec Gmail

### Étape 1 : Activer l'authentification à deux facteurs sur Gmail

1. Allez sur : https://myaccount.google.com/security
2. Activez la "Validation en deux étapes"

### Étape 2 : Créer un mot de passe d'application

1. Allez sur : https://myaccount.google.com/apppasswords
2. Sélectionnez "Mail" et "Autre (nom personnalisé)"
3. Entrez "pożyczka prywatna" comme nom
4. Cliquez sur "Générer"
5. **Copiez le mot de passe** (16 caractères) - vous en aurez besoin !

---

##  Configuration dans les fichiers PHP

Je vais créer des versions améliorées de `sendmail.php` et `sendmail-contact.php` qui utilisent PHPMailer.

---

##  Avantages de PHPMailer

-  Fonctionne avec Gmail, Outlook, Yahoo, etc.
-  Plus fiable que `mail()`
-  Fonctionne même en local
-  Meilleure gestion des erreurs
-  Support des emails HTML

---

## 🔧 Prochaines étapes

1. Installer PHPMailer (via Composer ou manuel)
2. Configurer Gmail (mot de passe d'application)
3. Modifier les scripts PHP pour utiliser PHPMailer

Je vais créer les fichiers modifiés pour vous !







