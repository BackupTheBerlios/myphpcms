<?php

// Load in standard config stuff
include("admin/config.php");

// Load in database stuff
include("$site_root/libs/lib_db.php");

// First say that we wish to use template system
include("$site_root/libs/lib_templates.php");

// Delete previously defined templates in session file
destroy_template();

insert_template("open_middle_row","<TR>
							<!-- Start of middle row to hold main page content -->
							<TD>
								<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>
									<TR>
										<TD width=25%>",0);
insert_template("close_middle_row","</TD>
									</TR>
								</TABLE>
							</TD>
							<!-- End of middle row to hold main page content -->
						</TR>",0);
insert_template("footer","<TR>
							<!-- Start of bottom row to hold page footer -->
							<TD><FONT size=-2>The small print !</FONT></TD>
							<!-- End of bottom row to hold page footer -->
						</TR>",0);
insert_template("separate_middle_row","</TD>
										<TD width=*>",0);
insert_template("page_bottom","</TABLE>
					<!-- End of main table to hold entire page -->
				</TD>
			</TR>
		</TABLE>
		<!-- End of main table to hold entire page -->
	</BODY>
</HTML>",0);
insert_template("header","<TR>
							<!-- Start of top row to hold page header -->
							<TD><H2>Eurologic SPIDER Metrics</H2></TD>
							<!-- End of top row to hold page header -->
						</TR>",0);
insert_template("page_top","<HTML>
	<HEAD>
		<TITLE>Eurologic SPIDER Metrics</TITLE>
	</HEAD>
	<BODY>
		<!-- Start of main table to hold entire page -->
		<TABLE width=95% border=1 cellpadding=0 cellspacing=0>
			<TR>
				<TD valign=top>
					<!-- Start of main table to hold entire page -->
					<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>",0);
insert_template("whole_page","<tpl>page_top</tpl><tpl>header</tpl><tpl>open_middle_row</tpl><tpl>nav_bar</tpl><tpl>separate_middle_row</tpl><tpl>content_area</tpl><tpl>close_middle_row</tpl><tpl>footer</tpl><tpl>page_bottom</tpl>",0);

echo "Templates created";

?>