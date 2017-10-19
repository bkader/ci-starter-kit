# CodeIgniter Starter Kit

### What is this?
Because I am a huge fan of [CodeIgniter](https://www.codeigniter.com/), I made a small collection of needed resources and put them all together into a single brute project that I simply copy then edit to start developing a __CI-based__ web application.
### How to use?
All you have to do is to copy all files, *or the one you need*, to your workspace and do tiny modifications and configuration.
### What is included?

 - __HMVC__ structure using __[wiredesignz extension](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc)__.
 - Automatic detection of your __base_url__ that you can change to use your own ([see](https://github.com/bkader/CodeIgniter/blob/master/application/config/config.php#L26)).
 - __.htaccess__ so you would never see *index.php* on your URLs.
 - __Encryption key__ automatically generated and stored in *application/encryption_key.php* file ([see how it's done](https://github.com/bkader/CodeIgniter/blob/master/application/config/config.php#L333)).
 - My own __[Theme Library](https://github.com/bkader/ci-theme)__ with two (2) themes included  (*Bootstrap* and *Semanti UI*) and it is so easy to add yours.
 - [Laraval static routing](https://github.com/Patroklo/codeigniter-static-laravel-routes).
 - Some libraries: __[Bcrypt](http://www.github.com/studiousapp/codeigniter-bcrypt)__, __[Markdown](https://github.com/jonlabelle/ci-markdown)__.
 - All modules can have their own admin aria by simply adding an admin controller to them (*application/modules/**MODULE**/controllers/**Admin.php**). This controller should extend **[Admin_Controller](https://github.com/bkader/CodeIgniter/blob/master/application/core/MY_Controller.php#L141)** in which you have to set your own [checking logic](https://github.com/bkader/CodeIgniter/blob/master/application/core/MY_Controller.php#L149).
 - Controllers that require a logged in user should simply extend **[User_Controller](https://github.com/bkader/CodeIgniter/blob/master/application/core/MY_Controller.php#L112)** instead of **MY_Controller** and don't forget to add your [checking logic](https://github.com/bkader/CodeIgniter/blob/master/application/core/MY_Controller.php#L120) as well.
 - A **[dummy](https://github.com/bkader/CodeIgniter/tree/master/application/modules/dummy)** module is added so you simply copy-paste it and keep only folders that you need then create your files.
 - A veru useful hook is added: __[compress.php](https://github.com/bkader/CodeIgniter/blob/master/application/hooks/compress.php)__ that will simply compress your HTML output when you set your [environment](https://github.com/bkader/CodeIgniter/blob/master/index.php#L56) to __production__.
### Credits
All credits go to their respective owners! And a little bit for me for doing this with so much love.
