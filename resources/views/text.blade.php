<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProChitai Subscription</title>
</head>
<body>
    <p>Привет, {{ $user->name }}!<p>
    <p>Благодарим вас за выбор нашей информационной системы для чтения книг! Мы рады сообщить вам, что ваш запрос на приобретение подписки успешно обработан.</p>
    <p>Детали подписки:</p>
    <p>Срок действия: {{ $subscriptionType->title_subscription_type }}</p>
    <p>Цена: {{ $subscriptionType->cost_title_subscription }}</p>
    <p>Ваша подписка дает вам возможность:</p>
    <ul>
        <li>Читать платные книги нашей коллекции.</li>
        <li>Получать доступ к эксклюзивным материалам и событиям.</li>
    </ul>
    <p>Способы оплаты: По карте</p>
    <p>Мы ценим ваш выбор нашей платформы и надеемся, что ваше чтение станет еще более удобным и захватывающим с нашей подпиской.</p>
    <p>Если у вас возникнут вопросы или вам потребуется дополнительная информация, не стесняйтесь обращаться к нашей службе поддержки.</p>
    <p>Благодарим вас за вашу поддержку!</p>
    <p>С наилучшими пожеланиями,</p>
    <p>Горнов Олег Витальевич, Сотрудник, admin@mail.ru</p>
</body>
</html>