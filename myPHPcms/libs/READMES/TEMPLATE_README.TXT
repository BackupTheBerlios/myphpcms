PHP-Templating system for use in dynamic websites
+-----------------------------------------------+

Files: lib_template.php
       template.sql

README
------

Version 0.7 30 September 2001 - Philip Lee

Introduction
------------

Dynamic websites consist of several components.  At the lowest level is
a database in which content for the website is contained.  The middle 
layer is some kind of scripting language that queries the database and
creates HTML pages based on the results of these queries.  The upper 
most level is the users browser that actually renders the HTML page for
the user to interact with.

The problem with the scripting languages is that the actual logical 
code that queries the database and constructs the page is mixed up with
the HTML code that actually defines the page.  This makes reading and 
maintaining the code harder than it needs to be.

This templating system has been developed in order to break the link 
between the HTML required to build a web page and the scripts behind 
the page that actually put the page together.  It does this by 
providing commands to create, update, delete or list template variables.

These template variables can be as simple as a users name that is 
displayed when they log in or they can be some HTML that creates 
different page layouts according to the value of some other variable.
An example of this would be a login form.

Overview
--------

The template variables can either be dynamic or static.  Dynamic 
variables are set during runtime and persist only for the duration of 
the session.  Static variables are created and are stored in the 
'template' table of the MySQL database.  In addition, static variables
are stored in a session file so that they can be retrieved locally 
rather than querying the database each time that they are needed.

When the page is requested the main template system file 
(lib_templates.php) must be included in order to allow the templating
system functions to be used.  A number of commands can be used to 
create, modify or delete template variables as a result of PHP code 
responsible for the logic of the web page.  The final line of the web
page then calls the parsing function which replaces the template values
with the values stored within the database.

Note that these templates can contain not only text values, but HTML 
code and even other template variables.  The output from the parsing 
routine is only returned once the last template tag has been removed.  
The templates variables are defined using the tags 
<tpl>template_name</tpl>.

In order to reduce the number of database requests, PHP session 
variables are used to store the contents of the template variables.  
PHP sessions work by storing variable name/value pairs in a text file 
on the server.  The session file is assigned a unique name by the PHP 
engine such as sess_63baa71842d72e6b21be2fc29929eac6.  This is unique 
to the browser that created it.  These files are typically stored in 
the /tmp directory although this can be changed when PHP is compiled.  
In order to ensure that up to date values of the variables are used, 
the session file is timestamped.  If the user returns to the site and
the session variables are found to be too old then they will be 
reloaded from the database.  These new values will then be stored in 
the session file and a new timestamp will be applied.

The templating system allows the specification of a site number when 
creating, modifying or deleting a template.  This allows the templating
system to store multiple site templates in the database but to only 
deliver the required templates to the user's browser.  This feature 
could be used to serve totally different sites from the same database 
or could be used to develop a new site design on a live system whilst 
users are accessing the old design on the same site.  The default site 
will be the first one defined in the templating system (site 1) unless 
specified in the insert_template(), refresh_template() or 
delete_template() commands.  The templating system will check for the
presence of a variable called $site_id - if this is not found then the
system defaults to site template 1.  It is recommended that the 
$site_id variable be set in a file which is then include()d into all 
files that need to use the templating system.

SQL database design
-------------------

Template data is stored in a two tables in any accessible MySQL
database.  One table is required called 'tpl_template'.  This table 
consists of the following columns:

   template_id      - an integer used for tracking the templates.  This
                      is the primary key for the database table.
   time_stamp       - an integer indicating when the template was 
   		      written into the database
   site_id          - an integer indicating the number of the site to
                      obtain the templates for.  By default (if 
                      unspecified) this is zero.
   template_name    - the name of the template asigned by the user by 
   		      with the addition of the template tags <tpl> and 
   		      </tpl>.  These are included in order to speed up
   		      the pattern matching process when the page is 
   		      parsed.
   template_content - The content specified by the user.  This can be 
                      up to 64K in size (much bigger and the users will
                      die of boredom waiting for the page to load !)

The second table is called tpl_sites and stores the siteid and data 
associated with the owner of the site.  This table consists of the
following columns:

   site_id          - an integer which corresponds to the value of 
                      site_id in the above table
   site_name        - name of the site eg MTB-Wales.com
   site_url         - URL of the site http://www.mtb-wales.com
   site_owner       - name of the webmaster of the site
   owner_email      - email address of the webmaster of the site


Example
-------

This is a very simple example that includes the templating system, 
creates a variable and then displays the final page.

  // Call the templating system
  include("config.php"); // necessary to setup database parameters
  include("lib_db.php"); // database abstration layer since templates
                         // system knows nothing about database in use
  include("templates.php");

  // Create a variable called 'fred' containing the text string 'this 
  // is a test'
  insert_template('fred','this is a test');

  // Do some other PHP stuff from here
     |
     |
     V
  // to here

  // Define some HTML to create the page.  In practice this would 
  // probably be read in from the database
  $page_content='<HTML>
                 <HEAD></HEAD>
                 <BODY>
                 <tpl>fred</tpl>
                 </BODY>
                 </HTML>';
  
  // Render the page in the browser window
  parse_template($page_content);

This will produce a page containing the text 'this is a test'.


Notes
-----

1.  It may be tempting to develop a page eg index.php that contains a 
    switch structure that is used to vary the values of the local 
    templates containing the dynamic content on the page.  This will 
    not work with the templating system in its current state as each 
    time lib_templates.php is include()d the array that contains the
    local templates will be reset.  This is because it appears to be
    impossible to sense that the array is already set.

    The solution to this is to develop an index.php page that calls 
    other pages eg user.php, graphs.php that utilise the templating 
    system.  Only the local templates need to be updated in each of 
    these local pages.  A spin-off of this is that the site would 
    consist of lots of little files with logical names rather than 
    one huge index.php file with a massive switch structure.
    
2.  The use of double quotes in HTML tags eg <table width="100%"> 
    breaks the templating system.  The use of single quotes (') eg 
    <table width='100%'> is fine and is recommended.


Reference
---------

There are eight main functions in the templating system.  These are:

  * insert_template
  * refresh_template
  * delete_template
  * list_template
  * parse_template
  * create_local_template
  * update_local_template
  * delete_local_template

function insert_template(template_name, template_content, site_id)

   This is the main function for the creation of templates.  The 
   template name and content must be given.  Null values of the 
   template value are permitted.  If the template name is already in
   use, then the template will be updated with the new value supplied.
   The value of the template will be stored in the MySQL database and 
   will also be stored in the local session file.

function refresh_template(template_name, template_content, site_id)

   This function can be used to update the content of a template 
   variable although insert_template can also be used to do the same 
   it's use is not recommended.  If the template does not exist then it
   is created and assigned the value specified in the calling function.  
   The value of the template will be stored in the MySQL database and 
   will also be stored in the local session file.

function delete_template(template_name, site_id)

   This function can be used to delete a template from the template 
   system.  If the template does not exist, the function returns 
   silently.  If the template is deleted, all traces off it are lost 
   including from within the session file.

function list_template(site_id)

   This function returns an array of available templates names which 
   could be used in order to create a drop-down select box.

function parse_template(page_content, site_id)

   This function accepts a string variable containing either template 
   tags, or a mix of template tags. It cycles through the string 
   replacing template variables with their values until all templates 
   have been replaced.

function create_local_template(template_name, template_content)

   This is the main function for the creation of templates.  The 
   template name and content must be given.  Null values of the 
   template value are permitted.  If the template name is already in 
   use, then the template will be updated with the new value supplied.  
   The value of the template will NOT be stored in the MySQL database 
   and neither will they be stored in the local session file.  NOTE: 
   values are local to the page that created them.

function refresh_local_template(template_name, template_content)

   This function can be used to update the content of a template 
   variable although insert_template can also be used to do the same 
   it's use is not recommended.  If the template does not exist then it
   is created and assigned the value specified in the calling function.  
   The value of the template will NOT be stored in the MySQL database 
   and neither will it be stored in the local session file.  NOTE: 
   values are local to the page that created them.

function delete_local_template(template_name)

   This function can be used to delete a template from the template 
   system.  If the template does not exist, the function returns 
   silently.  If the template is deleted, all traces off it are lost.
   NOTE: values are local to the page that created them.
   
END