<?php
use Titter\TemplateManager;
use Titter\Controller;

// Register this error handler
// to run after everything else has
register_shutdown_function(function() {
    // Attempt to get the last error.
    $e = error_get_last();

    // Return if there is no error
    // or if is not a fatal one
    if ($e == null || !in_array($e["type"], [E_ERROR, E_USER_ERROR]))
        return;

    // Clear outbut buffer and start anew
    ob_end_clean(); ob_start();

    // Format error data
    $einfo = (object) [];
    $einfo->type = $e["type"] ?? E_CORE_ERROR;
    $einfo->file = $e["file"] ?? "(unknown file)";
    $einfo->line = (string) $e["line"] ?? "(unknown line)";
    $einfo->message = $e["message"] ?? "(no message)";

    Controller::$app->error = $einfo;

    try
    {
        echo TemplateManager::render("fatal_error");
    }
    catch (Throwable $e)
    {
        $jeinfo = json_encode($einfo, JSON_PRETTY_PRINT);

        echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Super fatal error - gnostia.</title>
            </head>
            <body>
                <h1>Super fatal error</h1>
                <p>
                    Look, I know it sounds crazy, but there was a fatal error
                    trying to render the fatal error page.
                    <br>
                    Here are the technical details:    
                </p>
                <pre>
                {$jeinfo}
                </pre>
            </body>
        </html>
        ';
    }
});