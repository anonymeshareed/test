# 🔑 GUIDE : Où trouver le mot de passe d'application Gmail

##  Étapes détaillées

### Étape 1 : Accéder aux paramètres de sécurité Google

1. **Ouvrez votre navigateur** (Chrome, Firefox, etc.)

2. **Allez sur** : https://myaccount.google.com/security

   Ou suivez ce chemin :
   - Allez sur https://myaccount.google.com
   - Cliquez sur **"Sécurité"** dans le menu de gauche

---

### Étape 2 : Activer la validation en deux étapes (si pas déjà fait)

1. Sur la page de sécurité, cherchez **"Validation en deux étapes"**
2. Si c'est **"Désactivée"** :
   - Cliquez dessus
   - Suivez les instructions pour l'activer
   - Vous devrez confirmer avec votre téléphone
3. Si c'est déjà **"Activée"** → Passez à l'étape 3

---

### Étape 3 : Accéder aux mots de passe d'application

**Option A : Lien direct**
- Allez directement sur : https://myaccount.google.com/apppasswords

**Option B : Via le menu**
1. Sur la page de sécurité (https://myaccount.google.com/security)
2. Cherchez **"Validation en deux étapes"** (doit être activée)
3. Cliquez dessus
4. Descendez jusqu'à **"Mots de passe des applications"**
5. Cliquez sur **"Mots de passe des applications"**

---

### Étape 4 : Créer un mot de passe d'application

1. **Sélectionnez l'application** : Choisissez **"Mail"**

2. **Sélectionnez l'appareil** : Choisissez **"Autre (nom personnalisé)"**

3. **Entrez un nom** : Tapez **"pożyczka prywatna"** (ou n'importe quel nom)

4. **Cliquez sur "Générer"**

5. **Un mot de passe de 16 caractères apparaîtra** :
   ```
   Exemple : abcd efgh ijkl mnop
   ```
    **COPIEZ-LE MAINTENANT** - vous ne pourrez plus le voir après !

---

### Étape 5 : Utiliser le mot de passe

1. **Ouvrez** le fichier `config-email.php`

2. **Trouvez la ligne 12** :
   ```php
   define('SMTP_PASSWORD', 'VOTRE_MOT_DE_PASSE_APPLICATION');
   ```

3. **Remplacez** `'VOTRE_MOT_DE_PASSE_APPLICATION'` par votre mot de passe de 16 caractères

   **Exemple** :
   ```php
   define('SMTP_PASSWORD', 'abcd efgh ijkl mnop');
   ```
   
    **IMPORTANT** : Gardez les espaces ou enlevez-les, les deux fonctionnent.

---

##  À quoi ça ressemble

### Page de sécurité Google :
```
┌─────────────────────────────────────┐
│  Sécurité                           │
├─────────────────────────────────────┤
│   Validation en deux étapes      │
│     [Cliquez ici]                   │
│                                     │
│  Mots de passe des applications     │
│     [Cliquez ici]                   │
└─────────────────────────────────────┘
```

### Page des mots de passe d'application :
```
┌─────────────────────────────────────┐
│  Sélectionnez l'application         │
│  ☑ Mail                             │
│                                     │
│  Sélectionnez l'appareil            │
│  ☑ Autre (nom personnalisé)         │
│     Nom : [pożyczka prywatna]      │
│                                     │
│  [Générer]                          │
└─────────────────────────────────────┘
```

### Après génération :
```
┌─────────────────────────────────────┐
│  Votre mot de passe d'application   │
│                                     │
│  abcd efgh ijkl mnop                │
│                                     │
│   Copiez ce mot de passe          │
│                                     │
│  [OK]                               │
└─────────────────────────────────────┘
```

---

## ❓ Problèmes courants

### "Je ne vois pas 'Mots de passe des applications'"
-  Assurez-vous que la validation en deux étapes est **activée**
-  Attendez quelques minutes après l'activation

### "Le lien ne fonctionne pas"
-  Essayez : https://myaccount.google.com/apppasswords
-  Connectez-vous avec votre compte Gmail

### "Je ne peux pas activer la validation en deux étapes"
-  Vérifiez que votre compte Gmail est actif
-  Vérifiez que vous avez un numéro de téléphone associé

---

##  Vérification

Une fois configuré, testez avec :
- `test-email-phpmailer.php` (modifiez aussi le mot de passe dans ce fichier pour le test)

Si vous recevez l'email → **C'est bon !** 

---

##  Sécurité

 **NE PARTAGEZ JAMAIS** votre mot de passe d'application !
- Ne le mettez pas dans Git
- Ne le partagez pas publiquement
- Le fichier `config-email.php` est dans `.gitignore` pour votre sécurité








