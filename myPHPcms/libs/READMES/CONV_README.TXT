conv_html HTML library for use in dynamic websites
+------------------------------------------------+

Files: conv_html.php

README
------

Version 0.1 30 September 2001 - Philip Lee

Introduction
+----------+

Whilst the lib_html library allows the creation of properly formatted
HTML code directly from PHP code, the creation of large documents by
hand would be a very laborious task.  This library has been developed to
allow existing HTML to be pasted or passed into the library where it is
converted into the correct calls for lib_html.

NOTE: the validity (or otherwise) of the supplied HTML is NOT checked.
      It must be validated elsewhere this utility will simple convert
      what it is given.

Overview
+------+

In order to convert the supplied HTML code into properly structured calls
to lib_html the supplied HTML needs to be scanned for tags and each tag 
needs to be replaced by PHP that not only creates the tag but also preserves
any parameters that were passed.  Examination of the HMTL shows that the tags
can be divided into three types:

   Solo tags

   These are tags that have no properties, ie they never change.  These
   tags are usually the corresponding closing tag to a more complex tag
   that has properties associated with it.

   <HTML>  </HTML>
   <HEAD>  </HEAD>
           </BODY>
           </SCRIPT> (exception)
           </FONT>
           </A>      (exception)
           </DIV>
           </TABLE>
           </TR>
           </TD>
           </TH>
           </FORM>
   <SELECT></SELECT>
           </OPTION>
           <TEXTAREA>
   

   Wrapper tags

   These are tags that surround other items but which do not have any
   properties of their own.  They are usually text formatting tags.

   <TITLE></TITLE>
   <!-- comment -->
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
   <P></P>
   <BLOCKQUOTE></BLOCKQUOTE>
   <OL></OL>
   <LI></LI>
   <UL></UL>

   Complex tags

   These are tags that have one or more property values.

   <META>
   <BODY>
   <SCRIPT> (exception)
   <LINK>
   <FONT>
   <A HREF> (exception)
   <BR>
   <DIV>
   <IMG>
   <HR>
   <TABLE>
   <TR>
   <TD>
   <TH>
   <FORM>
   <INPUT>
   <OPTION> (exception)
   <TEXTAREA>
   