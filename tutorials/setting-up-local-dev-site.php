<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Tutorials</title>
  <meta name="description" content="">
  <meta name="author" content="Eric Reeves">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/skeleton.css">
  <link rel="stylesheet" href="../css/custom.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">



</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">

    <?php include('../partials/navheader.php');?>
    <div class="row">
      <div class="12 columns" style="margin-top: 15%">
        <h4>Setting Up A Local Dev Site Using XAMPP on Windows</h4>
        <p>
          <?= nl2br("Created: ".date("F d, Y.",filectime("setting-up-local-dev-site.php")) . 
          "\r\nLast modified: ".date("F d, Y.",filemtime("setting-up-local-dev-site.php")));?>
        </p>

        <p>
          This seems like a good first tutorial to write seeing as I just spent the last hour working on this exact problem to get a dev version of this site running locally.
          I've probably done something like this a few dozen times, but I swear each time something is slightly different and I don't do it regularily enough to actually remember
          each and every step.  Also, just to make things more fun, I work in all 3 major OS's (Windows for work, MacOS for fun, and Linux for my server), which always seems to 
          produce a complication somewhere.  
          <p>So here are the steps I took to get this site running on my machine:</p>
        </p>
        <p>
          <ol>
            <li>
              Download <a href="https://www.apachefriends.org/index.html">XAMPP</a>.  XAMPP is a package that will install all the major components 
              you'll need for a webserver and ensures that they are all configured 
              to interact properly right out of the box.  You can configure the exact installation to suit your needs.  For this, I installed 
              Apache and PHP.  I skipped the database portion
              (MySQL) for now because I won't be needing it for this site. Once downloaded, run the installer and let it do it's thing.
            </li>
            <li>
              Next, I would check to make sure that everything installed correctly.  Open the XAMPP control panel and start Apache.  
              If everything went well, you should be able to navigate to 'Localhost' in your browser and see the XAMPP landing page.
            </li>
            <li>
              Next, we'll want to create your site and put it on the server.  By default, sites are stored in the <code>xampp/htdocs</code> directory.  
              You can change this (update the <code>< DocumentRoot ></code> entry in <code>xampp/apache/conf/httpd.conf</code>), but htdocs works fine unless 
              you actually have a reason to change it.  So, if you already have a site, move that directory into the 
              htdocs directory, or if you are creating a new site go ahead and create a new directory in the htdocs directory 
              (call it your site's name), and add a basic index.html file inside.
              Now, we have your site on the server, we just need to tell Apache how to send traffic to it.
            </li>
            <li>
              As we've seen, by default the XAMPP installation of Apache points to the htdocs directory.  So if we navigate to 
              'localhost/yoursite/' we should see your site/index page.  But that's not quite what we want.  
              What we'd rather have was the site set up so that we could naviagte directly to it without having to drill down through serveral directories in the address bar.
              To do this we'll need to make changes to two files: <code>xampp/apache/conf/extra/httpd-vhosts.conf</code> and your local Windows<code>hosts</code> file.
              <ul>
                <li>
                  First, let's edit <code>httpd-vhosts.conf</code>. Vhosts stands for "virtual hosts." Essentially, to set up Apache to host serveral sites simultaneously
                  (and from the same IP address), you create a virtual host entry for each site.  This tells Apache where to route traffic for specific sites, identified either by
                  a port number or (more commonly) the server name.  For for our dev site we add an entry similar to this:

<pre><code>
  < VirtualHost *:80>
      ServerAdmin webmaster@dummy-host.example.com
      DocumentRoot "C:/xampp/htdocs/ericlr"
      ServerName devericlr.com
      ServerAlias www.devericlr.com
  < /VirtualHost>
</code></pre>
                </li>
                <li>
                    Second, we need to tell machine to not look out on the internet for our dev site when we type the address into the URL bar.  To do this, we need to edit 
                    our computer's hosts.  In this file you can hardcode certain URL's so that they are resolved to an address of your choosing.  This enables us to use
                    a URL like "devericlr.com" on our machine.  On Windows 10, the hosts is located in C://Windows/System32/drivers/etc.  To edit it, you have to be 
                    using an editor that's running in "Administrator mode".  I used Notepad. Just pull it up in the Start menu, right click, and select "Run as Administrator".
                    Then open up the hosts and add a line entry for your site at the bottom.  Mine looked like this:
<pre><code>	
  # localhost name resolution is handled within DNS itself.
  #	127.0.0.1       localhost
  #	::1             localhost
    192.168.1.112	homeserver.com
    127.0.0.1	devericlr.com		
</code></pre>
                      Note that you can add any number of custom domain name resolutions here.  I've got another one set up so that I can go to "homesever.com" which is hosted
                      on a different machine. (A better way to do this is have your home's router have these DNS entries, this line was just added for illustration.)
                </li>
              </ul>
            </li>
            <li>
              That's it!  You should now have a site running on Apache that you can reach by entering in your custome URL in the browser.  It should be noted: XAMPP is perfect
              for setting up a local dev environment for experimenting and developing easily, but it is NOT intended for use is production.  For a real site that's reachable 
              on the actual internet, you're going to want to set things up properly.  The end result there will look and feel the same as what we've just created, but it 
              will be secured and hardedned up for the rigors of production use.   
            </li>
          </ol>
        </p>
      </div>
    </div>
</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
