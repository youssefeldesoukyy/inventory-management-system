<?php

namespace App;

class Alert
{
    public static function PrintMessage($text, $type)
    {
        if ($type == "Danger")
            echo "<div style='text-align:center;margin-bottom:0;' class = 'alert alert-danger' role = 'alert' >" . $text . "</div>";
        else
            echo "<div style='text-align:center;margin-bottom:0;' class = 'alert alert-primary' role = 'alert' >" . $text . "</div>";
    }

    public function alertAfterSignUp()
    {

        if (isset($_GET["doneSignUp"])) {
            \App\Alert::PrintMessage("Done creating your account", 'Success');
        }
    }
}