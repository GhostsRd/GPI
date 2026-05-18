@component('mail::message')
# Bonjour,

Vous recevez cet e-mail car une tentative de connexion à votre compte **{{ config('app.name') }}** a été initiée.

Pour finaliser votre authentification, veuillez saisir le code de sécurité temporaire suivant :

@component('mail::panel')
<div style="font-size: 32px; font-weight: bold; letter-spacing: 5px; text-align: center; color: #4fbbb2; margin: 10px 0;">
{{ $code }}
</div>
@endcomponent

Ce code est confidentiel et est valide pendant **10 minutes**.

Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer cet e-mail en toute sécurité. Nous vous conseillons toutefois de modifier votre mot de passe par précaution.

Cordialement,<br>
L'équipe **{{ config('app.name') }}**
@endcomponent
