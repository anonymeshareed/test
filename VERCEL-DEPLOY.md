# Guide de déploiement sur Vercel

## Prérequis

1. Un compte Vercel (gratuit) : https://vercel.com
2. L'outil Vercel CLI installé (optionnel) : `npm i -g vercel`

## Étapes de déploiement

### Méthode 1 : Via le Dashboard Vercel (Recommandé)

1. **Préparer le dépôt Git**
   - Créez un dépôt sur GitHub, GitLab ou Bitbucket
   - Assurez-vous que le fichier `.gitignore` ignore `config-email.php`
   - Commitez et poussez votre code

2. **Importer le projet sur Vercel**
   - Allez sur https://vercel.com/new
   - Importez votre dépôt Git
   - Vercel détectera automatiquement la configuration

3. **Configurer les variables d'environnement**
   Dans les paramètres du projet Vercel, ajoutez ces variables d'environnement :
   - `SMTP_EMAIL` : votre adresse email Gmail
   - `SMTP_PASSWORD` : votre mot de passe d'application Gmail
   - `SMTP_NAME` : nom à afficher dans les emails (ex: "pożyczka prywatna")
   - `EMAIL_DESTINATAIRE` : email destinataire pour recevoir les formulaires
   - `SMTP_HOST` : "smtp.gmail.com" (par défaut)
   - `SMTP_PORT` : "587" (par défaut)
   - `SMTP_SECURE` : "tls" (par défaut)

4. **Déployer**
   - Cliquez sur "Deploy"
   - Votre site sera accessible en quelques minutes

### Méthode 2 : Via Vercel CLI

1. **Installer Vercel CLI**
   ```bash
   npm i -g vercel
   ```

2. **Se connecter**
   ```bash
   vercel login
   ```

3. **Déployer**
   ```bash
   vercel
   ```
   Suivez les instructions et répondez aux questions.

4. **Configurer les variables d'environnement**
   ```bash
   vercel env add SMTP_EMAIL
   vercel env add SMTP_PASSWORD
   vercel env add SMTP_NAME
   vercel env add EMAIL_DESTINATAIRE
   ```
   (Répétez pour chaque variable)

5. **Déployer en production**
   ```bash
   vercel --prod
   ```

## Configuration des variables d'environnement

Pour configurer les variables sur Vercel :

1. Allez dans votre projet sur Vercel
2. Allez dans **Settings** → **Environment Variables**
3. Ajoutez chaque variable :

| Variable | Description | Exemple |
|----------|-------------|---------|
| `SMTP_EMAIL` | Votre adresse Gmail | `votre-email@gmail.com` |
| `SMTP_PASSWORD` | Mot de passe d'application Gmail | `xxxx xxxx xxxx xxxx` |
| `SMTP_NAME` | Nom affiché dans les emails | `pożyczka prywatna` |
| `EMAIL_DESTINATAIRE` | Email pour recevoir les formulaires | `destinataire@gmail.com` |
| `SMTP_HOST` | Serveur SMTP (optionnel) | `smtp.gmail.com` |
| `SMTP_PORT` | Port SMTP (optionnel) | `587` |
| `SMTP_SECURE` | Type de connexion (optionnel) | `tls` |

## Important : Mot de passe d'application Gmail

Si vous utilisez Gmail, vous devez créer un "Mot de passe d'application" :

1. Allez dans votre compte Google : https://myaccount.google.com
2. Sécurité → Validation en deux étapes (doit être activée)
3. Mots de passe des applications → Créer un mot de passe
4. Utilisez ce mot de passe (16 caractères) comme `SMTP_PASSWORD`

**NE JAMAIS utiliser votre mot de passe Gmail normal !**

## Vérification du déploiement

Après le déploiement, testez :

1. La page d'accueil : `https://votre-projet.vercel.app`
2. Le formulaire de contact : remplissez et soumettez
3. Le formulaire de demande de prêt : remplissez et soumettez

Vérifiez les logs dans le dashboard Vercel si quelque chose ne fonctionne pas.

## Support

- Documentation Vercel : https://vercel.com/docs
- Support PHP sur Vercel : https://vercel.com/docs/concepts/functions/serverless-functions/runtimes/php

