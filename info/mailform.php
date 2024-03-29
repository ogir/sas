<?php
/* Set e-mail recipient */
$myemail  = "davidatrigo@gmail.com";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name'], "Enter your name");
$email    = check_input($_POST['email']);
$message = check_input($_POST['message'], "Write your message");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Name: $name
E-mail: $email

Message:
$message

End of message
";

/* Send the message using mail() function */
mail($myemail, $name, $message);

/* Redirect visitor to the thank you page */
header('Location:/info/thankyou.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>
    <b>Please correct the following error:</b><br/>
    <?php echo $myError; ?>
    <br/>
	<br/>
	<a href="http://www.slightlyaltered.org/info/contactpage.html">Back to Slightly Altered States contact page</a>
    </body>
    </html>
<?php
exit();
}
?>