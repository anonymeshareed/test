<?php
/**
 * Template HTML professionnel pour les emails
 */

function getEmailTemplate($type, $data) {
    $primaryColor = '#004aaD';
    $secondaryColor = '#233D4D';
    
    if ($type === 'prestito') {
        $title = 'Nuova richiesta di prestito';
        $content = getPrestitoContent($data);
    } else {
        $title = 'Nouveau message de contact';
        $content = getContactContent($data);
    }
    
    $html = '<!DOCTYPE html>
<html lang="it">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . htmlspecialchars($title) . '</title>
    <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                font-family: "Roboto", Arial, sans-serif;
                background-color: #f4f4f4;
                line-height: 1.6;
            }
            .email-container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
            }
            .email-header {
                background: linear-gradient(135deg, ' . $primaryColor . ' 0%, ' . $secondaryColor . ' 100%);
                padding: 30px 20px;
                text-align: center;
            }
            .email-header h1 {
                color: #ffffff;
                margin: 0;
                font-size: 28px;
                font-weight: 600;
            }
            .email-header p {
                color: #ffffff;
                margin: 10px 0 0 0;
                font-size: 14px;
                opacity: 0.9;
            }
            .email-body {
                padding: 40px 30px;
            }
            .info-section {
                background-color: #f8f9fa;
                border-left: 4px solid ' . $primaryColor . ';
                padding: 25px;
                margin: 25px 0;
                border-radius: 4px;
            }
            .info-section h2 {
                margin-top: 0;
                color: ' . $primaryColor . ';
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 20px;
            }
            .info-row {
                display: flex;
                padding: 12px 0;
                border-bottom: 1px solid #e9ecef;
            }
            .info-row:last-child {
                border-bottom: none;
            }
            .info-label {
                font-weight: 600;
                color: #495057;
                width: 200px;
                min-width: 200px;
                font-size: 14px;
            }
            .info-value {
                color: #212529;
                flex: 1;
                font-size: 14px;
            }
            .highlight-box {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border: 2px solid ' . $primaryColor . ';
                border-radius: 8px;
                padding: 25px;
                margin: 25px 0;
                text-align: center;
            }
            .highlight-box .amount {
                font-size: 32px;
                font-weight: 700;
                color: ' . $primaryColor . ';
                margin: 10px 0;
            }
            .highlight-box .label {
                font-size: 14px;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .message-box {
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 6px;
                padding: 20px;
                margin: 20px 0;
            }
            .message-box .label {
                font-weight: 600;
                color: #495057;
                margin-bottom: 10px;
                display: block;
                font-size: 14px;
            }
            .message-box .content {
                color: #212529;
                white-space: pre-wrap;
                line-height: 1.8;
                font-size: 14px;
            }
            .email-footer {
                background-color: #191F29;
                color: #ffffff;
                padding: 30px 20px;
                text-align: center;
                font-size: 12px;
            }
            .email-footer p {
                margin: 5px 0;
                color: #adb5bd;
            }
            .email-footer .company-name {
                font-weight: 600;
                color: #ffffff;
                font-size: 16px;
                margin-bottom: 10px;
            }
            @media only screen and (max-width: 600px) {
                .email-body {
                    padding: 30px 20px;
                }
                .info-row {
                    flex-direction: column;
                }
                .info-label {
                    width: 100%;
                    margin-bottom: 5px;
                }
                .highlight-box .amount {
                    font-size: 24px;
                }
            }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <div class="email-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <div class="email-header" style="background: linear-gradient(135deg, ' . $primaryColor . ' 0%, ' . $secondaryColor . ' 100%); padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;">pożyczka prywatna</h1>
            <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">' . htmlspecialchars($title) . '</p>
        </div>
        
        <div class="email-body" style="padding: 40px 30px;">
            ' . $content . '
        </div>
        
        <div class="email-footer" style="background-color: #191F29; color: #ffffff; padding: 30px 20px; text-align: center; font-size: 12px;">
            <p class="company-name" style="font-weight: 600; color: #ffffff; font-size: 16px; margin-bottom: 10px; margin: 5px 0;">pożyczka prywatna</p>
            <p style="margin: 5px 0; color: #adb5bd;">© ' . date('Y') . ' pożyczka prywatna. Tutti i diritti riservati.</p>
            <p style="margin: 5px 0; color: #adb5bd;">Piazza San Lorenzo, 00060 Roma</p>
        </div>
    </div>
</body>
</html>';
    
    return $html;
}

function getPrestitoContent($data) {
    $primaryColor = '#004aaD';
    
    $html = '<div class="info-section" style="background-color: #f8f9fa; border-left: 4px solid ' . $primaryColor . '; padding: 25px; margin: 25px 0; border-radius: 4px;">
        <h2 style="margin-top: 0; color: ' . $primaryColor . '; font-size: 20px; font-weight: 600; margin-bottom: 20px;">Informazioni del Cliente</h2>';
    
    $fields = [
        'Nome e cognome' => $data['fullName'],
        'E-mail' => $data['email'],
        'Telefono cellulare' => $data['phone'],
        'Paese' => $data['country'],
        'Professione' => $data['profession'],
        'Reddito mensile' => !empty($data['income']) ? number_format($data['income'], 0, ',', '.') . ' €' : '',
        'Indirizzo di residenza' => $data['address']
    ];
    
    foreach ($fields as $label => $value) {
        if (!empty($value)) {
            $html .= '<div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #e9ecef;">
                <div class="info-label" style="font-weight: 600; color: #495057; width: 200px; min-width: 200px; font-size: 14px;">' . htmlspecialchars($label) . '</div>
                <div class="info-value" style="color: #212529; flex: 1; font-size: 14px;">' . htmlspecialchars($value) . '</div>
            </div>';
        }
    }
    
    $html .= '</div>';
    
    if (!empty($data['amount'])) {
        $html .= '<div class="highlight-box" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 2px solid ' . $primaryColor . '; border-radius: 8px; padding: 25px; margin: 25px 0; text-align: center;">
            <div class="label" style="font-size: 14px; color: #6c757d; text-transform: uppercase; letter-spacing: 1px;">Importo Richiesto</div>
            <div class="amount" style="font-size: 32px; font-weight: 700; color: ' . $primaryColor . '; margin: 10px 0;">' . number_format($data['amount'], 0, ',', '.') . ' €</div>
        </div>';
    }
    
    $html .= '<div class="info-section" style="background-color: #f8f9fa; border-left: 4px solid ' . $primaryColor . '; padding: 25px; margin: 25px 0; border-radius: 4px;">
        <h2 style="margin-top: 0; color: ' . $primaryColor . '; font-size: 20px; font-weight: 600; margin-bottom: 20px;">Dettagli della Richiesta</h2>';
    
    if (!empty($data['motif'])) {
        $html .= '<div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #e9ecef;">
            <div class="info-label" style="font-weight: 600; color: #495057; width: 200px; min-width: 200px; font-size: 14px;">Motivo</div>
            <div class="info-value" style="color: #212529; flex: 1; font-size: 14px;">' . htmlspecialchars($data['motif']) . '</div>
        </div>';
    }
    
    if (!empty($data['duration'])) {
        $html .= '<div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #e9ecef;">
            <div class="info-label" style="font-weight: 600; color: #495057; width: 200px; min-width: 200px; font-size: 14px;">Durata</div>
            <div class="info-value" style="color: #212529; flex: 1; font-size: 14px;">' . htmlspecialchars($data['duration']) . ' mesi</div>
        </div>';
    }
    
    $html .= '</div>';
    
    return $html;
}

function getContactContent($data) {
    $primaryColor = '#004aaD';
    
    $html = '<div class="info-section" style="background-color: #f8f9fa; border-left: 4px solid ' . $primaryColor . '; padding: 25px; margin: 25px 0; border-radius: 4px;">
        <h2 style="margin-top: 0; color: ' . $primaryColor . '; font-size: 20px; font-weight: 600; margin-bottom: 20px;">Informazioni di Contatto</h2>';
    
    $fields = [
        'Nome e cognome' => $data['nom'],
        'E-mail' => $data['email'],
        'Numero di telefono' => $data['tel'],
        'Pays' => $data['country'],
        'Profession' => $data['profession'],
        'Revenu mensuel' => !empty($data['income']) ? number_format($data['income'], 0, ',', '.') . ' €' : '',
        'Adresse de domicile' => $data['address'],
        'Soggetto' => $data['sujet']
    ];
    
    foreach ($fields as $label => $value) {
        if (!empty($value)) {
            $html .= '<div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #e9ecef;">
                <div class="info-label" style="font-weight: 600; color: #495057; width: 200px; min-width: 200px; font-size: 14px;">' . htmlspecialchars($label) . '</div>
                <div class="info-value" style="color: #212529; flex: 1; font-size: 14px;">' . htmlspecialchars($value) . '</div>
            </div>';
        }
    }
    
    $html .= '</div>';
    
    if (!empty($data['message'])) {
        $html .= '<div class="message-box" style="background-color: #fff; border: 1px solid #dee2e6; border-radius: 6px; padding: 20px; margin: 20px 0;">
            <span class="label" style="font-weight: 600; color: #495057; margin-bottom: 10px; display: block; font-size: 14px;">Notizia:</span>
            <div class="content" style="color: #212529; white-space: pre-wrap; line-height: 1.8; font-size: 14px;">' . nl2br(htmlspecialchars($data['message'])) . '</div>
        </div>';
    }
    
    return $html;
}

function getConfirmationEmailTemplate($type, $data) {
    $primaryColor = '#004aaD';
    $secondaryColor = '#233D4D';
    
    if ($type === 'prestito') {
        $title = 'Conferma ricezione richiesta di prestito';
        $intro = 'Abbiamo ricevuto la tua richiesta di prestito';
    } else {
        $title = 'Conferma ricezione messaggio';
        $intro = 'Abbiamo ricevuto il tuo messaggio';
    }
    
    $userName = !empty($data['fullName']) ? $data['fullName'] : (!empty($data['nom']) ? $data['nom'] : 'Cliente');
    $userEmail = !empty($data['email']) ? $data['email'] : '';
    
    $html = '<!DOCTYPE html>
<html lang="it">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . htmlspecialchars($title) . '</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: "Roboto", Arial, sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .email-header {
            background: linear-gradient(135deg, ' . $primaryColor . ' 0%, ' . $secondaryColor . ' 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
        }
        .confirmation-box {
            background-color: #d4edda;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .confirmation-box .icon {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 15px;
        }
        .confirmation-box h2 {
            color: #155724;
            margin: 0 0 15px 0;
            font-size: 22px;
        }
        .confirmation-box p {
            color: #155724;
            margin: 10px 0;
            font-size: 14px;
        }
        .info-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box h3 {
            color: #856404;
            margin-top: 0;
            font-size: 18px;
        }
        .info-box p {
            color: #856404;
            margin: 10px 0;
            font-size: 14px;
            line-height: 1.8;
        }
        .info-box ul {
            color: #856404;
            margin: 10px 0;
            padding-left: 20px;
        }
        .info-box li {
            margin: 8px 0;
            font-size: 14px;
        }
        .contact-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }
        .contact-info p {
            margin: 8px 0;
            font-size: 14px;
            color: #495057;
        }
        .email-footer {
            background-color: #191F29;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
            font-size: 12px;
        }
        .email-footer p {
            margin: 5px 0;
            color: #adb5bd;
        }
        .email-footer .company-name {
            font-weight: 600;
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 10px;
        }
        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <div class="email-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <div class="email-header" style="background: linear-gradient(135deg, ' . $primaryColor . ' 0%, ' . $secondaryColor . ' 100%); padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;">pożyczka prywatna</h1>
        </div>
        
        <div class="email-body" style="padding: 40px 30px;">
            <p style="font-size: 16px; color: #212529; margin-bottom: 20px;">Gentile ' . htmlspecialchars($userName) . ',</p>
            
            <div class="confirmation-box" style="background-color: #d4edda; border: 2px solid #28a745; border-radius: 8px; padding: 25px; margin: 25px 0; text-align: center;">
                <div class="icon" style="font-size: 48px; color: #28a745; margin-bottom: 15px;">✓</div>
                <h2 style="color: #155724; margin: 0 0 15px 0; font-size: 22px;">' . htmlspecialchars($intro) . '</h2>
                <p style="color: #155724; margin: 10px 0; font-size: 14px;">La tua richiesta è stata ricevuta con successo e sarà esaminata al più presto.</p>
            </div>
            
            <div class="info-box" style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <h3 style="color: #856404; margin-top: 0; font-size: 18px;">Verifica le informazioni</h3>
                <p style="color: #856404; margin: 10px 0; font-size: 14px; line-height: 1.8;">
                    Ti preghiamo di verificare che tutte le informazioni fornite siano corrette. Se noti qualche errore o desideri modificare qualcosa, <strong>rispondi semplicemente a questa email</strong> e ti contatteremo il prima possibile.
                </p>
                <p style="color: #856404; margin: 10px 0; font-size: 14px;">
                    <strong>Non esitare a rispondere a questa email</strong> se:
                </p>
                <ul style="color: #856404; margin: 10px 0; padding-left: 20px; text-align: left;">
                    <li style="margin: 8px 0; font-size: 14px;">Hai bisogno di modificare qualche informazione</li>
                    <li style="margin: 8px 0; font-size: 14px;">Hai domande sulla tua richiesta</li>
                    <li style="margin: 8px 0; font-size: 14px;">Vuoi aggiungere dettagli supplementari</li>
                </ul>
            </div>
            
            <div class="contact-info" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px; padding: 20px; margin: 25px 0;">
                <p style="margin: 8px 0; font-size: 14px; color: #495057;"><strong>Prossimi passi:</strong></p>
                <p style="margin: 8px 0; font-size: 14px; color: #495057;">
                    Il nostro team esaminerà la tua richiesta e ti contatterà entro 24-48 ore lavorative tramite email o telefono.
                </p>
            </div>
            
            <p style="font-size: 14px; color: #495057; margin-top: 30px;">
                Cordiali saluti,<br>
                <strong>Il team pożyczka prywatna</strong>
            </p>
        </div>
        
        <div class="email-footer" style="background-color: #191F29; color: #ffffff; padding: 30px 20px; text-align: center; font-size: 12px;">
            <p class="company-name" style="font-weight: 600; color: #ffffff; font-size: 16px; margin-bottom: 10px; margin: 5px 0;">pożyczka prywatna</p>
            <p style="margin: 5px 0; color: #adb5bd;">© ' . date('Y') . ' pożyczka prywatna. Tutti i diritti riservati.</p>
            <p style="margin: 5px 0; color: #adb5bd;">Piazza San Lorenzo, 00060 Roma</p>
        </div>
    </div>
</body>
</html>';
    
    return $html;
}
?>

