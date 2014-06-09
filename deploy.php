<?php
/*
 * Git Deployment Script
 *
 * Author: alex quiambao < https://github.com/alexquiambao/git-deploy-php >
 *
 * 1.) Basic Usage
 * http://domain.com/deploy.php?pass=put_password_here
 * 2.) With laravel migrate
 * http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate
 * 3.) With laravel migrate and db seet
 * http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate,php artisan db:seed
 *
 */
class GitDeploy
{
  var $allow_get_authenticate = true; // authenticate via $_GET['secret']
  var $secret_pass = 'put_password_here';
  var $app_name = 'Your_App_Name_Here';

  var $inital_command;
  var $allowed_commands;
  var $end_command;

  // set stuff here
  function __construct()
  {
    $this->authenticate();

    // set all the commands you will use here.
    $this->allowed_commands = array(
        'echo $PWD',
        'whoami',
        'git pull',
        'git status'
      );
    // commands to execute at the beginning
    $this->initial_commands = array(
        'echo $PWD',
        'whoami',
        'git pull',
      );
    // commands to execute after initial commands and user commands ($_GET['c'])
    $this->end_command = array(
        'git status'
      );
  }

  function authenticate()
  {
    $secret_pass = $this->secret_pass;
    $allow = false;

    if($this->allow_get_authenticate)
    {
      if(isset($_GET['secret']) && $_GET['secret'] == $secret_pass)
        $allow = true;
    }

    if(isset($_POST['secret']) && $_POST['secret'] == $secret_pass)
        $allow = true;

    if(!$allow)
    {
      header('HTTP/1.0 401 Unauthorized');
      die('401 Unauthorized');
    }

  }

  function go()
  {
    $commands = $this->build_commands();

    foreach($commands AS $command)
    {
      printf("<span>$</span> <span class=\"cmd\">%s\n</span>",$command);

      if($this->is_command_allowed($command))
      {
        $sh_exec = htmlentities(trim(shell_exec($command)));
        printf("  %s \n",$sh_exec);
      } else
      {
        printf("  <span class=\"cmd-error\">Error: \"%s\" Command Not allowed </span>\n",$command);
      }
    }
  }

  private function user_commands()
  {
    if(!empty($_GET['c']))
      return explode(",",$_GET['c']);

    return array();
  }

  private function build_commands()
  {
    $c = $this->initial_commands;
    $c = array_merge($c,$this->end_command);
    $c = array_merge($c,$this->user_commands());
    return $c;
  }

  private function is_command_allowed($cmd)
  {
    return in_array(trim($cmd),$this->allowed_commands);
  }
}
?>
<?php
$g = new GitDeploy;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Deploying <?php echo $g->app_name; ?></title>
<style>
  body{background-color: #292C37; color: #8DDCD1; padding: 0 20px;}
  pre {color:#8DDCD1}
  pre span {color: #FD7874;}
  pre span.cmd{color: #fff;}
  pre span.cmd-error{color:#CE0914;}
</style>
</head>
<body>
<pre>
<?php
$g->go();
?>
</pre>
</body>
</html>
