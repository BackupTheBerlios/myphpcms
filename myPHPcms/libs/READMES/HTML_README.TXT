lib_html HTML class for use in dynamic websites
+---------------------------------------------+

Files: lib_html.php
       conv_html.php

README
------

Version 0.7 28 September 2001 - Philip Lee

Introduction
+----------+

In order to aid the separation of HTML and PHP code, it is desirable
to have some way of completely removing the HTML code from the PHP
code.  One way to do this is by the user of a library to create the
HTML.  This could be include()d into the script and could consist of
a series of functions.

An alternative approach is to use PHP objects and classes to set the
properties of HTML tags that are then returned to the calling script.

Overview
+------+

The separation of HTML code for presentation and the PHP code for
logic is something of a Holy Grail.  It is possible but not easy to 
achieve with considerable effort.  The templating system developed
here goes some way to separating HTML from the scripts that create
the pages by removing much of the static HTML into template files.
However, dynamically generated HTML, for example that which might be
used to display the results of a MySQL query in a table, still needs
to be coded into the PHP scripts through the use of dynamic template
variables.

Dynamically generated HTML could be produced by a library of PHP
functions such as open_table(), close_table().  For the simplest of
tags this would be a good solution but for the more complex tags
where values can be passed to the tag in order to control its
appearance this solution is inelegant.  Why ?  Because if a function 
is used to write out the code then if values are passed to it that 
alter the default behaviour of the function then all other tag 
properties must also be passed.

The use of objects (and PHP classes) gets around this problem at the
cost of slightly more complex code.  This is the approach that has
been chosen for lib_html.php.  The tags have been divided as follows:

   Basic tags
         <HTML></HTML>
   Header tags
         <HEAD></HEAD>
         <META>
         <TITLE></TITLE>
   Body tags
         <BODY></BODY>
         <!-- comment -->
         <SCRIPT></SCRIPT>
         <LINK>
   Text tags
         <H1-6></H1-6>
         <PRE></PRE>
         <B></B>
         <I></I>
         <TT></TT>
         <CITE></CITE>
         <EM></EM>
         <STRONG></STRONG>
         <FONT></FONT>
   Links tags
         <A HREF></A>
   Formatting tags
         <P></P>
         <BR>
         <BLOCKQUOTE></BLOCKQUOTE>
         <OL></OL>
         <LI>
         <UL>
         <DIV></DIV>
   Graphical elements
         <IMG>
         <HR>
   Table tags
   	<TABLE></TABLE>
   	<TR></TR>
   	<TD></TD>
   	<TH></TH>
   Forms
        <FORM></FORM>
        <INPUT>
        <SELECT></SELECT>
        <OPTION></OPTION>
        <TEXTAREA></TEXTAREA>


Example
+-----+

Creation of a simple one cell table (indented for clarity)

// Include lib_html.php
include("lib_html.php");

// Open table tag
$table=new table_open;
// Write it out to a string
$html=$table->write();

	// Write out a new row
	$row1=new table_row_open;
	$html .=$row1->write();
	
		// Write out new division
		$td=new table_div_open;
		$html .=$td->write();
		
			// Finally insert some text
			$text =new text;
			$text->set('text','Here is some text');
			$text->write();
		
		// Close the division
		$td=new table_div_close;
		$html .=$td->write();

	// Close table row
	$row1=new table_row_close;
	$html .=$row1->write();

// Close the table tag
$table=new table_close;
$html .=$table->write();

// Format the html for output
$html=pretty_html($html,$offset);

This will produce the sentance "Here is some text" in a one row by one 
column table.  Offset specifies the number of tab characters to use to
indent the text in order to blend it in with other HTML source code when
viewed on screen.


Notes
+---+

Although the example above could be coded by hand, large complex pages
can be very tedious to create.  An alternative is to use the conv_html.php
tool to convert from HTML to lib_html calls.

Reference
+-------+

   Basic tags
         
         open_html
         ---------
         Writes the opening HTML tag to signify the start of the document.
         
         EXAMPLE
         
         $start=new open_html;
         $html .=$start->write();
         
         close_html
         ----------
         Writes the closing the HTML tag to finish the document.
                  
         EXAMPLE
         
         $end=new close_html;
         $html .=$end->write();
         
   Header tags
   
         open_head
         ---------
         Writes the <HEAD> tag to indicate the start of the document header.
         
         EXAMPLE
         
         $head=new open_head;
         $html .=$head->write();
         
         close_head
         ----------
         Writes the </HEAD> tag to indicate the end of the document header.
         
         EXAMPLE
         
         $head=new close_header;
         $html .=$head->write();
         
         meta
         ----
         Writes out the meta tags contained within the head of the document.
         These have carefully prescribed values and, as such, do not offer as
         much control as some of the other tags.  Permitted options are:
         
         author       (default="")    "authors name"
	 description  (default="")    "site description"
	 expires      (default="")    "expiry date eg Wed, 26 Feb 1997 08:21:57 GMT"
	 keywords     (default="")    "keywords for search engines"
	 nocache      (default="")    "anything to make variable non-null"
	 refresh      (default="")    "time period over which to refresh site content 
	                               AND site/page URL"
	 robots       (default="all") ""
	 setcookie    (default="")    ""
	 target       (default="")    ""
                  
         EXAMPLE
         
         $meta=new meta;
         $meta->set('author','Philip Lee');
         $meta->set('description','Test site');
         $meta->set('nocache','anything');
         $meta->set('refresh','0;URL='http://www.mtb-wales.com'');
         $meta->set('setcookie','cookievalue=xxx;expires=Wednesday, 21-Oct-98 16:14:21 GMT; path=/');
         $meta->set('target','=_top');
         $html .=$meta->write();
         
         title
         -----
         Write the page title supplied between the tags.  Must be in the head
         of the document
                  
         EXAMPLE
         
         $title=new title;
         $title->set('title','This my page !');
         $html .=$title->write();
         
   Body tags
   
         open_body
         ---------
         Opens the body tag and allows the setting of various parameters.  Typical
         values are:
         
         alink      (default="")
	 background (default="")
	 bgcolor    (default="")
	 link       (default="")
	 text       (default="")
	 vlink      (default="")
                           
         EXAMPLE
         
         $body=new open_body;
         $body->set('bgcolor','#ffffff');
         $html .=$body->write();
         
         close_body
         ----------
         Closes the body tag.
                  
         EXAMPLE
         
         $body=new close_body;
         $html .=$body->write();
         
         comment
         -------
         Writes out a text comment that the browser will ignore.
                           
         EXAMPLE
         
         $comment=new comment;
         $comment->set('comment','This is a comment');
         $html .=$comment->write();
         
         script
         ------
         Allows the incorporation of Javascript within a page.  Has the
         following properties that can be set by the user:
         
         type       (default="")
	 language   (default="")
	 content    (default="")
         
         EXAMPLE
         
         $script=new script;
         $script->set('type','TEXT/PLAIN');
         $script->set('language','JAVASCRIPT');
         $script->set('content','var blah blah');
         $html .=$script->write();
         
         link
         ----
         Allows the linking of a page to stylesheets or other external resources.
         Writes out the <LINK> tag.  Only paramater is:
         
         css      (default="")
         
         EXAMPLE

         $link=new link;
         $link->set('css','styles.css');
         $html .=$link->write();

   Text tags
   
        text
        ----
        Supplies the closing the tag(s) in the reverse order that they 
        were supplied to the class.  All tags are returned in upper case.
        Allowed tags are:
        
        <H1></H1>
	<H2></H2>
	<H3></H3>
	<H4></H4>
	<H5></H5>
	<H6></H6>
	<B></B>
	<I></I>
	<TT></TT>
	<CITE></CITE>
	<EM></EM>
	<STRONG></STRONG>
	<TH></TH>
	
	ANY OTHER TAGS ARE PASSED STRAIGHT THROUGH !!!!!!!!!!!!!!!!!!
	
	EXAMPLE
	
	$text=new text();
	$text->set('tags','<h1><i><b>');
	$text->set('text','this is some sample text');
	$html .=$text->write();
	
	font_open
	---------
	Opens the <font> tag with the appropriate optional parameters.  Allowed
	parameters are:
	
	color       (default "")
	bgcolor     (default "")
	size        (default "")
	
	EXAMPLE
	
	$font=new open_font;
	$font->set('size','+2');
	$html .=$font->write();
	
	font_close
	----------
	Supplies the closing </FONT> tag.
	
	EXAMPLE
   
        $font=new close_font;
        $html .=$font->write();
   
   Links tags
   
        href
        ----
        Opens the <A HREF=> tag and completes with the supplied link name.
        The tag is then closed, the link name ($text) is set and then the
        full tag is closed off.  Parameters:
        
        link      (default "")
        text      (default "")
        
        EXAMPLE

        $href=new href;
        $href->set('link','http://www.mtb-wales.com');
        $href->set('text','Link to MTB-Wales.com');
        $html .=$href->write();
   
   Formatting tags
   
         p
         -
         Writes out the specified text surrounded by <p> and </p>.  It has
         two properties:
         
         align    (default="")
         text     (default="")
   
         EXAMPLE
         
         $p=new p;
         $p->set('text','This is a very short paragraph');
         $html .=$p->write();
         
         break
         -----
         Writes out the line break tag
         
         EXAMPLE
         
         $br=new br;
         $br->set('align','center');
         $html .=$br->write();
         
         blockquote
         ----------
         Writes out a section of text but indents to make it look like a
         quotation.  Has just one property:
         
         text    (default="")
         
         EXAMPLE
         
         $blockquote=new blockquote;
         $blockquote->set('text','This is a quotation');
         $html .=$blockquote->write();
         
         ol_open
         -------
         Mark the start of an ordered list.
         
         EXAMPLE
         
         $ol=new ol_open;
         $html .=$ol->write();
         
         ol_close
         --------
         Mark the end of an ordered list.
         
         EXAMPLE
         
         $ol=new ol_close;
         $html .=$ol->write();
             
         li
         --
         Add a text item to the list.  Returns the supplied text surrounded
         by the <li> and </li> tags
         
         EXAMPLE
         
         $li=new li;
         $li->set('text','This is a list item');
         $html .=$li->write();
         
         ul
         --
         Add a text item to the list.  Returns the supplied text surrounded
         by the <ul> and </ul> tags
         
         EXAMPLE
         
         $ul=new ul;
         $ul->set('text','This is a list item');
         $html .=$ul->write();
                  
         div_open
         --------
         Opens a <div> tag.  Can accept an alignment parameter.
         
         align      (default="")
  
         EXAMPLE
         
         $div=new div_open;
         $div->set('align','left');
         $html .=$div->write();
                  
         div_close
         ---------
         Closes the <div> tag.
         
         EXAMPLE
         
         $div=new div_close;
         $html .=$div->write();
         
   Graphical elements
   
        image
        -----
        Open a complete <IMG> tag with the appropriate attributes.  Allowed
        attributes are:
        
        align
	alt
	border
	height
	hspace
	ismap
	src
	usemap
	vspace
	width
	
	EXAMPLE
	
	$img=new img;
	$img->set('alt','This is a picture');
	$img->set('src','picture.gif');
	$img->set('height','150');
	$img->set('width','150');
	$html .=$$img->write();
	
	hr
	--
	Insert completed <HR> tag complete with attributes.  Permitted attributes
	are:
	
	align;
	noshade;
	size;
	width;
	
	EXAMPLE
	
	$hr=new hr;
	$hr->set('align','center');
	$html .=$$hr->write();
	
   Table tags
   
        table_open
        ----------
        Returns a string containing <TABLE> followed by its attributes
        Allowed attributes are:
        
        align       (default "")
	background  (default "")
	bgcolor     (default "")
	border      (default "0")
	cellpadding (default "0")
	cellspacing (default "0")
	frame       (default "")
	height      (default "")
	hspace      (default "")
	rules       (default "")
	summary     (default "")
	vspace      (default "")
	width       (default "100%")
        
        EXAMPLE
        
        $table=new table_open;
        $table->set('align','top');
        $table->set('width','100%');
        $table->set('cellspacing','0');
        $table->set('cellpadding','0');
        $table->set('border','1');
        $html .=$table->write();
        
        table_close
        -----------
        Returns a string containing </TABLE>
        
        EXAMPLE
        
        $table=new table_close;
        $html .=$table->write();
        
        table_row_open
        --------------
        Returns a string containing <TR> followed by its attributes.
        Allowed attributes are:
        
        align       (default "")
	bgcolor     (default "")
	valign      (default "")
	
	EXAMPLE
	
	$tr=new table_row_open;
	$tr->set('align','left');
	$tr->set('valign','top');
	$html .=$tr->write();
		
	table_row_close
	---------------
	Returns a string containing </TR>
        
        EXAMPLE
        
        $tr=new table_row_close;
	$html .=$tr->write();
                
        table_div_open
        --------------
        Returns a string containing <TD> followed by its attributes
        Allowed attributes are:
        
        align       (default "")
	background  (default "")
	bgcolor     (default "")
	colspan     (default"")
	height      (default "")
	rowspan     (default "")
	valign      (default "")
	width       (default "")
        
        EXAMPLE
        
        $td=new table_div_open;
        $td->set('align','left');
        $td->set('colspan','3');
        $html .=$td->write();
        
        table_div_close
        ---------------
        Returns a string containing </TD>
        
        EXAMPLE
        
        $td=new table_div_close;
        $html .=$td->write();
        
        
        table_header_open
        -----------------
        Class to create a <TH> tag with the associated properties
	
	align      (default="")
	background (default="")
	bgcolor    (default="")
	colspan    (default="")
	height     (default="")
	rowspan    (default="")
	valign     (default="")
	width      (default="")
	
	EXAMPLE
	
	$th=new table_header_open;
	$th->set('align','center');
	$th->set('width','20%');
	$html .=$th->write();
	
	table_header_close
	------------------
	Closes <TH> tag
	
	EXAMPLE
	
	$th=new table_header_close;
	$html .=$th->write();
        
   Forms
   
   	form_open
   	---------
   	Returns the <FORM> tag with the relevant attributes completed.
   	Allowed attributes are:
   	
   	action
	enctype
	method      (default "post")
	
	EXAMPLE
	
	$form=new form_open;
	$form->set('action','action.php');
	$form->set('method','post');
	$html=$form->write();
	
	form_close
	----------
   	This writes the closing </FORM> tag.
   	
   	$form=new form_open;
	$html=$form->write();
   	
   	input
   	-----
   	Returns the <INPUT> tag with the relevant attributes completed.
   	Allowed attributes are:
   	
   	accept
	align
	checked
	maxlength
	name
	src
	size
	type
	value
	
	Not all of these attributes are relevant for all types of input.  In
	fact, it is the value of the 'input' variable that governs which ones
	are set and are thus written out.
   	
   	EXAMPLE
   	
   	$input=new input;
   	$input->set('type','text');
   	$input->set('name','bananas');
   	$input->set('maxlength','5');
   	$html .=input->write();
   	
   	select_open
   	-----------
   	Returns the <SELECT> tag with the attributes correctly defined.
   	Allowable attributes are:
   	
   	multiple
	name
	size
   	
   	EXAMPLE
   	
   	$select=new select_open;
   	$select->set('name','country');
   	$html .=$select->write();
   	
   	select_close
   	------------
   	Returns the </SELECT> tag
   	
   	EXAMPLE
   	
   	$select=new select_close;
   	$html .=$select->write();
   	
   	option
   	------
   	Returns the <OPTION></OPTION> tag with the name set and the provided
   	text included in the tag.  Allowable attributes are:
   	
   	selected
	text        (default "")
	value
	width
   	
   	EXAMPLE
   	
   	$option=new option;
   	$option->set('text','France');
   	$html .=$select->write();
   	
   	textarea
   	--------
   	Creates a text area on a form and displays the optional text when the
   	control first loads.  Allowable attirbutes:
   	
   	cols
	name
	rows
	wrap
	text
   
        EXAMPLE
        
        $textarea=new textarea;
        $textarea->set('cols','72');
        $textarea->set('rows','30');
        $textarea->set('name','input_box');
        $html .=$textarea->write();
   
END
