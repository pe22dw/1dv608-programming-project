<?php

class LayoutView {
    
    /*
        Handles the rendering to the client.
    */
    
    public function render(MainView $mainView, NavigationView $navigationView) {
        
        echo '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Result Logger</title>
            </head>
            <body>
                ' . $mainView->showHeadline() .'
                ' . $mainView->showLogoutPanel() .'
                ' . $navigationView->showLinks() .'
                <div id="container">
                    ' . $mainView->showContent() . '
                </div>
            </body>
        </html>
        ';
    }
}
