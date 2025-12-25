# 🚀 Déploiement sur Vercel - Guide Rapide

## Option 1 : Déploiement via le Dashboard Web (Le plus simple)

### Étapes :

1. **Préparez votre dépôt Git**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/votre-username/votre-repo.git
   git push -u origin main
   ```

2. **Allez sur Vercel**
   - Rendez-vous sur https://vercel.com
   - Créez un compte ou connectez-vous
   - Cliquez sur "Add New..." → "Project"

3. **Importez votre projet**
   - Connectez votre compte GitHub/GitLab/Bitbucket
   - Sélectionnez votre dépôt
   - Vercel détectera automatiquement la configuration PHP

4. **Configurez les variables d'environnement**
   
   Dans les paramètres du projet, allez dans **Settings** → **Environment Variables** et ajoutez :
   
   ```
   SMTP_EMAIL=votre-email@gmail.com
   SMTP_PASSWORD=votre-mot-de-passe-application
   SMTP_NAME=pożyczka prywatna
   EMAIL_DESTINATAIRE=destinataire@gmail.com
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_SECURE=tls
   ```

5. **Déployez**
   - Cliquez sur "Deploy"
   - Attendez quelques minutes
   - Votre site sera en ligne ! 🎉

---

## Option 2 : Déploiement via la CLI (Pour développeurs)

### Installation de Vercel CLI

```bash
npm install -g vercel
```

### Déploiement

```bash
# 1. Connectez-vous
vercel login

# 2. Déployez (première fois)
vercel

# 3. Configurez les variables d'environnement
vercel env add SMTP_EMAIL
vercel env add SMTP_PASSWORD
vercel env add SMTP_NAME
vercel env add EMAIL_DESTINATAIRE
vercel env add SMTP_HOST
vercel env add SMTP_PORT
vercel env add SMTP_SECURE

# 4. Déployez en production
vercel --prod
```

---

## 📋 Configuration des variables d'environnement

| Variable | Description | Exemple |
|----------|-------------|---------|
| `SMTP_EMAIL` | Votre email Gmail | `votre-email@gmail.com` |
| `SMTP_PASSWORD` | Mot de passe d'application Gmail (16 caractères) | `xxxx xxxx xxxx xxxx` |
| `SMTP_NAME` | Nom affiché dans les emails | `pożyczka prywatna` |
| `EMAIL_DESTINATAIRE` | Email pour recevoir les formulaires | `destinataire@gmail.com` |
| `SMTP_HOST` | Serveur SMTP | `smtp.gmail.com` |
| `SMTP_PORT` | Port SMTP | `587` |
| `SMTP_SECURE` | Type de connexion | `tls` |

### ⚠️ Important : Créer un mot de passe d'application Gmail

1. Allez sur https://myaccount.google.com/security
2. Activez la "Validation en deux étapes" (obligatoire)
3. Allez sur https://myaccount.google.com/apppasswords
4. Sélectionnez "Mail" et créez un mot de passe d'application
5. **Copiez les 16 caractères** (ex: `abcd efgh ijkl mnop`)
6. Utilisez ce mot de passe comme `SMTP_PASSWORD`

**NE JAMAIS utiliser votre mot de passe Gmail normal !**

---

## ✅ Vérification après déploiement

1. **Page d'accueil** : `https://votre-projet.vercel.app`
2. **Formulaire de contact** : Testez l'envoi d'un message
3. **Formulaire de demande de prêt** : Testez l'envoi d'une demande

Vérifiez vos emails (et les spams) pour confirmer que tout fonctionne !

---

## 🐛 Dépannage

### Les emails ne sont pas envoyés

1. Vérifiez que toutes les variables d'environnement sont bien configurées
2. Vérifiez les logs dans le dashboard Vercel (onglet "Functions")
3. Assurez-vous que le mot de passe d'application Gmail est correct

### Erreur 500 sur les scripts PHP

1. Vérifiez que Composer a bien installé les dépendances (`vendor/` doit être présent)
2. Vérifiez les logs dans le dashboard Vercel
3. Assurez-vous que `config-email.php` n'est PAS dans le dépôt Git (il est dans `.gitignore`)

---

## 📚 Ressources

- Documentation Vercel : https://vercel.com/docs
- Support PHP sur Vercel : https://vercel.com/docs/concepts/functions/serverless-functions/runtimes/php
- Dashboard Vercel : https://vercel.com/dashboard

---

## 🎯 Prochaines étapes

Une fois déployé :
1. Configurez un nom de domaine personnalisé (optionnel)
2. Configurez HTTPS (automatique sur Vercel)
3. Activez les déploiements automatiques depuis Git

