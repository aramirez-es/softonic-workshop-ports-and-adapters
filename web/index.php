<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/users/{name}', function ( $name ){
    $user_registration = new \Domain\UserRegistration( new \Infrastructure\FileUserRepository( 'db.db' ) );
    $user_registration->signUp( $name );

    return "<h1>User $name registered successfully! :D</h1>";
});
$app->get('/users', function (){
    $user_registration = new \Domain\UserRegistration( new \Infrastructure\FileUserRepository( 'db.db' ) );
    $users = $user_registration->listUsers();

    $output = '<h1>List of users</h1>';
    foreach ( $users as $user )
    {
        $output .= '- ' . $user->getUsername() . '<br />';
    }

    return $output;
});

$app->run();